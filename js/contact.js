(() => {
  const form = document.querySelector('[data-contact-form]');
  if (!form) return;
  const type = form.elements.inquiry_type;
  const topic = form.elements.topic;
  const note = form.querySelector('[data-form-note]');
  const submit = form.querySelector('[type=submit]');
  function updateFields() {
    form.querySelectorAll('[data-for-type]').forEach(label => {
      const active = label.dataset.forType === type.value;
      label.hidden = !active;
      const control = label.querySelector('input,select');
      control.disabled = !active;
      control.required = active && control.name === 'experience';
    });
    form.querySelector('[data-topic-field]').hidden = type.value === 'general';
    topic.disabled = type.value === 'general';
    topic.required = type.value !== 'general';
    form.querySelectorAll('[data-topic-group]').forEach(group => {
      group.disabled = group.dataset.topicGroup !== type.value;
      group.hidden = group.disabled;
      if (group.disabled && [...group.children].some(option => option.selected)) topic.value = '';
    });
  }
  type.addEventListener('change', updateFields);
  updateFields();
  let captchaPromise;
  function loadCaptcha() {
    if (captchaPromise) return captchaPromise;
    captchaPromise = new Promise((resolve, reject) => {
      if (!form.dataset.siteKey) { reject(new Error('missing configuration')); return; }
      const script = document.createElement('script');
      const timeout = setTimeout(() => reject(new Error('verification timed out')), 15000);
      script.src = 'https://www.google.com/recaptcha/api.js?render=' + encodeURIComponent(form.dataset.siteKey);
      script.async = true;
      script.onload = () => { clearTimeout(timeout); if (window.grecaptcha) grecaptcha.ready(resolve); else reject(new Error('verification unavailable')); };
      script.onerror = () => { clearTimeout(timeout); reject(new Error('verification unavailable')); };
      document.head.append(script);
    }).catch(error => { captchaPromise = null; throw error; });
    return captchaPromise;
  }
  form.addEventListener('focusin', () => { loadCaptcha().catch(() => {}); }, { once: true });
  form.addEventListener('submit', async event => {
    event.preventDefault();
    if (!form.reportValidity()) return;
    submit.disabled = true; submit.textContent = 'Sending…';
    note.textContent = ''; note.className = 'form-note';
    try {
      await loadCaptcha();
      const token = await Promise.race([
        grecaptcha.execute(form.dataset.siteKey, {action: form.dataset.action}),
        new Promise((_, reject) => setTimeout(() => reject(new Error('verification timed out')), 15000))
      ]);
      form.elements.recaptcha_token.value = token;
      const controller = new AbortController();
      const timeout = setTimeout(() => controller.abort(), 45000);
      let response;
      try { response = await fetch(form.action, {method:'POST',body:new FormData(form),headers:{Accept:'application/json'},signal:controller.signal}); }
      finally { clearTimeout(timeout); }
      const data = await response.json();
      note.textContent = data.message || 'The inquiry could not be sent. Please email us directly.';
      note.classList.add(data.success ? 'success' : 'error');
      if (data.success) { form.reset(); updateFields(); }
    } catch {
      note.classList.add('error');
      note.textContent = 'Submission could not be confirmed. Check your connection or email us directly. If a request timed out, check before sending it again.';
    } finally {
      form.elements.recaptcha_token.value = '';
      submit.disabled = false; submit.textContent = 'Send inquiry ↗';
      note.focus();
    }
  });
})();

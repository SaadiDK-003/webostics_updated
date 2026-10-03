(() => {
  const menu = document.querySelector('.pricing-navigator');
  const tabs = document.querySelector('#pricing-section-links');
  if (!menu || !tabs) return;
  const summary = menu.querySelector('summary');
  const links = [...menu.querySelectorAll('a[href^="#"]')];
  const tabLinks = [...tabs.querySelectorAll('a')];
  const sections = links.map(link => document.getElementById(link.hash.slice(1)));
  const header = document.querySelector('.site-header');
  let headerHeight = 87;
  let scheduled = false;
  const close = restoreFocus => {
    menu.open = false;
    if (restoreFocus && !menu.hidden) summary.focus({preventScroll: true});
  };
  const update = () => {
    scheduled = false;
    const show = tabs.getBoundingClientRect().bottom <= headerHeight;
    if (!show) {
      if (menu.contains(document.activeElement)) tabLinks[0].focus({preventScroll: true});
      close(false);
    }
    menu.hidden = !show;
    let active = 0;
    sections.forEach((section, index) => {
      if (section && section.getBoundingClientRect().top <= headerHeight + 45) active = index;
    });
    [links, tabLinks].forEach(group => group.forEach((link, index) => {
      if (index === active) link.setAttribute('aria-current', 'location');
      else link.removeAttribute('aria-current');
    }));
  };
  const measure = () => {
    headerHeight = header.getBoundingClientRect().height;
    document.documentElement.style.setProperty('--pricing-header-height', `${headerHeight}px`);
    update();
  };
  measure();
  if ('ResizeObserver' in window) new ResizeObserver(measure).observe(header);
  else window.addEventListener('resize', measure);
  menu.addEventListener('click', event => {
    const link = event.target.closest('a');
    if (!link || event.button !== 0 || event.ctrlKey || event.metaKey || event.shiftKey || event.altKey) return;
    close(false);
    const section = document.getElementById(link.hash.slice(1));
    if (section) {
      section.setAttribute('tabindex', '-1');
      requestAnimationFrame(() => section.focus({preventScroll: true}));
    }
  });
  document.addEventListener('click', event => {
    if (menu.open && !menu.contains(event.target)) close(false);
  });
  document.addEventListener('keydown', event => {
    if (event.key === 'Escape' && menu.open) { event.preventDefault(); close(true); }
  });
  window.addEventListener('scroll', () => {
    if (!scheduled) { scheduled = true; requestAnimationFrame(update); }
  }, {passive: true});
  window.addEventListener('resize', update);
  window.addEventListener('hashchange', update);
})();

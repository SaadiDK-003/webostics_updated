(() => {
  const toggle = document.querySelector('.menu-toggle');
  const nav = document.querySelector('#navigation');
  if (toggle && nav) {
    const drawer = document.querySelector('.navigation-shell');
    const backdrop = document.querySelector('.menu-backdrop');
    const dismiss = drawer.querySelector('.menu-close');
    const desktop = matchMedia('(min-width: 1101px)');
    const background = [...document.querySelectorAll('main, .site-footer, .brand, .menu-toggle, .skip-link')];
    let open = false;
    nav.dataset.enhanced = 'true';
    drawer.dataset.enhanced = 'true';
    toggle.setAttribute('aria-controls', drawer.id);
    const close = (restore = false) => {
      open = false;
      drawer.classList.remove('is-open');
      nav.classList.remove('is-open');
      document.body.classList.remove('menu-open');
      backdrop.hidden = true;
      drawer.removeAttribute('role');
      drawer.removeAttribute('aria-modal');
      drawer.removeAttribute('aria-labelledby');
      background.forEach(element => { element.inert = false; });
      toggle.setAttribute('aria-expanded', 'false');
      if (restore) toggle.focus({preventScroll: true});
      drawer.inert = !desktop.matches;
    };
    toggle.addEventListener('click', () => {
      if (open) { close(true); return; }
      if (desktop.matches) return;
      open = true;
      drawer.inert = false;
      drawer.setAttribute('role', 'dialog');
      drawer.setAttribute('aria-modal', 'true');
      drawer.setAttribute('aria-labelledby', 'drawer-title');
      drawer.classList.add('is-open');
      nav.classList.add('is-open');
      document.body.classList.add('menu-open');
      backdrop.hidden = false;
      toggle.setAttribute('aria-expanded', 'true');
      background.forEach(element => { element.inert = true; });
      requestAnimationFrame(() => { if (open) dismiss.focus({preventScroll: true}); });
    });
    dismiss.addEventListener('click', () => close(true));
    backdrop.addEventListener('click', () => close(true));
    document.addEventListener('keydown', event => {
      if (!open) return;
      if (event.key === 'Escape') { event.preventDefault(); close(true); }
      if (event.key === 'Tab') {
        const items = [...drawer.querySelectorAll('button, a[href]')];
        const first = items[0], last = items[items.length - 1];
        if (!drawer.contains(document.activeElement)) { event.preventDefault(); first.focus(); }
        else if (event.shiftKey && document.activeElement === first) { event.preventDefault(); last.focus(); }
        else if (!event.shiftKey && document.activeElement === last) { event.preventDefault(); first.focus(); }
      }
    });
    nav.addEventListener('click', event => { if (event.target.closest('a')) close(true); });
    desktop.addEventListener('change', () => {
      const wasOpen = open;
      close();
      toggle.hidden = desktop.matches;
      if (wasOpen) (desktop.matches ? nav.querySelector('a') : toggle).focus({preventScroll: true});
    });
    close();
    toggle.hidden = desktop.matches;
  }
  const filters = document.querySelector('[data-course-filters]');
  if (filters) {
    filters.hidden = false;
    const cards = [...document.querySelectorAll('[data-course]')];
    const search = document.querySelector('[data-course-search]');
    const status = document.querySelector('[data-filter-status]');
    let category = 'all';
    const filter = () => {
      const query = search.value.toLowerCase().trim();
      let count = 0;
      cards.forEach(card => { card.hidden = !((category === 'all' || card.dataset.category === category) && card.dataset.title.includes(query)); if (!card.hidden) count++; });
      status.textContent = count ? `${count} planned course${count === 1 ? '' : 's'}` : 'No matching courses. Try another topic or search.';
    };
    filters.addEventListener('click', event => {
      const button = event.target.closest('[data-filter]'); if (!button) return;
      category = button.dataset.filter;
      filters.querySelectorAll('[data-filter]').forEach(item => item.setAttribute('aria-pressed', String(item === button)));
      filter();
    });
    search.addEventListener('input', filter);
    filter();
  }
})();

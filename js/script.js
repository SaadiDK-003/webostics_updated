(() => {
  const toggle = document.querySelector('.menu-toggle');
  const nav = document.querySelector('#navigation');
  if (toggle && nav) {
    toggle.hidden = false;
    nav.dataset.enhanced = 'true';
    const close = (restore = false) => { nav.classList.remove('is-open'); toggle.setAttribute('aria-expanded', 'false'); if (restore) toggle.focus(); };
    toggle.addEventListener('click', () => { const open = nav.classList.toggle('is-open'); toggle.setAttribute('aria-expanded', String(open)); });
    document.addEventListener('keydown', event => { if (event.key === 'Escape' && nav.classList.contains('is-open')) close(true); });
    document.addEventListener('click', event => { if (!event.target.closest('.site-header')) close(); });
    nav.addEventListener('click', event => { if (event.target.closest('a')) close(); });
    const desktop = matchMedia('(min-width: 901px)');
    desktop.addEventListener('change', () => { close(); toggle.hidden = desktop.matches; });
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

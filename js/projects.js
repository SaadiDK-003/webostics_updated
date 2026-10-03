(() => {
  const filters = document.querySelector('[data-project-filters]');
  const grid = document.querySelector('[data-project-grid]');
  const status = document.querySelector('[data-project-status]');
  if (!filters || !grid || !status) return;
  const links = [...filters.querySelectorAll('a')];
  const cards = [...grid.querySelectorAll('[data-platform]')];
  const categoryOf = url => url.searchParams.get('platform') || 'all';
  const categories = new Map(links.map(link => [categoryOf(new URL(link.href)), link]));
  const apply = () => {
    const url = new URL(location.href);
    const requested = categoryOf(url);
    const category = categories.has(requested) ? requested : 'all';
    let count = 0;
    cards.forEach(card => {
      card.hidden = category !== 'all' && card.dataset.platform !== category;
      if (!card.hidden) count++;
    });
    categories.forEach((link, key) => {
      link.classList.toggle('is-selected', key === category);
      if (key === category) link.setAttribute('aria-current', 'page');
      else link.removeAttribute('aria-current');
    });
    status.textContent = `${count} project${count === 1 ? '' : 's'}${category === 'all' ? '' : ' · ' + categories.get(category).textContent.trim()}`;
    const robots = document.querySelector('meta[name="robots"]');
    if (robots) robots.content = filters.dataset.indexable === 'true' && !url.searchParams.has('platform') ? 'index, follow' : 'noindex, follow';
  };
  filters.addEventListener('click', event => {
    const link = event.target.closest('a');
    if (!link || !filters.contains(link) || event.defaultPrevented || event.button !== 0 || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) return;
    const target = new URL(link.href);
    if (target.origin !== location.origin || target.pathname !== location.pathname) return;
    // Preserve ordinary navigation if history is unavailable.
    try {
      if (target.href !== location.href) history.pushState(null, '', target.href);
    } catch { return; }
    event.preventDefault();
    apply();
  });
  window.addEventListener('popstate', apply);
  apply();
})();

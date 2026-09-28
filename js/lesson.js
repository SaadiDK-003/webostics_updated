(() => {
  const playground = document.querySelector('[data-playground]');
  if (!playground) return;
  playground.hidden = false;
  const editor = playground.querySelector('textarea');
  const preview = playground.querySelector('[data-preview]');
  const status = playground.querySelector('[data-preview-status]');
  const policy = `<meta http-equiv="Content-Security-Policy" content="default-src 'none'; style-src 'unsafe-inline'; form-action 'none'; base-uri 'none'">`;
  function render() {
    preview.srcdoc = policy + editor.value;
    status.textContent = 'Preview updated. Download your HTML to keep your changes.';
  }
  playground.querySelector('[data-run]').addEventListener('click', render);
  playground.querySelector('[data-download]').addEventListener('click', () => {
    const url = URL.createObjectURL(new Blob([editor.value], {type:'text/html;charset=utf-8'}));
    const link = document.createElement('a');
    link.href = url; link.download = 'index.html'; link.click();
    setTimeout(() => URL.revokeObjectURL(url), 1000);
    status.textContent = 'Download requested. Open index.html in a text editor or browser.';
  });
  render();
})();

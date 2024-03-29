const tx_scroll_module = document.querySelector('body > .module');

/* Prevents jumping after reload*/
window.location.hash = '';

const uid = new URL(window.location.href).searchParams.get('id') ?? '0';

window.addEventListener('unload', function () {
  sessionStorage.setItem('ext-scroll-pages-' + uid, tx_scroll_module.scrollTop);
});

const pos = sessionStorage.getItem('ext-scroll-pages-' + uid);
if (pos) {
  tx_scroll_module.scrollTo(0, pos);
  // This happens, when the clipboard in V11 (loaded via AJAX) is appearing
  if (pos != tx_scroll_module.scrollTop) {
    window.addEventListener('load', function () {
      tx_scroll_module.scrollTo(0, pos);
    });
  }
}

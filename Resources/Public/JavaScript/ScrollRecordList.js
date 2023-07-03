const tx_scroll_module = document.querySelector('body > .module');

/* Prevents jumping after reload*/
window.location.hash = '';

const uid = new URL(window.location.href).searchParams.get('id') ?? '0';

window.addEventListener('unload', function () {
    sessionStorage.setItem('ext-scroll-recordlist-' + uid, tx_scroll_module.scrollTop);
});

const pos = sessionStorage.getItem('ext-scroll-recordlist-' + uid);
if (pos) {
    tx_scroll_module.scrollTo(0, pos);
    if (pos != tx_scroll_module.scrollTop) {
        tx_scroll_module.scrollTo(0, pos);
        if (pos > tx_scroll_module.scrollTop) {
            const timer = setInterval(function () {
                tx_scroll_module.scrollTo(0, pos);
                if (pos == tx_scroll_module.scrollTop) {
                    clearInterval(timer);
                }
            });
        }
    }
}

const tx_scroll_module = document.querySelector('body > .module');

/* Prevents jumping after reload*/
window.location.hash = '';

const uid = new URL(window.location.href).searchParams.get('id') ?? '0';
let table = new URL(window.location.href).searchParams.getAll('table').pop();

if (table === undefined) {
    table = '';
}
if (typeof(table) === 'string' && table !== '') {
    table = table + '-';
}
const storageKey = 'ext-scroll-recordlist-' + table + uid;
window.addEventListener('unload', function () {
    if (tx_scroll_module.scrollTop > 0) {
        sessionStorage.setItem(storageKey, tx_scroll_module.scrollTop);
    }
});

const pos = sessionStorage.getItem(storageKey);
if (pos) {
    sessionStorage.removeItem(storageKey);
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

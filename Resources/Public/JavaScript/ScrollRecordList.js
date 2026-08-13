let tx_scroll_module = document.querySelector('body > .module');
if (TYPO3.settings.cache) {
    // v13
    tx_scroll_module = document.querySelector('body > .module > .module-body');
}

/* Prevents jumping after reload*/
window.location.hash = '';

const uid = new URL(window.location.href).searchParams.get('id') ?? '0';
let table = new URL(window.location.href).searchParams.getAll('table').pop();
let searchTerm = new URL(window.location.href).searchParams.get('searchTerm') ?? '';

if (table === undefined) {
    table = '';
}
if (typeof (table) === 'string' && table !== '') {
    table = table + '-';
}
if (searchTerm === '') {
    const searchTermInput = document.getElementById('recordsearchbox-searchterm');
    if (searchTermInput && searchTermInput.value !== '') {
        searchTerm = searchTermInput.value;
    }
}
if (searchTerm !== '') {
    table = 'search-' + searchTerm + '-' + table;
}
const storageKey = 'ext-scroll-recordlist-' + table + uid;
window.addEventListener('pagehide', function () {
    if (tx_scroll_module.scrollTop > 0) {
        sessionStorage.setItem(storageKey, tx_scroll_module.scrollTop);
    }
});

const pos = parseInt(sessionStorage.getItem(storageKey));
if (pos) {
    sessionStorage.removeItem(storageKey);
    tx_scroll_module.scrollTo(0, pos);
    if (pos !== tx_scroll_module.scrollTop) {
        tx_scroll_module.scrollTo(0, pos);
        if (pos > tx_scroll_module.scrollTop) {
            let timerIterations = 0;
            const timer = setInterval(function () {
                ++timerIterations;
                tx_scroll_module.scrollTo(0, pos);
                if (pos === tx_scroll_module.scrollTop) {
                    clearInterval(timer);
                }
            }, 20);

            tx_scroll_module.addEventListener('scroll', function () {
                if (timerIterations > 20) {
                    clearInterval(timer);
                }
            });
        }
    }
}

let tx_scroll_module = document.querySelector('body > .module');
if (TYPO3.settings.cache) {
    // v13
    tx_scroll_module = document.querySelector('body > .module > .module-body');
}
const tx_scroll_overflowY = tx_scroll_module ? window.getComputedStyle(tx_scroll_module).overflowY : '';
if (tx_scroll_overflowY !== 'auto' && tx_scroll_overflowY !== 'scroll') {
    // v14: the module markup does not scroll anymore, the document itself does
    tx_scroll_module = document.scrollingElement;
}

/* Prevents jumping after reload*/
window.location.hash = '';

const uid = new URL(window.location.href).searchParams.get('id') ?? '0';

window.addEventListener('pagehide', function () {
    sessionStorage.setItem('ext-scroll-pages-' + uid, tx_scroll_module.scrollTop);
});

const pos = parseInt(sessionStorage.getItem('ext-scroll-pages-' + uid));
if (pos) {
    // behavior 'instant' bypasses the backend's css scroll-behavior:smooth, which
    // would turn this into an interruptible animation
    tx_scroll_module.scrollTo({top: pos, behavior: 'instant'});
    // Content may not be rendered completely yet (module scripts are imported after
    // the load event, so waiting for it is pointless) - retry for a short while
    if (pos !== tx_scroll_module.scrollTop) {
        let timerIterations = 0;
        const timer = setInterval(function () {
            tx_scroll_module.scrollTo({top: pos, behavior: 'instant'});
            if (pos === tx_scroll_module.scrollTop || ++timerIterations > 50) {
                clearInterval(timer);
            }
        }, 40);
        // Stop fighting the user when they scroll themselves
        const cancel = function () {
            clearInterval(timer);
        };
        window.addEventListener('wheel', cancel, {once: true, passive: true});
        window.addEventListener('touchstart', cancel, {once: true, passive: true});
    }
}

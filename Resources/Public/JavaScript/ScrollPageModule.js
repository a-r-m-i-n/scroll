define([], function() {
    return {
        init: function(uid, table, isV10) {
            /* Prevents jumping after reload*/
            location.hash = '';

            const tx_scroll_module = document.querySelector('body > .module' + (isV10 ? ' > .module-body' : ''));

            window.addEventListener('unload', function() {
                sessionStorage.setItem('scroll-' + table + '-' + uid, tx_scroll_module.scrollTop);
            });

            const pos = sessionStorage.getItem('scroll-' + table + '-' + uid);
            if (pos) {
                tx_scroll_module.scrollTo(0, pos);
                if (pos != tx_scroll_module.scrollTop) {
                    window.addEventListener('load', function() {
                        tx_scroll_module.scrollTo(0, pos);
                    });
                }
            }
        }
    }
});

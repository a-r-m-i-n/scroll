define([], function() {
    // Only used in v10. V11 uses the "RecordListScrollHelperEventListener" instead
    return {
        init: function(uid, table, isV10) {
            const tx_scroll_module = document.querySelector('body > .module' + (isV10 ? ' > .module-body' : ''));

            location.hash = '';
            if (table !== '') {
                table = table + '-';
            }
            const storageKey = 'ext-scroll-recordlist-' + table + uid;
            window.addEventListener('unload', function() {
                if (tx_scroll_module.scrollTop > 0) {
                    sessionStorage.setItem(storageKey, tx_scroll_module.scrollTop);
                }
            });
            const pos = sessionStorage.getItem(storageKey);
            if (pos) {
                sessionStorage.removeItem(storageKey);
                tx_scroll_module.scrollTo(0, pos);
                if (pos != tx_scroll_module.scrollTop) {
                    window.addEventListener('load', function() {
                        tx_scroll_module.scrollTo(0, pos);

                        // This happens, when the clipboard in V11 (loaded via AJAX) is appearing
                        if (pos > tx_scroll_module.scrollTop) {
                            var timer = setInterval(function(){
                                tx_scroll_module.scrollTo(0, pos);
                                if (pos == tx_scroll_module.scrollTop) {
                                    clearInterval(timer);
                                }
                            });
                        }
                    });
                }
            }
        }
    }
});

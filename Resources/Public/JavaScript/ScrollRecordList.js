define([], function() {
    // Only used in v10. V11 uses the "RecordListScrollHelperEventListener" instead
    return {
        init: function(uid, isV10) {
            const tx_scroll_module = document.querySelector('body > .module' + (isV10 ? ' > .module-body' : ''));

            location.hash = '';

            window.addEventListener('unload', function() {
                sessionStorage.setItem('ext-scroll-recordlist-' + uid, tx_scroll_module.scrollTop);
            });
            const pos = sessionStorage.getItem('ext-scroll-recordlist-' + uid);
            if (pos) {
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
});

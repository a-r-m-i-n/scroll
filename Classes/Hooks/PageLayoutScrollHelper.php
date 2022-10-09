<?php
declare(strict_types = 1);

namespace T3\Scroll\Hooks;

use TYPO3\CMS\Backend\View\PageLayoutView;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class PageLayoutScrollHelper implements \TYPO3\CMS\Backend\View\PageLayoutViewDrawFooterHookInterface
{
    /**
     * @param PageLayoutView $parentObject
     * @param array $info
     * @param array $row
     * @return void
     */
    public function preProcess(PageLayoutView &$parentObject, &$info, array &$row)
    {
        $table = 'pages';
        $uid = $row['pid'];

        // JavaScript Code
        $js = <<<JS
/* Prevents jumping after reload*/
location.hash = '';

const tx_scroll = {
   table: '$table',
   uid: '$uid',
   module: document.querySelector('body > .module')
};

window.addEventListener('unload', function() {
    sessionStorage.setItem('scroll-' + tx_scroll.table + '-' + tx_scroll.uid, tx_scroll.module.scrollTop);
});
document.addEventListener('DOMContentLoaded', function() {
    const pos = sessionStorage.getItem('scroll-' + table + '-' + tx_scroll.uid);
    if (pos) {
        module.scrollTo(0, pos);
    }
});
JS;
        /** @var PageRenderer $pageRenderer */
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $pageRenderer->addJsFooterInlineCode('ext-scroll', $js);
    }
}

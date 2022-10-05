<?php declare(strict_types = 1);
namespace T3\Scroll\EventListener;


use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Recordlist\Event\ModifyRecordListTableActionsEvent;

class RecordListScrollHelperEventListener
{
    public function __invoke(ModifyRecordListTableActionsEvent $event)
    {
        $uid = (int)($_GET['id'] ?? 0);

        // JavaScript Code
        $js = <<<JS
/* Prevents jumping after reload*/
location.hash = '';

const uid = '$uid';
const module = document.querySelector('body > .module');

window.addEventListener('unload', function() {
    sessionStorage.setItem('scroll-recordlist-' + uid, module.scrollTop);
});
document.addEventListener('DOMContentLoaded', function() {
    const pos = sessionStorage.getItem('scroll-recordlist-' + uid);
    if (pos) {
        module.scrollTo(0, pos);
    }
});
JS;

        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $pageRenderer->addJsFooterInlineCode('ext-scroll', $js);
    }
}

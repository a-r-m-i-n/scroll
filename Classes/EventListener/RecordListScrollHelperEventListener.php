<?php

declare(strict_types = 1);

namespace T3\Scroll\EventListener;

use TYPO3\CMS\Backend\Recordlist\Event\ModifyRecordListTableActionsEvent;
use TYPO3\CMS\Core\Page\PageRenderer;

class RecordListScrollHelperEventListener
{
    public function __construct(private PageRenderer $pageRenderer) {
    }

    public function __invoke(ModifyRecordListTableActionsEvent $event): void
    {
        $this->pageRenderer->loadJavaScriptModule('@vendor/scroll/ScrollRecordList.js');
    }
}

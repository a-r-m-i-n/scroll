<?php

declare(strict_types = 1);

namespace T3\Scroll\EventListener;

use TYPO3\CMS\Backend\Controller\Event\ModifyPageLayoutContentEvent;
use TYPO3\CMS\Core\Page\PageRenderer;

class ModifyPageModuleContentEventListener
{
    public function __construct(private PageRenderer $pageRenderer) {
    }

    public function __invoke(ModifyPageLayoutContentEvent $event): void
    {
        $this->pageRenderer->loadJavaScriptModule('@vendor/scroll/ScrollPageModule.js');
    }
}

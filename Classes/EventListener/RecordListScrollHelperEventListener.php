<?php
declare(strict_types = 1);

namespace T3\Scroll\EventListener;

/*  | This extension is made with love for TYPO3 CMS and is licensed
 *  | under GNU General Public License.
 *  |
 *  | (c) 2022 Armin Vieweg <armin@v.ieweg.de>
 */
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Recordlist\Event\ModifyRecordListTableActionsEvent;

/**
 * Used for TYPO3 11 and higher
 *
 * @see \T3\Scroll\Hooks\RecordListScrollHelper for v10
 */
class RecordListScrollHelperEventListener
{
    public function __invoke(ModifyRecordListTableActionsEvent $event)
    {
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $pageRenderer->addRequireJsConfiguration([
            'paths' => [
                'T3/Scroll/RecordList' => '../../../typo3conf/ext/scroll/Resources/Public/JavaScript/ScrollRecordList',
            ]
        ]);

        $uid = (int)($_GET['id'] ?? 0);
        $table = $_GET['table'] ?? '';
        $pageRenderer->loadRequireJsModule(
            'T3/Scroll/RecordList',
            'function(ScrollRecordList) { ScrollRecordList.init(' . $uid . ', "' . $table . '", false) }'
        );
    }
}

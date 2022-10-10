<?php
declare(strict_types = 1);

namespace T3\Scroll\Hooks;

/*  | This extension is made with love for TYPO3 CMS and is licensed
 *  | under GNU General Public License.
 *  |
 *  | (c) 2022 Armin Vieweg <armin@v.ieweg.de>
 */
use T3\Scroll\EventListener\RecordListScrollHelperEventListener;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Recordlist\RecordList\DatabaseRecordList;
use TYPO3\CMS\Recordlist\RecordList\RecordListHookInterface;

/**
 * Required for TYPO3 10 because there is no "ModifyRecordListTableActionsEvent" existing yet.
 *
 * @see RecordListScrollHelperEventListener
 */
class RecordListScrollHelper implements RecordListHookInterface
{
    /**
     * @param DatabaseRecordList $parentObject
     */
    public function renderListHeaderActions($table, $currentIdList, $cells, &$parentObject)
    {
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $pageRenderer->addRequireJsConfiguration([
            'paths' => [
                'T3/Scroll/RecordList' => '../typo3conf/ext/scroll/Resources/Public/JavaScript/ScrollRecordList'
            ]
        ]);

        $uid = (int)($_GET['id'] ?? 0);
        $pageRenderer->loadRequireJsModule(
            'T3/Scroll/RecordList',
            'function(ScrollRecordList) { ScrollRecordList.init(' . $uid . ', true) }'
        );

        return $cells;
    }

    public function makeClip($table, $row, $cells, &$parentObject)
    {
        return $cells;
    }

    public function makeControl($table, $row, $cells, &$parentObject)
    {
        return $cells;
    }

    public function renderListHeader($table, $currentIdList, $headerColumns, &$parentObject)
    {
        return $headerColumns;
    }
}

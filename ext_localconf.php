<?php

/*  | This extension is made with love for TYPO3 CMS and is licensed
 *  | under GNU General Public License.
 *  |
 *  | (c) 2022 Armin Vieweg <armin@v.ieweg.de>
 */

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawFooter']['ext-scroll'] =
    \T3\Scroll\Hooks\PageLayoutScrollHelper::class;


if (!\T3\Scroll\Compatibility::isVersion('11')) {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['typo3/class.db_list_extra.inc']['actions'][] =
        \T3\Scroll\Hooks\RecordListScrollHelper::class;
}

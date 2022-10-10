<?php
declare(strict_types = 1);

namespace T3\Scroll\Hooks;

/*  | This extension is made with love for TYPO3 CMS and is licensed
 *  | under GNU General Public License.
 *  |
 *  | (c) 2022 Armin Vieweg <armin@v.ieweg.de>
 */
use TYPO3\CMS\Backend\View\PageLayoutView;
use TYPO3\CMS\Backend\View\PageLayoutViewDrawFooterHookInterface;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class PageLayoutScrollHelper implements PageLayoutViewDrawFooterHookInterface
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
        $isV10 = !\T3\Scroll\Compatibility::isVersion('11') ? 'true' : 'false';

        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $pageRenderer->addRequireJsConfiguration([
            'paths' => [
                'T3/Scroll/PageModule' => '../../../typo3conf/ext/scroll/Resources/Public/JavaScript/ScrollPageModule'
            ]
        ]);

        $pageRenderer->loadRequireJsModule(
            'T3/Scroll/PageModule',
            'function(ScrollPageModule) { ScrollPageModule.init(' . $uid . ', "' . $table . '", ' . $isV10 . ') }'
        );
    }
}

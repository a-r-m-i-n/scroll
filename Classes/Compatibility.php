<?php
declare(strict_types = 1);

namespace T3\Scroll;

/*  | This extension is made with love for TYPO3 CMS and is licensed
 *  | under GNU General Public License.
 *  |
 *  | (c) 2022 Armin Vieweg <armin@v.ieweg.de>
 */
use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\VersionNumberUtility;

class Compatibility
{
    public static function isVersion(string $version = '11'): bool
    {
        $typo3Version = GeneralUtility::makeInstance(Typo3Version::class);

        return VersionNumberUtility::convertVersionNumberToInteger($typo3Version->getBranch()) >
            VersionNumberUtility::convertVersionNumberToInteger($version);
    }
}

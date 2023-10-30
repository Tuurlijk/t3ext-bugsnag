<?php

namespace MichielRoos\Bugsnag\Hook;

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\PathUtility;

class Backend
{
    /**
     * Load JavaScript file
     * @return void
     */
    public function addJavaScript(): void
    {
        $publicResourcesPath = PathUtility::getAbsoluteWebPath(ExtensionManagementUtility::extPath('bugsnag') . 'Resources/Public/');

        /** @var \TYPO3\CMS\Core\Page\PageRenderer $pageRenderer */
        $pageRenderer = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Page\PageRenderer::class);
        $pageRenderer->addRequireJsConfiguration([
            'paths' => [
                'Bugsnag' => $publicResourcesPath . 'JavaScript/',
            ]
        ]);
        $pageRenderer->loadRequireJsModule('Bugsnag/testException');
    }
}
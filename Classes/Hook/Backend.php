<?php

namespace MichielRoos\Bugsnag\Hook;

use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Http\ApplicationType;
use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\PathUtility;

class Backend
{
    public function addRequireJsConfiguration(array $params, PageRenderer $pageRenderer): void
    {
        if (($GLOBALS['TYPO3_REQUEST'] ?? null) instanceof ServerRequestInterface
            && ApplicationType::fromRequest($GLOBALS['TYPO3_REQUEST'])->isBackend()
        ) {

            $publicResourcesPath = PathUtility::getAbsoluteWebPath(ExtensionManagementUtility::extPath('bugsnag') . 'Resources/Public/');

            $pageRenderer->addRequireJsConfiguration([
                'paths' => [
                    'Bugsnag' => $publicResourcesPath . 'JavaScript/',
                ]
            ]);
            if ((new Typo3Version())->getMajorVersion() >= 12) {
                $pageRenderer->loadJavaScriptModule('@michielroos/bugsnag/test-exception.js');
            } else {
                $pageRenderer->loadRequireJsModule('Bugsnag/testException');
            }
        }
    }
}
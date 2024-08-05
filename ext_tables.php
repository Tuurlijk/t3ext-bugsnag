<?php

declare(strict_types=1);

use MichielRoos\Bugsnag\Hook\Backend;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die('( ͡ಠ ʖ̯ ͡ಠ)╭∩╮');

$GLOBALS['TYPO3_USER_SETTINGS']['columns']['bugsnagTestException'] = [
    'type'     => 'user',
    'label'    => 'LLL:EXT:bugsnag/Resources/Private/Language/locallang.xlf:bugsnagTestException',
    'userFunc' => function () {
        return '<br><button type="button" class="btn btn-default" onclick="bugsnagTestException()">Generate test exception</button>';
    }
];

ExtensionManagementUtility::addFieldsToUserSettings(
    'LLL:EXT:bugsnag/Resources/Private/Language/locallang.xlf:bugsnagTestException,bugsnagTestException',
    'after:resetConfiguration'
);

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_pagerenderer.php']['render-preProcess'][] =
    Backend::class . '->addRequireJsConfiguration';
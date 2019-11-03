<?php
namespace MichielRoos\Bugsnag\Core\Error;

use Bugsnag\Client;
use Bugsnag\Handler;
use TYPO3\CMS\Core\Core\Environment;

/**
 * Class DebugExceptionHandler
 *
 * Sends Exception to Bugsnag
 *
 * @package MichielRoos\Bugsnag\Core\Error
 */
class DebugExceptionHandler extends \TYPO3\CMS\Core\Error\DebugExceptionHandler
{
    /**
     * Displays the given exception AND sends it to Bugsnag
     *
     * @param \Throwable $exception The throwable object.
     *
     * @throws \Exception
     */
    public function handleException(\Throwable $exception)
    {
        if (version_compare(TYPO3_version, '9.0', '<')) {
            $extensionConfiguration = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['bugsnag'], ['string']);
        } else {
            $extensionConfiguration = $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['bugsnag'];
        }

        $bugsnagApiKey = $extensionConfiguration['apiKey'] ?: (getenv('BUGSNAG_API_KEY') ?: '');

        if ($bugsnagApiKey !== '') {
            $bugsnag = Client::make($bugsnagApiKey);

            // Set app type
            if (PHP_SAPI === 'cli') {
                $bugsnag->setAppType('Cli');
            } else {
                $bugsnag->setAppType('Web');
            }

            // Set context
            if (version_compare(TYPO3_version, '9.0', '<')) {
                $context = getenv('TYPO3_CONTEXT') ?: (getenv('REDIRECT_TYPO3_CONTEXT') ?: 'Production');
            } else {
                $context = Environment::getContext();
            }
            $bugsnag->setReleaseStage((string)$context);

            Handler::register($bugsnag);
            $bugsnag->notifyException($exception);
        }
        parent::handleException($exception);
    }
}

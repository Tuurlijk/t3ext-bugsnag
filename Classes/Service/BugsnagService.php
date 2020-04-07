<?php
namespace MichielRoos\Bugsnag\Service;

use Bugsnag\Client;
use Bugsnag\Handler;

/**
 * Class BugsnagService
 *
 * Sends Exception to Bugsnag
 *
 * @package MichielRoos\Bugsnag\Service
 */
class BugsnagService
{
    /**
     * Sends exception to Bugsnag
     *
     * @param \Exception $exception
     */
    public function sendException(\Throwable $exception)
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
                $context = \TYPO3\CMS\Core\Core\Environment::getContext();
            }
            $bugsnag->setReleaseStage((string)$context);

            Handler::register($bugsnag);
            $bugsnag->notifyException($exception);
            $bugsnag->flush();
        }
    }
}

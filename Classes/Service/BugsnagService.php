<?php
namespace MichielRoos\Bugsnag\Service;

use Bugsnag\Client;
use Bugsnag\Handler;
use TYPO3\CMS\Core\Core\Environment;

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
    public function sendException(\Throwable $exception): void
    {
        $extensionConfiguration = $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['bugsnag'];
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
            $context = Environment::getContext();
            $bugsnag->setReleaseStage((string)$context);

            Handler::register($bugsnag);
            $bugsnag->notifyException($exception);
            $bugsnag->flush();
        }
    }
}

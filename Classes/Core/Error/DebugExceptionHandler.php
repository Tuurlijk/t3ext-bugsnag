<?php
namespace MichielRoos\Bugsnag\Core\Error;

use MichielRoos\Bugsnag\Service\BugsnagService;
use TYPO3\CMS\Core\Utility\GeneralUtility;

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
        $bugsnagService = GeneralUtility::makeInstance(BugsnagService::class);
        $bugsnagService->sendException($exception);
        parent::handleException($exception);
    }
}

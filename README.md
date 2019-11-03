# Bugsnag Exception Handlers for TYPO3 CMS

Bugsnag exception handlers, send exceptions to bugsnag

## Configuration

Configure the [Bugsnag API key](https://app.bugsnag.com/) in the TYPO3 extension configuration screen or make it availabe in your environment as `BUGSNAG_API_KEY`.

Set the exceptionhandlers to use the Bugsnag exception handlers either using the install tool or by specifying them in `AdditionalConfiguration.php`.

```php
<?php
# AdditionalConfiguration.php

$GLOBALS['TYPO3_CONF_VARS']['SYS']['debugExceptionHandler'] = \MichielRoos\Bugsnag\Core\Error\DebugExceptionHandler::class;
$GLOBALS['TYPO3_CONF_VARS']['SYS']['productionExceptionHandler'] = \MichielRoos\Bugsnag\Core\Error\ProductionExceptionHandler::class;
```

## Issues

Please [report issues you find](https://github.com/Tuurlijk/t3ext-bugsnag/issues).

# Bugsnag Exception Handlers for TYPO3 CMS

Bugsnag exception handlers, send exceptions to bugsnag

## Configuration

### Genral exceptions
Configure the [Bugsnag API key](https://app.bugsnag.com/) in the TYPO3 extension configuration screen or make it availabe in your environment as `BUGSNAG_API_KEY`.

Set the exceptionhandlers to use the Bugsnag exception handlers either using the install tool or by specifying them in `AdditionalConfiguration.php`.

```php
<?php
# AdditionalConfiguration.php

$GLOBALS['TYPO3_CONF_VARS']['SYS']['debugExceptionHandler'] = \MichielRoos\Bugsnag\Core\Error\DebugExceptionHandler::class;
$GLOBALS['TYPO3_CONF_VARS']['SYS']['productionExceptionHandler'] = \MichielRoos\Bugsnag\Core\Error\ProductionExceptionHandler::class;
```

### Exceptions thrown by content elements
The [content exception handler](https://docs.typo3.org/m/typo3/reference-typoscript/master/en-us/Setup/Config/Index.html#contentobjectexceptionhandler) can be specified in TypoScript. Exceptions which occur during rendering of content objects (typically plugins) will be caught by default in production context and an error message is shown along with the rendered output.
                                                                                                                                                                                        
The page will remain available while the section of the page that produces an error (i.e. throws an exception) will show a configurable error message. By default this error message contains a random code which references the exception and is also logged by the logging framework for developer reference.

```
# Use 1 for the default exception handler (enabled by default in production context)
config.contentObjectExceptionHandler = 1

# Use a class name for individual exception handlers
config.contentObjectExceptionHandler = MichielRoos\Bugsnag\ContentObject\Exception\ProductionExceptionHandler
```

## Issues

Please [report issues you find](https://github.com/Tuurlijk/t3ext-bugsnag/issues).

function bugsnagTestException() {
    console.log('Firing off Bugsnag test exception on AJAX route "bugsnag_test" . . . ' + TYPO3.settings.ajaxUrls['bugsnag_test']);
    window.top.location = TYPO3.settings.ajaxUrls['bugsnag_test'];
}

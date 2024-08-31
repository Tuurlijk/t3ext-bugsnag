document.addEventListener('click', function name(e) {
    if (e.target.matches('#testBugsnagException')) {
        console.log('Firing off Bugsnag test exception on AJAX route "bugsnag_test" . . . ' + TYPO3.settings.ajaxUrls['bugsnag_test']);
        window.top.location = TYPO3.settings.ajaxUrls['bugsnag_test'];
    }
});
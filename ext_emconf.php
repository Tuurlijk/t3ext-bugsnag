<?php
$EM_CONF['bugsnag'] = [
    'title'          => 'Bugsnag exception handler',
    'description'    => 'Bugsnag exception handler, sends exceptions to bugsnag',
    'category'       => 'fe',
    'author'         => 'Michiel Roos',
    'author_company' => 'Michiel Roos',
    'author_email'   => 'michiel@michielroos.com',
    'state'          => 'stable',
    'version'        => 'v11.0.0',
    'constraints'    => [
        'depends'   => [
            'typo3' => '11.5.0-9.5.99',
        ],
        'conflicts' => [],
        'suggests'  => [],
    ],
    'autoload'       => [
        'psr-4' => ['MichielRoos\\Busnag\\' => 'Classes']
    ]
];

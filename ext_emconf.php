<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Scroll',
    'description' => 'Prevents scroll jumps in TYPO3 CMS backend.',
    'category' => 'backend',
    'author' => 'Armin Vieweg',
    'author_email' => 'armin@v.ieweg.de',
    'version' => '2.1.0',
    'state' => 'stable',
    'constraints' => [
        'depends' => [
            'typo3' => '12.4.0-14.99.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];

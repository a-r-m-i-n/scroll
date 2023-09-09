<?php

$EM_CONF[$_EXTKEY] = array(
    'title' => 'Scroll',
    'description' => 'Prevents scroll jumps in TYPO3 CMS backend.',
    'category' => 'backend',
    'author' => 'Armin Vieweg',
    'author_email' => 'armin@v.ieweg.de',
    'version' => '2.0.1',
    'state' => 'stable',
    'constraints' =>
        [
            'depends' =>
                [
                    'typo3' => '12.4.0-12.4.99',
                ],
            'conflicts' =>
                [
                ],
            'suggests' =>
                [
                ],
        ],
);


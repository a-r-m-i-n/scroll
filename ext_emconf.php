<?php

$EM_CONF[$_EXTKEY] = array (
	'title' => 'Scroll',
	'description' => 'Prevents scroll jumps in TYPO3 CMS backend.',
	'category' => 'backend',
    'author' => 'Armin Vieweg',
    'author_email' => 'armin@v.ieweg.de',
	'version' => '1.0.4',
	'state' => 'stable',
	'constraints' =>
	[
		'depends' =>
		[
			'typo3' => '10.4.0-11.5.99',
        ],
		'conflicts' =>
		[
        ],
		'suggests' =>
		[
        ],
    ],
);


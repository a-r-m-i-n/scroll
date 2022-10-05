<?php

$EM_CONF[$_EXTKEY] = array (
	'title' => 'Scroll',
	'description' => 'Prevents scroll jumps in TYPO3 CMS backend',
	'category' => 'backend',
	'version' => '0.0.0-dev',
	'state' => 'beta',
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


<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Configure your TYPO3 site using YAML files',
    'description' => 'Export and import any table to and from a YAML file.',
    'category' => 'BE',
    'author' => 'Josef Glatz, Volker Kemeter, Michiel Roos',
    'author_email' => 'j.glatz@supseven.at, v.kemeter@supseven.at, michiel@michielroos.com',
    'state' => 'stable',
    'uploadfolder' => 0,
    'clearCacheOnLoad' => 1,
    'version' => '2.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.0-12.4.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];

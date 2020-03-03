<?php
declare(strict_types = 1);

return [
    'yaml_export' => [
        'path'       => '/yaml/export',
        'target'     => \Supseven\YamlConfiguration\Service\YamlExportService::class .'::export',
        'parameters' => [
        ]
    ],
];

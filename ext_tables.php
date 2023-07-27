<?php

defined('TYPO3_MODE') || defined('TYPO3') || die('Access denied.');

call_user_func(
    function ($extKey) {
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['Backend\Template\Components\ButtonBar']['getButtonsHook'][1583231947]
            = \Supseven\YamlConfiguration\Hooks\Backend\ButtonBar\YamlExportButton::class .'->addYamlExportButton';

    },
    'yaml_configuration'
);

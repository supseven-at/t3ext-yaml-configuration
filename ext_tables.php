<?php

defined('TYPO3_MODE') || defined('TYPO3') || die('Access denied.');

call_user_func(
    function ($extKey) {

        /**
         * Add YamlExportButton in TYPO3 11.5
         *
         * @todo: When removing TYPO3 11 support: delete Hook getButtonsHook
         */
        /** @var \TYPO3\CMS\Core\Information\Typo3Version $version */
        $version = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Information\Typo3Version::class);
        if ($version->getMajorVersion() < 12) {
            $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['Backend\Template\Components\ButtonBar']['getButtonsHook'][1583231947]
                = \Supseven\YamlConfiguration\Backend\ButtonBar\YamlExportButton::class .'->addYamlExportButton';
        }
    },
    'yaml_configuration'
);

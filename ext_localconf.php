<?php

use Arcadia\Fepanel\Controller\SettingsController;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die('Access denied.');

/***************
 * Add default RTE configuration
 */
$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['fepanel'] = 'EXT:fepanel/Configuration/RTE/Default.yaml';

/***************
 * PageTS
 */
ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:fepanel/Configuration/TsConfig/Page/All.tsconfig">');

ExtensionUtility::configurePlugin(
   'Fepanel',
   'Settings',
    [
        SettingsController::class => 'addForm, list, show, add',
    ],
    [
        SettingsController::class => 'addForm, list, show, add',
    ]
);

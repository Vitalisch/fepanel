<?php
defined('TYPO3') or die('Access denied.');
/***************
 * Add default RTE configuration
 */
$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['fepanel'] = 'EXT:fepanel/Configuration/RTE/Default.yaml';

/***************
 * PageTS
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:fepanel/Configuration/TsConfig/Page/All.tsconfig">');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
   'Fepanel',
   'Settings',
    [
        \Arcadia\Fepanel\Controller\SettingsController::class => 'addForm, list, show, add',
    ],
    [
        \Arcadia\Fepanel\Controller\SettingsController::class => 'addForm, list, show, add',
    ]
);

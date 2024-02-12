<?php

defined('TYPO3') or die('Access denied.');

return [
    'ctrl' => [
        'title' => 'Settings',
        'label' => 'title',
        'sortby' => 'sorting',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => true,
        'default_sortby' => 'ORDER BY title',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'typeicon_classes' => [
            'default' => 'actions-check'
        ],
        'searchFields' => 'uid,title',
    ],
    'interface' => [
        'showRecordFieldList' => '
            hidden,
            title,
            description,
        ',
    ],
    'columns' => [
        'hidden' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
        'title' => [
            'label' => 'Title',
            'config' => [
                'type' => 'input',
                'max' => 50,
            ],
        ],
        'description' => [
            'label' => 'Beschreibung',
            'config' => [
                'type' => 'text',
            ],
        ],
        'profile_image' => [
            'label' => 'Profile Image',
            'config' => [
                'type' => 'input',
                'max' => 255,
            ],
        ],
        'user' => [
            'label' => 'User',
            'config' => [
                'type' => 'input',
                'max' => 255,
            ],
        ],
    ],
    'types' => [
        0 => [
            'showitem' => '
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                    hidden,
                    title,
                    description,
                    profile_image,
                    user
            ',
        ],
    ],
];

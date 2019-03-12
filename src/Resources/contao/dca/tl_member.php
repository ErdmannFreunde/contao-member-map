<?php


/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_member']['palettes']['default'] .= ',geo_latitude,geo_longitude';


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_member']['fields']['geo_latitude'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_member']['geo_latitude'],
    'exclude'   => true,
    'inputType' => 'text',
    'eval'      => ['tl_class' => 'w50'],
    'sql'       => "varchar(64) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_member']['fields']['geo_longitude'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_member']['geo_longitude'],
    'exclude'   => true,
    'inputType' => 'text',
    'eval'      => ['tl_class' => 'w50'],
    'sql'       => "varchar(64) NOT NULL default ''"
];

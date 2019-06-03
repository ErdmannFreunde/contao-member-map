<?php


/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['member_map'] =
    '{title_legend},name,headline,type;{config_legend},mapMemberGroups,mapPlaceTitle;{template_legend:hide},navigationTpl,customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['mapMemberGroups'] = [
    'label'      => &$GLOBALS['TL_LANG']['tl_module']['mapMemberGroups'],
    'exclude'    => true,
    'inputType'  => 'select',
    'eval'       => ['tl_class' => 'w50', 'multiple' => true, 'chosen' => true],
    'foreignKey' => 'tl_member_group.name',
    'sql'        => 'blob NULL'
];

$GLOBALS['TL_DCA']['tl_module']['fields']['mapPlaceTitle'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_module']['mapPlaceTitle'],
    'exclude'   => true,
    'inputType' => 'text',
    'eval'      => ['tl_class' => 'w50', 'chosen' => true, 'decodeEntities' => true],
    'sql'       => "varchar(255) NOT NULL default ''"
];

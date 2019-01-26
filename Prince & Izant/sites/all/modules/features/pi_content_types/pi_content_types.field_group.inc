<?php
/**
 * @file
 * pi_content_types.field_group.inc
 */

/**
 * Implements hook_field_group_info().
 */
function pi_content_types_field_group_info() {
  $field_groups = array();

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_columns_2|paragraphs_item|table_section|default';
  $field_group->group_name = 'group_columns_2';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'table_section';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_top';
  $field_group->data = array(
    'label' => 'Columns',
    'weight' => '1',
    'children' => array(
      0 => 'field_title',
      1 => 'field_text',
    ),
    'format_type' => 'div',
    'format_settings' => array(
      'label' => 'Columns',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'columns',
        'description' => '',
        'show_label' => '0',
        'label_element' => 'h3',
        'effect' => 'none',
        'speed' => 'fast',
      ),
      'formatter' => 'open',
    ),
  );
  $field_groups['group_columns_2|paragraphs_item|table_section|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_columns|paragraphs_item|table_section|default';
  $field_group->group_name = 'group_columns';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'table_section';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_middle';
  $field_group->data = array(
    'label' => 'Columns',
    'weight' => '11',
    'children' => array(
      0 => 'field_table',
      1 => 'field_notes',
    ),
    'format_type' => 'div',
    'format_settings' => array(
      'label' => 'Columns',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'columns',
        'description' => '',
        'show_label' => '0',
        'label_element' => 'h3',
        'effect' => 'none',
        'speed' => 'fast',
      ),
      'formatter' => 'open',
    ),
  );
  $field_groups['group_columns|paragraphs_item|table_section|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_middle|paragraphs_item|table_section|default';
  $field_group->group_name = 'group_middle';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'table_section';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_table_wrapper';
  $field_group->data = array(
    'label' => 'Middle Content',
    'weight' => '6',
    'children' => array(
      0 => 'group_columns',
    ),
    'format_type' => 'div',
    'format_settings' => array(
      'label' => 'Middle Content',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'row',
        'description' => '',
        'show_label' => '0',
        'label_element' => 'h3',
        'effect' => 'none',
        'speed' => 'fast',
      ),
      'formatter' => 'open',
    ),
  );
  $field_groups['group_middle|paragraphs_item|table_section|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_table_wrapper|paragraphs_item|table_section|default';
  $field_group->group_name = 'group_table_wrapper';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'table_section';
  $field_group->mode = 'default';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Table wrapper',
    'weight' => '2',
    'children' => array(
      0 => 'group_middle',
    ),
    'format_type' => 'div',
    'format_settings' => array(
      'label' => 'Table wrapper',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'group-table-wrapper',
        'description' => '',
        'show_label' => '0',
        'label_element' => 'h3',
        'effect' => 'none',
        'speed' => 'fast',
      ),
      'formatter' => 'open',
    ),
  );
  $field_groups['group_table_wrapper|paragraphs_item|table_section|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_top|paragraphs_item|table_section|default';
  $field_group->group_name = 'group_top';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'table_section';
  $field_group->mode = 'default';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Top Content',
    'weight' => '1',
    'children' => array(
      0 => 'group_columns_2',
    ),
    'format_type' => 'div',
    'format_settings' => array(
      'label' => 'Top Content',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'row',
        'description' => '',
        'show_label' => '0',
        'label_element' => 'h3',
        'effect' => 'none',
        'speed' => 'fast',
      ),
      'formatter' => 'open',
    ),
  );
  $field_groups['group_top|paragraphs_item|table_section|default'] = $field_group;

  // Translatables
  // Included for use with string extractors like potx.
  t('Columns');
  t('Middle Content');
  t('Table wrapper');
  t('Top Content');

  return $field_groups;
}

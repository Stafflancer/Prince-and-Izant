<?php
/**
 * @file
 * pi_content_types.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function pi_content_types_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "field_group" && $api == "field_group") {
    return array("version" => "1");
  }
  if ($module == "video_embed_field" && $api == "default_video_embed_styles") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_node_info().
 */
function pi_content_types_node_info() {
  $items = array(
    'about_us' => array(
      'name' => t('About us'),
      'base' => 'node_content',
      'description' => '',
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
    'contact_us' => array(
      'name' => t('Contact us'),
      'base' => 'node_content',
      'description' => '',
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
    'homepage' => array(
      'name' => t('Homepage'),
      'base' => 'node_content',
      'description' => '',
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
    'market' => array(
      'name' => t('Market'),
      'base' => 'node_content',
      'description' => '',
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
    'news' => array(
      'name' => t('News'),
      'base' => 'node_content',
      'description' => '',
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
    'product' => array(
      'name' => t('Product'),
      'base' => 'node_content',
      'description' => '',
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
  );
  drupal_alter('node_info', $items);
  return $items;
}

/**
 * Implements hook_paragraphs_info().
 */
function pi_content_types_paragraphs_info() {
  $items = array(
    '1_image_section' => array(
      'name' => '1 Image Section',
      'bundle' => '1_image_section',
      'locked' => '1',
    ),
    '2_images_section' => array(
      'name' => '2 Images Section',
      'bundle' => '2_images_section',
      'locked' => '1',
    ),
    'about_us_subsidiaries_section' => array(
      'name' => 'About Us Subsidiaries Section',
      'bundle' => 'about_us_subsidiaries_section',
      'locked' => '1',
    ),
    'advantages_section' => array(
      'name' => 'Advantages Section',
      'bundle' => 'advantages_section',
      'locked' => '1',
    ),
    'banner' => array(
      'name' => 'Banner',
      'bundle' => 'banner',
      'locked' => '1',
    ),
    'cards_section' => array(
      'name' => 'Cards Section',
      'bundle' => 'cards_section',
      'locked' => '1',
    ),
    'cards_slider_section' => array(
      'name' => 'Cards Slider Section',
      'bundle' => 'cards_slider_section',
      'locked' => '1',
    ),
    'homepage_markets_section' => array(
      'name' => 'Homepage Markets Section',
      'bundle' => 'homepage_markets_section',
      'locked' => '1',
    ),
    'homepage_news_link_section' => array(
      'name' => 'Homepage News+Link Section',
      'bundle' => 'homepage_news_link_section',
      'locked' => '1',
    ),
    'homepage_products_section' => array(
      'name' => 'Homepage Products Section',
      'bundle' => 'homepage_products_section',
      'locked' => '1',
    ),
    'homepage_text_section' => array(
      'name' => 'Text Section',
      'bundle' => 'homepage_text_section',
      'locked' => '1',
    ),
    'image_l_text_r_section' => array(
      'name' => 'Image L / Text R Section',
      'bundle' => 'image_l_text_r_section',
      'locked' => '1',
    ),
    'table_section' => array(
      'name' => 'Table Section',
      'bundle' => 'table_section',
      'locked' => '1',
    ),
    'text_icons_section' => array(
      'name' => 'Text + Icons Section',
      'bundle' => 'text_icons_section',
      'locked' => '1',
    ),
    'text_l_image_r_section' => array(
      'name' => 'Text L / Image R Section',
      'bundle' => 'text_l_image_r_section',
      'locked' => '1',
    ),
    'video_section' => array(
      'name' => 'Video Section',
      'bundle' => 'video_section',
      'locked' => '1',
    ),
  );
  return $items;
}

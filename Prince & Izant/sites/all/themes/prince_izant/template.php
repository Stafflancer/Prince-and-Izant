<?php

/**
 * Add body classes if certain regions have content.
 */
function prince_izant_preprocess_html(&$vars) {
}

/**
 * Override or insert variables into the page template.
 */
function prince_izant_preprocess_page(&$vars) {
  $banner_node = node_load(3);
  $vars['news_page_banner'] = node_view($banner_node, 'full');

  if (isset($vars['node']->type) && !drupal_is_front_page()) {
    $node = $vars['node'];

    // BANNER TO TOP IF HE FIRST
    $sections_field_name = 'field_' . $node->type . '_sections';

    if (!empty($node->{$sections_field_name}[LANGUAGE_NONE][0]['value'])) {
      // Eid var
      $first_section_eid = $node->{$sections_field_name}[LANGUAGE_NONE][0]['value'];
      // Load section entity
      $section = entity_load('paragraphs_item', array($first_section_eid))[$first_section_eid];
      // Section ID
      $section_id = $section->bundle;
      // Check if banner
      if ($section_id == 'banner') {
        $vars['page_banner'] = prince_izant_theme_generate_section($first_section_eid);
        unset($vars['node']->{$sections_field_name}[LANGUAGE_NONE][0]);
      }
    }
  }

  // Breadcrumbs
  if (!drupal_is_front_page()) {
    $breadcrumb = array();
    $breadcrumb[] = prince_izant_theme_set_breadcrumb_item('主页', '/');

    if (isset($vars['node']->type)) {
      $node = $vars['node'];

      switch ($node->type) {
        case 'market':
          $breadcrumb[] = prince_izant_theme_set_breadcrumb_item($node->title);
          break;
        case 'product':
          $breadcrumb[] = prince_izant_theme_set_breadcrumb_item('产品');
          break;
        case 'news':
          $breadcrumb[] = prince_izant_theme_set_breadcrumb_item('新闻');
          break;
        
        default:
          $breadcrumb[] = prince_izant_theme_set_breadcrumb_item($node->title);
          break;
      }
    } else {
      $breadcrumb[] = prince_izant_theme_set_breadcrumb_item(drupal_get_title());
    }

    drupal_set_breadcrumb($breadcrumb);
  }
}

/**
 * Override or insert variables into the node template.
 */
function prince_izant_preprocess_node(&$vars) {
  $sections = array();


  if (!empty($vars['field_' . $vars['type'] . '_sections'])) {
    foreach ($vars['field_' . $vars['type'] . '_sections'] as $key => $value) {
      // Generate sections array
      if (!empty($value['value'])) {
        $sections[] = prince_izant_theme_generate_section($value['value']);
      }
    }
  }

  $vars['sections'] = $sections;
}

/**
 * Override or insert variables into the block template.
 */
function prince_izant_preprocess_block(&$vars) {
}

/**
 * Implements hook_breadcrumb().
 */
function prince_izant_breadcrumb($vars) {
  $breadcrumb = $vars['breadcrumb'];

  if (!empty($breadcrumb)) {
    $output = '<ul id="breadcrumb">' . implode('<span class="separate"></span>', $breadcrumb) . '</ul>';
    return $output;
  }
}

/**
 * Set breadcrumb item.
 */
function prince_izant_theme_set_breadcrumb_item($name, $url = FALSE, $fragment = '') {
  $output = '<li>';
  if (!$url) {
    $output .= $name ;
  } else {
    $output .= l(
      $name, 
      $url, 
      array(
        'html' => TRUE,
        'fragment' => $fragment,
        'attributes' => array(),
      )
    );
  }
  $output .= '</li>';

  return $output;
}

/**
 * Render image.
 */
function prince_izant_theme_render_img($img_arr, $image_style, $attributes = array()) {

  $img_options = array(
    'style_name' => $image_style,
    'width'      => '',
    'height'     => '',
    'path'       => $img_arr['uri'],
    'attributes' => $attributes,
    'alt'        => $img_arr['alt'],
    'title'      => $img_arr['title'],
  );

  return theme_image_style($img_options);
}

/**
 * Generate section.
 */
function prince_izant_theme_generate_section($pi_eid) {
  // Load section entity
  $section = entity_load('paragraphs_item', array($pi_eid))[$pi_eid];
  // Section ID
  $section_id = $section->bundle;
  // Section array
  $section_output = array(
    'id' => $section_id,
  );

  // dpm($section);

  switch ($section_id) {
    case 'banner':
      // Banners
      if (!empty($section->field_banners[LANGUAGE_NONE])) {
        foreach ($section->field_banners[LANGUAGE_NONE] as $key => $value) {
          $fc_id = $value['value'];
          $fc_item = field_collection_item_load($fc_id);

          $item = array();

          // Title
          $item['title'] = empty($fc_item->field_title[LANGUAGE_NONE][0]['value']) ? '' : $fc_item->field_title[LANGUAGE_NONE][0]['value'];
          // Subtitle
          $item['subtitle'] = empty($fc_item->field_subtitle[LANGUAGE_NONE][0]['value']) ? '' : $fc_item->field_subtitle[LANGUAGE_NONE][0]['value'];
          // Desctop image
          if (!empty($fc_item->field_image_desktop[LANGUAGE_NONE][0]['uri'])) {
            $attributes = array('class' => 'for-desktop');
            $item['desktop_img'] = prince_izant_theme_render_img($fc_item->field_image_desktop[LANGUAGE_NONE][0], 'crop', $attributes);
          } else {
            $item['desktop_img'] = '';
          }
          // Mobile image
          if (!empty($fc_item->field_image_mobile[LANGUAGE_NONE][0]['uri'])) {
            $attributes = array('class' => 'for-mobile');
            $item['mobile_img'] = prince_izant_theme_render_img($fc_item->field_image_mobile[LANGUAGE_NONE][0], 'crop', $attributes);
          } else {
            $item['mobile_img'] = '';
          }

          $section_output['banners'][] = $item;
        }
      }
      break;
    case 'homepage_markets_section':
      // Title
      $section_output['title'] = empty($section->field_title[LANGUAGE_NONE][0]['value']) ? '' : $section->field_title[LANGUAGE_NONE][0]['value'];
      // Text
      $section_output['text'] = empty($section->field_text[LANGUAGE_NONE][0]['value']) ? '' : $section->field_text[LANGUAGE_NONE][0]['value'];
      // Markets
      if (!empty($section->field_markets[LANGUAGE_NONE])) {
        foreach ($section->field_markets[LANGUAGE_NONE] as $key => $market) {
          $market = $market['entity'];

          $market_output = array();
          
          $market_output['title'] = $market->title;
          $market_output['path'] = drupal_get_path_alias('node/' . $market->nid);

          if (!empty($market->field_image_desktop[LANGUAGE_NONE][0]['uri'])) {
            $attributes = array('class' => 'for-desktop');
            $market_output['desktop_img'] = prince_izant_theme_render_img($market->field_image_desktop[LANGUAGE_NONE][0], 'market', $attributes);
          } else {
            $market_output['desktop_img'] = '';
          }

          if (!empty($market->field_image_mobile[LANGUAGE_NONE][0]['uri'])) {
            $attributes = array('class' => 'for-mobile');
            $market_output['mobile_img'] = prince_izant_theme_render_img($market->field_image_mobile[LANGUAGE_NONE][0], 'market', $attributes);
          } else {
            $market_output['mobile_img'] = '';
          }

          $section_output['markets_list'][] = $market_output;
        }
      }
      break;
      case 'homepage_products_section':
        // Title
        $section_output['title'] = empty($section->field_title[LANGUAGE_NONE][0]['value']) ? '' : $section->field_title[LANGUAGE_NONE][0]['value'];
        // Link
        $section_output['link'] = empty($section->field_link[LANGUAGE_NONE][0]) ? '' : $section->field_link[LANGUAGE_NONE][0];
        // Products
        if (!empty($section->field_products_list[LANGUAGE_NONE])) {
          $products = array();

          foreach ($section->field_products_list[LANGUAGE_NONE] as $key => $value) {
            $fc_id = $value['value'];
            $fc_item = field_collection_item_load($fc_id);

            $item = array();

            // Title
            $item['title'] = empty($fc_item->field_title[LANGUAGE_NONE][0]['value']) ? '' : $fc_item->field_title[LANGUAGE_NONE][0]['value'];
            // Image caption
            $item['image_caption'] = empty($fc_item->field_image_caption[LANGUAGE_NONE][0]['value']) ? '' : $fc_item->field_image_caption[LANGUAGE_NONE][0]['value'];
            // Desctop image
            if (!empty($fc_item->field_image_desktop[LANGUAGE_NONE][0]['uri'])) {
              $attributes = array('class' => 'for-desktop');
              $item['desktop_img'] = prince_izant_theme_render_img($fc_item->field_image_desktop[LANGUAGE_NONE][0], 'product', $attributes);
            } else {
              $item['desktop_img'] = '';
            }
            // Mobile image
            if (!empty($fc_item->field_image_mobile[LANGUAGE_NONE][0]['uri'])) {
              $attributes = array('class' => 'for-mobile');
              $item['mobile_img'] = prince_izant_theme_render_img($fc_item->field_image_mobile[LANGUAGE_NONE][0], 'product', $attributes);
            } else {
              $item['mobile_img'] = '';
            }

            $products[] = $item;
          }

          $section_output['products_list'] = array_chunk($products, 5);
        }
        break;
      case 'homepage_text_section':
        // Title
        $section_output['title'] = empty($section->field_title[LANGUAGE_NONE][0]['value']) ? '' : $section->field_title[LANGUAGE_NONE][0]['value'];
        // Text
        $section_output['text'] = empty($section->field_text[LANGUAGE_NONE][0]['value']) ? '' : $section->field_text[LANGUAGE_NONE][0]['value'];
        break;
      case 'homepage_news_link_section':
        // News section title
        $section_output['news_section_title'] = empty($section->field_news_section_title[LANGUAGE_NONE][0]['value']) ? '' : $section->field_news_section_title[LANGUAGE_NONE][0]['value'];
        // Link section title
        $section_output['link_section_title'] = empty($section->field_link_section_title[LANGUAGE_NONE][0]['value']) ? '' : $section->field_link_section_title[LANGUAGE_NONE][0]['value'];
        // Link section bg
        $section_output['bg_link_section_uri'] = empty($section->field_image[LANGUAGE_NONE][0]['uri']) ? '' : $section->field_image[LANGUAGE_NONE][0]['uri'];
        // Icon
        $section_output['icon']['uri'] = empty($section->field_icon[LANGUAGE_NONE][0]['uri']) ? '' : $section->field_icon[LANGUAGE_NONE][0]['uri'];
        $section_output['icon']['alt'] = empty($section->field_icon[LANGUAGE_NONE][0]['alt']) ? '' : $section->field_icon[LANGUAGE_NONE][0]['alt'];
        $section_output['icon']['title'] = empty($section->field_icon[LANGUAGE_NONE][0]['title']) ? '' : $section->field_icon[LANGUAGE_NONE][0]['title'];
        break;
      case 'about_us_subsidiaries_section':
        // Title
        $section_output['title'] = empty($section->field_title[LANGUAGE_NONE][0]['value']) ? '' : $section->field_title[LANGUAGE_NONE][0]['value'];
        // SUBSIDIARIES
        if (!empty($section->field_subsidiaries[LANGUAGE_NONE])) {
          $subsidiaries = array();

          foreach ($section->field_subsidiaries[LANGUAGE_NONE] as $key => $value) {
            $fc_id = $value['value'];
            $fc_item = field_collection_item_load($fc_id);
            // dpm($fc_item);

            $subsidiarie_output = array();
            
            // Text
            $subsidiarie_output['text'] = !empty($fc_item->field_text[LANGUAGE_NONE][0]['value']) ?
              $fc_item->field_text[LANGUAGE_NONE][0]['value'] : '';

            // Desctop image
            if (!empty($fc_item->field_image_desktop[LANGUAGE_NONE][0]['uri'])) {
              $attributes = array(
                'class' => 'for-desktop'
              );
              $subsidiarie_output['desktop_img'] = prince_izant_theme_render_img($fc_item->field_image_desktop[LANGUAGE_NONE][0], 'about_us', $attributes);
            } else {
              $subsidiarie_output['desktop_img'] = '';
            }

            // Mobile image
            if (!empty($fc_item->field_image_mobile[LANGUAGE_NONE][0]['uri'])) {
              $attributes = array(
                'class' => 'for-mobile'
              );
              $subsidiarie_output['mobile_img'] = prince_izant_theme_render_img($fc_item->field_image_mobile[LANGUAGE_NONE][0], 'about_us', $attributes);
            } else {
              $subsidiarie_output['mobile_img'] = '';
            }

            // Categories
            if (!empty($fc_item->field_categories[LANGUAGE_NONE])) {
              foreach ($fc_item->field_categories[LANGUAGE_NONE] as $key => $term) {
                $term_id = $term['tid'];
                $categorie = array();

                $categorie['title'] = taxonomy_term_load($term_id)->name;

                $term_childrens = taxonomy_get_children($term_id);
                
                if (!empty($term_childrens)) {
                  foreach ($term_childrens as $key => $term_children) {
                    $categorie['subcategories'][] = $term_children->name;
                  }
                }

                $subsidiarie_output['categories'][] = $categorie;
              }
            }

            $section_output['subsidiaries'][] = $subsidiarie_output;
          }
        }
        break;
      case 'cards_slider_section':
        // Title
        $section_output['title'] = empty($section->field_title[LANGUAGE_NONE][0]['value']) ? '' : $section->field_title[LANGUAGE_NONE][0]['value'];
        // Text
        $section_output['text'] = empty($section->field_text[LANGUAGE_NONE][0]['value']) ? '' : $section->field_text[LANGUAGE_NONE][0]['value'];
        // SLIDER CARDS
        if (!empty($section->field_cards[LANGUAGE_NONE])) {
          $cards = array();

          foreach ($section->field_cards[LANGUAGE_NONE] as $key => $value) {
            $fc_id = $value['value'];
            $fc_item = field_collection_item_load($fc_id);
            // dpm($fc_item);

            $card_output = array();
            
            // Text
            $card_output['text'] = !empty($fc_item->field_text[LANGUAGE_NONE][0]['value']) ?
              $fc_item->field_text[LANGUAGE_NONE][0]['value'] : '';

            // Desctop image
            if (!empty($fc_item->field_image_desktop[LANGUAGE_NONE][0]['uri'])) {
              $attributes = array(
                'class' => 'for-desktop'
              );
              $card_output['desktop_img'] = prince_izant_theme_render_img($fc_item->field_image_desktop[LANGUAGE_NONE][0], 'market_slide_card', $attributes);
            } else {
              $card_output['desktop_img'] = '';
            }

            // Mobile image
            if (!empty($fc_item->field_image_mobile[LANGUAGE_NONE][0]['uri'])) {
              $attributes = array(
                'class' => 'for-mobile'
              );
              $card_output['mobile_img'] = prince_izant_theme_render_img($fc_item->field_image_mobile[LANGUAGE_NONE][0], 'market_slide_card', $attributes);
            } else {
              $card_output['mobile_img'] = '';
            }

            // Link
            if (!empty($fc_item->field_link[LANGUAGE_NONE][0])) {
              $card_output['link'] = $fc_item->field_link[LANGUAGE_NONE][0];
            }

            $cards[] = $card_output;
          }

          $section_output['cards_slider'] = $cards;
        }
        break;
      case 'cards_section':
        // Title
        $section_output['title'] = empty($section->field_title[LANGUAGE_NONE][0]['value']) ? '' : $section->field_title[LANGUAGE_NONE][0]['value'];
        // Text
        $section_output['text'] = empty($section->field_text[LANGUAGE_NONE][0]['value']) ? '' : $section->field_text[LANGUAGE_NONE][0]['value'];
        // CARDS
        if (!empty($section->field_cards_simple[LANGUAGE_NONE])) {
          $cards = array();

          foreach ($section->field_cards_simple[LANGUAGE_NONE] as $key => $value) {
            $fc_id = $value['value'];
            $fc_item = field_collection_item_load($fc_id);

            $card_output = array();
            
            // Title
            $card_output['title'] = !empty($fc_item->field_title[LANGUAGE_NONE][0]['value']) ?
              $fc_item->field_title[LANGUAGE_NONE][0]['value'] : '';

            // Text
            $card_output['text'] = !empty($fc_item->field_text[LANGUAGE_NONE][0]['value']) ?
              $fc_item->field_text[LANGUAGE_NONE][0]['value'] : '';

            // Desctop image
            if (!empty($fc_item->field_image_desktop[LANGUAGE_NONE][0]['uri'])) {
              $attributes = array(
                'class' => 'for-desktop'
              );
              $card_output['desktop_img'] = prince_izant_theme_render_img($fc_item->field_image_desktop[LANGUAGE_NONE][0], 'market_card', $attributes);
            } else {
              $card_output['desktop_img'] = '';
            }

            // Mobile image
            if (!empty($fc_item->field_image_mobile[LANGUAGE_NONE][0]['uri'])) {
              $attributes = array(
                'class' => 'for-mobile'
              );
              $card_output['mobile_img'] = prince_izant_theme_render_img($fc_item->field_image_mobile[LANGUAGE_NONE][0], 'market_card', $attributes);
            } else {
              $card_output['mobile_img'] = '';
            }

            $cards[] = $card_output;
          }

          $section_output['cards'] = $cards;
        }
        break;
      case 'advantages_section':
        // Title
        $section_output['title'] = empty($section->field_title[LANGUAGE_NONE][0]['value']) ? '' : $section->field_title[LANGUAGE_NONE][0]['value'];
        // ADVANTAGES
        if (!empty($section->field_advantages[LANGUAGE_NONE])) {
          $advantages = array();

          foreach ($section->field_advantages[LANGUAGE_NONE] as $key => $value) {
            $fc_id = $value['value'];
            $fc_item = field_collection_item_load($fc_id);

            $advantage_output = array();
            
            // Title
            $advantage_output['title'] = !empty($fc_item->field_title[LANGUAGE_NONE][0]['value']) ?
              $fc_item->field_title[LANGUAGE_NONE][0]['value'] : '';

            // List
            if (!empty($fc_item->field_list[LANGUAGE_NONE])) {
              foreach ($fc_item->field_list[LANGUAGE_NONE] as $key_list => $value) {
                $fc_id = $value['value'];
                $fc_item = field_collection_item_load($fc_id);

                $item = array();

                // Title
                $item['title'] = !empty($fc_item->field_title[LANGUAGE_NONE][0]['value']) ?
                  $fc_item->field_title[LANGUAGE_NONE][0]['value'] : '';

                // Text
                $item['text'] = !empty($fc_item->field_text[LANGUAGE_NONE][0]['value']) ?
                  $fc_item->field_text[LANGUAGE_NONE][0]['value'] : '';

                $advantage_output['list'][] = $item;
              }
            }

            $advantages[] = $advantage_output;
          }

          $section_output['advantages'] = $advantages;
        }
        break;
      case 'video_section':
        if (!empty($section->field_video_cover[LANGUAGE_NONE][0]['uri'])) {
          $section_output['img_path'] = image_style_url('crop', $section->field_video_cover[LANGUAGE_NONE][0]['uri']);
        } else {
          $section_output['img_path'] = '';
        }

        if (!empty($section->field_youku_video['und'][0]['video_url'])) {
          $url = $section->field_youku_video['und'][0]['video_url'];
          $regExp = "#youku\.com/(?:player.php/sid/|v_show/id_)([a-zA-Z0-9]+)(?:/|\\.)#";
          $video_id = array();
          preg_match($regExp, $url, $video_id);
          $section_output['video_id'] = $video_id[1];
        } else {
          $section_output['video_id'] = '';
        }
        break;
      case 'text_icons_section':
      case 'table_section':
      case '1_image_section':
      case 'image_l_text_r_section':
      case 'text_l_image_r_section':
      case '2_images_section':
      case 'video_section':
        $section_load = entity_load('paragraphs_item', array($pi_eid));
        $section_output['section'] = entity_view('paragraphs_item', $section_load, 'full');
        break;
  }

  return $section_output;
}

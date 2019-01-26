<?php
/**
 * @file
 * pi_content_types.default_video_embed_styles.inc
 */

/**
 * Implements hook_default_video_embed_styles().
 */
function pi_content_types_default_video_embed_styles() {
  $export = array();

  $video_embed_style = new stdClass();
  $video_embed_style->disabled = FALSE; /* Edit this to true to make a default video_embed_style disabled initially */
  $video_embed_style->api_version = 1;
  $video_embed_style->name = 'custom';
  $video_embed_style->title = 'Custom';
  $video_embed_style->data = array(
    'youtube' => array(
      'width' => '365',
      'height' => '218',
      'theme' => 'light',
      'autoplay' => 0,
      'vq' => 'hd720',
      'rel' => 0,
      'showinfo' => 1,
      'modestbranding' => 0,
      'iv_load_policy' => '1',
      'controls' => '1',
      'autohide' => '2',
      'class' => '',
    ),
    'vimeo' => array(
      'width' => '640',
      'height' => '360',
      'color' => '00adef',
      'portrait' => 1,
      'title' => 1,
      'byline' => 1,
      'autoplay' => 0,
      'loop' => 0,
      'froogaloop' => 0,
      'class' => '',
    ),
    'youku' => array(
      'width' => '640',
      'height' => '360',
    ),
    'data__active_tab' => 'edit-data-youtube',
  );
  $export['custom'] = $video_embed_style;

  return $export;
}

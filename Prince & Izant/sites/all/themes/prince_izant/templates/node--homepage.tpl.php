<?php

/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all, or
 *   print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct url of the current node.
 * - $terms: the themed list of taxonomy term links output from theme_links().
 * - $display_submitted: whether submission information should be displayed.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the following:
 *   - node: The current template type, i.e., "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode, e.g. 'full', 'teaser'...
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined, e.g. $node->body becomes $body. When needing to access
 * a field's raw values, developers/themers are strongly encouraged to use these
 * variables. Otherwise they will have to explicitly specify the desired field
 * language, e.g. $node->body['en'], thus overriding any language negotiation
 * rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 */

?>

<div class="homepage-content-wrapper">

  <?php if (!empty($variables['sections'])): ?>
    <?php foreach ($variables['sections'] as $key_section => $section): ?>
      
      <?php if ($section['id'] == 'banner'): ?>
        <!-- Banner section -->
        <div class="banner-wrapper">
          <div class="main-slider">
            <ul class="slider">
              <?php foreach ($section['banners'] as $key => $banner): ?>
                <li>
                  <div class="slider-img">
                    <?php print $banner['desktop_img']; ?>
                    <?php print $banner['mobile_img']; ?>
                  </div>

                  <div class="banner-content">
                    <div class="title">
                      <?php print $banner['title']; ?>
                    </div>
                    
                    <div class="subtitle">
                      <?php print $banner['subtitle']; ?>
                    </div>
                  </div>
                </li>
              <?php endforeach; ?>
            </ul>

            <div class="paginator-center text-color text-center">
              <ul>
                <li class="prev"></li>
                <li class="next"></li>
              </ul>
            </div>
          </div>
        </div>
        <!-- // Banner section -->
      <?php endif; ?>


      <?php if ($section['id'] == 'homepage_markets_section'): ?>
        <!-- Markets section -->
        <div class="markets-section">
          <div class="row">
            <div class="small-12 columns">
              <div class="field-name-field-markets-section-title">
                <div class="field-item">
                  <?php print $section['title']; ?>
                </div>
              </div>
              <div class="field-name-field-markets-section-text">
                <?php print $section['text']; ?>
              </div>

              <?php if (!empty($section['markets_list'])): ?>
                <ul class="markets-slider">
                  <?php foreach ($section['markets_list'] as $key => $market): ?>
                    <li>
                      <a href="<?php print $market['path']; ?>">
                        <div class="slider-content">  
                          <?php print $market['desktop_img']; ?>
                          <?php print $market['mobile_img']; ?>
                          <div class="title">
                            <?php print $market['title']; ?>
                          </div>
                        </div>
                      </a>
                    </li>
                  <?php endforeach; ?>
                </ul>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <!-- // Markets section -->
      <?php endif; ?>
      

      <?php if ($section['id'] == 'homepage_products_section'): ?>
        <!-- Products section -->
        <div class="products-section">
          <div class="row">
            <div class="small-12 columns">
              <div class="products-section-title">
                <div class="field-item">
                  <?php print $section['title']; ?>
                </div>
              </div>
              <div class="field-name-field-products-section-link">
                <?php print l($section['link']['title'], $section['link']['url'], array('attributes' => $section['link']['attributes'])); ?>
              </div>

              <?php if (!empty($section['products_list'])): ?>
                <div class="products-slider">
                  <?php foreach ($section['products_list'] as $key_block => $products_block): ?>
                    <ul>
                      <?php foreach ($products_block as $key => $product): ?>
                        <li>
                          <?php print $product['desktop_img']; ?>
                          <?php print $product['mobile_img']; ?>
                          <div class="caption">
                            <?php print $product['image_caption']; ?>
                          </div>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <!-- // Products section -->
      <?php endif; ?>
      

      <?php if ($section['id'] == 'homepage_text_section'): ?>
        <!-- Text section -->
        <div class="text-section">
          <div class="row">
            <div class="text-section-title">
              <div class="field-item">
                <?php print $section['title']; ?>
              </div>
            </div>
            <div class="text">
              <?php print $section['text']; ?>
            </div>
          </div>
        </div>
        <!-- // Text section -->
      <?php endif; ?>


      <?php if ($section['id'] == 'homepage_news_link_section'): ?>
        <!-- News+Link section -->
        <div class="news-link-section">
          <div class="row">

            <div class="news-section">
              <div class="field-name-field-news-section-title">
                <?php print render($section['news_section_title']); ?>
              </div>

              <?php print views_embed_view('news', 'block'); ?>
            </div>

            <div class="link-section" style="background-image: url(<?php print image_style_url('crop', $section['bg_link_section_uri']); ?>);">
              <?php if (!empty($section['icon'])): ?>
                <div class="field-name-field-icon">
                  <img src="<?php print file_create_url($section['icon']['uri']); ?>" alt="<?php print $section['icon']['alt']; ?>" title="<?php print $section['icon']['title']; ?>">
                </div>
              <?php endif; ?>
              <div class="field-name-field-link-section-title">
                <div class="field-item">
                  <?php print render($section['link_section_title']); ?>
                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- // News+Link section -->
      <?php endif; ?>


    <?php endforeach; ?>
  <?php endif; ?>

</div>

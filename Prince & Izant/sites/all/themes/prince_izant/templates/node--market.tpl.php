<?php

/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct URL of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type; for example, "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
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
 * - $type: Node type; for example, story, page, blog, etc.
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
 * - $view_mode: View mode; for example, "full", "teaser".
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
 * variable is defined; for example, $node->body becomes $body. When needing to
 * access a field's raw values, developers/themers are strongly encouraged to
 * use these variables. Otherwise they will have to explicitly specify the
 * desired field language; for example, $node->body['en'], thus overriding any
 * language negotiation rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 *
 * @ingroup themeable
 */
?>
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php print $user_picture; ?>

  <?php print render($title_prefix); ?>
  <?php if (!$page): ?>
    <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
  <?php endif; ?>
  <?php print render($title_suffix); ?>

  <?php if ($display_submitted): ?>
    <div class="submitted">
      <?php print $submitted; ?>
    </div>
  <?php endif; ?>

  <div class="content"<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      // print render($content);
    ?>




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


      <?php if ($section['id'] == 'text_icons_section'): ?>
        <!-- Text + Icons Section -->
        <div class="row">
          <div class="columns">
            <div class="text-icons-section">
              <?php print render($section['section']); ?>
            </div>
          </div>
        </div>
        <!-- // Text + Icons Section -->
      <?php endif; ?>


      <?php if ($section['id'] == 'table_section'): ?>
        <!-- Table Section -->
        <div class="table-section">
          <!-- <div class="row">
            <div class="columns"> -->
              <?php print render($section['section']); ?>
            <!-- </div>
          </div> -->
        </div>
        <!-- // Table Section -->
      <?php endif; ?>


      <?php if ($section['id'] == 'cards_slider_section'): ?>
        <!-- Cards Slider Section -->
        <div class="row">
          <div class="columns">
            <div class="cards-slider-section">
              
              <div class="field-text-market">
                <div class="field-item">
                  <?php print $section['title']; ?>
                </div>
              </div>

              <?php print render($section['text']); ?>

              <?php if (!empty($section['cards_slider'])): ?>
                <div class="wrapper-cards-slider">
                  <ul class="cards-slider">
                    <?php foreach ($section['cards_slider'] as $key => $card): ?>
                      <li>
                        <a href="<?php print empty($card['link']['url']) ? 'javascript: void(0);' : $card['link']['url']; ?>"<?php print empty($card['link']['attributes']['target']) ? '' : ' target="' . $card['link']['attributes']['target'] . '"'; ?>>
                          <?php print $card['desktop_img']; ?>

                          <?php print $card['mobile_img']; ?>

                          <div class="text">
                            <?php print $card['text']; ?>
                          </div>
                        </a>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <!-- // Cards Slider Section -->
      <?php endif; ?>


      <?php if ($section['id'] == 'cards_section'): ?>
        <!-- Cards Section -->
        <div class="row">
          <div class="columns">
            <div class="cards-section">

              <div class="field-text-market">
                <div class="field-item">
                  <?php print $section['title']; ?>
                </div>
              </div>

              <?php print $section['text']; ?>

              <?php if (!empty($section['cards'])): ?>
                <div class="wrapper-cards">
                  <ul class="cards clearfix">
                    <?php foreach ($section['cards'] as $key => $card): ?>
                      <li>
                        <div class="card-content">

                          <div class="hover">
                            <?php print $card['desktop_img']; ?>

                            <?php print $card['mobile_img']; ?>

                            <div class="text">
                              <?php print $card['text']; ?>
                            </div>

                          </div>

                          <div class="title">
                            <?php print $card['title']; ?>
                          </div>

                          <div class="text">
                            <?php print $card['text']; ?>
                          </div>

                        </div>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <!-- // Cards Section -->
      <?php endif; ?>


      <?php if ($section['id'] == 'advantages_section'): ?>
        <!-- Advantages Section -->
        <div class="advantages-section">

          <h2 class="title-advantages-section">
            <div class="field-item">
              <?php print $section['title']; ?>
            </div>
          </h2>

          <?php if (!empty($section['advantages'])): ?>
            <div class="wrapper-advantages">
              <ul class="advantages">
                <?php foreach ($section['advantages'] as $key => $card): ?>
                  <li>

                    <div class="title-container">
                      <div class="reverse-block">
                        <div class="number"><?php print sprintf("%02d", $key + 1); ?></div>

                        <div class="title">
                          <?php print $card['title']; ?>
                        </div> 
                      </div>
                    </div>

                    <?php if (!empty($card['list'])): ?>
                      <div class="row">
                        <div class="columns">
                          <ul class="list">
                            <?php foreach ($card['list'] as $key_list => $item): ?>
                              <div class="item-title">
                                <?php print $item['title']; ?>
                              </div>
                              <div class="item-text">
                                <?php print $item['text']; ?>
                              </div>
                              <div class="clearfix"></div>
                            <?php endforeach; ?>
                          </ul>
                        </div>
                      </div>
                    <?php endif; ?>
                  </li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>
        </div>
        <!-- // Advantages Section -->
      <?php endif; ?>


    <?php endforeach; ?>
  <?php endif; ?>


  </div>

  <?php print render($content['links']); ?>

  <?php print render($content['comments']); ?>

</div>

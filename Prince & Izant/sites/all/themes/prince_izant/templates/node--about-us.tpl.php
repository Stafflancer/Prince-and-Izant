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
// dpm($variables['sections']);
?>


<div class="about-us-content-wrapper">

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



      <?php if ($section['id'] == 'about_us_subsidiaries_section'): ?>

        <div class="subsidiaries-wrapper">

          <div class="title">
            <?php print $section['title']; ?>
          </div>

          <?php foreach ($section['subsidiaries'] as $key => $subsidiarie): ?>
            <div class="subsidiarie">

              <div class="number"><?php print sprintf("%02d", $key + 1); ?></div>

              <div class="left-img">
                <!-- Desctop image -->
                <?php if (!empty($subsidiarie['desktop_img'])): ?>
                  <?php print $subsidiarie['desktop_img']; ?>
                <?php endif; ?>

                <!-- Mobile image -->
                <?php if (!empty($subsidiarie['mobile_img'])): ?>
                  <?php print $subsidiarie['mobile_img']; ?>
                <?php endif; ?>
              </div>

              <div class="right-text">
              <!-- Text -->
              <?php if (!empty($subsidiarie['text'])): ?>
                <div class="text">
                  <?php print $subsidiarie['text']; ?>
                </div>
              <?php endif; ?>

              <!-- Categories -->
              <?php if (!empty($subsidiarie['categories'])): ?>
                <div class="categories">

                  <?php foreach ($subsidiarie['categories'] as $key_cat => $category): ?>
                    <div class="category">
                      <?php if (!empty($category['title'])): ?>
                        <div class="title">
                          <?php print $category['title']; ?>
                        </div>
                      <?php endif; ?>

                      <?php if (!empty($category['subcategories'])): ?>
                        <ul>
                          <?php foreach ($category['subcategories'] as $key_sub => $subcategory): ?>
                            <li><?php print $subcategory; ?></li>
                          <?php endforeach; ?>
                        </ul>
                      <?php endif; ?>
                    </div>
                  <?php endforeach; ?>

                </div>
              <?php endif; ?>
              </div>

            </div>
          <?php endforeach; ?>
        </div>

      <?php endif; ?>




    <?php endforeach; ?>
  <?php endif; ?>

</div>

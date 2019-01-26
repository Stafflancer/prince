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


  <?php print render($content['field_publication_date']); ?>

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


      <?php if ($section['id'] == '1_image_section'): ?>
        <!-- 1 Image Section -->
        <div class="one-image-section">
          <div class="row">
            <?php print render($section['section']); ?>
          </div>
        </div>
        <!-- // 1 Image Section -->
      <?php endif; ?>


      <?php if ($section['id'] == 'image_l_text_r_section'): ?>
        <!-- Image L / Text R Section -->
        <div class="image-l-text-r-section">
          <div class="row">
            <?php print render($section['section']); ?>
          </div>
        </div>
        <!-- // Image L / Text R Section -->
      <?php endif; ?>


      <?php if ($section['id'] == 'text_l_image_r_section'): ?>
        <!-- Text L / Image R Section -->
        <div class="text-l-image-r-section">
          <div class="row">
            <?php print render($section['section']); ?>
          </div>
        </div>
        <!-- // Text L / Image R Section -->
      <?php endif; ?>


      <?php if ($section['id'] == '2_images_section'): ?>
        <!-- 2 Images Section -->
        <div class="two-images-section">
          <div class="row">
            <?php print render($section['section']); ?>
          </div>
        </div>
        <!-- // 2 Images Section -->
      <?php endif; ?>


      <?php if ($section['id'] == 'video_section'): ?>
        <!-- Video Section -->
        <div class="video-section">
          <div class="row">

            <div class="cover-img"></div>

            <?php if (!empty($section['img_path'])): ?>
              <span class="img-path" data-img-path="<?php print $section['img_path']; ?>"></span>
            <?php endif; ?>

            <?php if (!empty($section['video_id'])): ?>
              <span class="video-id" data-video-id="<?php print $section['video_id']; ?>"></span>
            <?php endif; ?>
          </div>
        </div>
        <!-- // Video Section -->
      <?php endif; ?>


    <?php endforeach; ?>
  <?php endif; ?>


  </div>

  <?php print render($content['links']); ?>

  <?php print render($content['comments']); ?>

</div>

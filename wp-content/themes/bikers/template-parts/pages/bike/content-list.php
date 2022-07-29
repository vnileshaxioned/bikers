<?php
  $query = $args['query'];
  while ($query -> have_posts()) {
    $query -> the_post();
    $id = get_the_ID();
    $permalink = get_the_permalink();
    $title = get_the_title();
    $excerpt = get_the_excerpt();
    $image_url = get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : null;
    $alt = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
    $image_alt = $alt ? $alt : $title;
    $colors = get_the_terms($id, 'color');
    $date = get_the_date();
    
    if ($permalink || $title || $excerpt || $image_url || $image_alt || $colors || $date) { ?>
    <li class="post-list">
      <?php if ($permalink && $title) { ?>
        <h3 class="post-heading">
          <a href="<?php echo $permalink; ?>" class="post-title" title="<?php echo $title; ?>"><?php echo $title; ?></a>
        </h3>
      <?php }
        if ($image_url || $image_alt) { ?>
        <figure class="image">
          <img src="<?php echo $image_url; ?>" class="bike-image" alt="<?php echo $image_alt; ?>">
        </figure>
      <?php }
        echo $excerpt ? '<p class="content-paragraph">'.$excerpt.'</p>' : null;
        if ($colors) { ?>
        <ul class="color-taxonomy">
          <?php
            foreach ($colors as $color) {
              $color_name = $color->name;
              echo $color_name ? '<li class="color-list"><span class="color-name">'.$color_name.'</span></li>' : null;
            }
          ?>
        </ul>
      <?php }
      echo $date ? '<div class="date"><span class="post-date">'.$date.'</span></div>' : null; ?>
    </li>
  <?php }
  } wp_reset_postdata();
?>
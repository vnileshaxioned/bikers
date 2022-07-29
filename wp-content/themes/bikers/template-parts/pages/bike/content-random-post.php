<?php
  $posts_per_page = 3;
  $current_post = $args['id'];
  $args = array(
    'post_type' => 'bike',
    'orderby' =>'rand',
    'post_status' => 'publish',
    'posts_per_page' => $posts_per_page,
    'post__not_in' => array($current_post)
  );
  
  $query = new WP_Query( $args );
  if ($query->have_posts()) { ?>
  <section class="random-post">
    <div class="wrapper">
      <h4 class="random-post-main-heading">Random Posts</h4>
      <ul class="random-post-container">
        <?php
          while ($query->have_posts()) {
            $query->the_post();
            $permalink = get_the_permalink();
            $title = get_the_title();
            $image_url = get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : null;
            $alt = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
            $image_alt = $alt ? $alt : $title;
            if ($permalink || $title || $image_url || $image_alt) { ?>
            <li class="random-post-list">
              <?php if ($image_url || $image_alt) { ?>
                <figure class="random-post-image">
                  <img src="<?php echo $image_url; ?>" alt="<?php echo $image_alt; ?>">
                </figure>
              <?php }
                if ($permalink || $title) { ?>
                <h5 class="random-post-heading">
                  <a href="<?php echo $permalink; ?>" class="random-post-title" title="<?php echo $title; ?>"><?php echo $title; ?></a>
                </h5>
              <?php } ?>
            </li>
        <?php }
        } wp_reset_postdata(); ?>
      </ul>
    </div>
  </section>
<?php } ?>
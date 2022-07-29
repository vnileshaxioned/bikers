<?php
  get_header();
  
  $id = get_the_ID();
  $permalink = get_the_permalink();
  $title = get_the_title();
  $content = wpautop(get_field('content'));
  $image_url = get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : null;
  $alt = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
  $image_alt = $alt ? $alt : $title;

  if ($title || $content || $image_url || $image_alt) { ?>
  <section class="bike-post-detail">
    <div class="wrapper">
      <?php
        echo $title ? '<h2 class="detail-post-title">'.$title.'</h2>' : null;
        if ($image_url || $image_alt) { ?>
          <figure class="detail-post-image">
            <img src="<?php echo $image_url; ?>" alt="<?php echo $image_alt; ?>">
          </figure>
      <?php }
        echo $content ? '<div class="wysiwyg-editor">'.$content.'</div>' : null;
      ?>
    </div>
  </section>
<?php }
  $args = array('id' => $id);
  get_template_part('template-parts/pages/bike/content', 'random-post', $args);
  get_footer();
?>
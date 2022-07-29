<?php
/* Template Name: Bike Listing */
  get_header();

  $posts_per_page = 3;
  $args = array(
    'post_type' => 'bike',
    'orderby' => 'title',
    'order' =>'ASC',
    'post_status' => 'publish',
    'posts_per_page' => $posts_per_page
  );
  $query = new WP_Query( $args );
  $total_posts = $query->found_posts;
  if ($query -> have_posts()) { ?>
  <section class="bike-post">
    <div class="wrapper">
      <?php get_template_part('template-parts/pages/bike/content', 'filter'); ?>
      <ul class="post-container" data-posts="<?php echo $posts_per_page; ?>" data-all-posts="<?php echo $total_posts; ?>">
        <?php
          $args = array('query' => $query);
          get_template_part('template-parts/pages/bike/content', 'list', $args);
        ?>
      </ul>
      <div class="load-more">
        <a href="#FIXME" class="load-more-button" title="Load more">Load more</a>
      </div>
    </div>
  </section>
<?php } else {
    get_template_part('template-parts/pages/bike/content', 'blank');
  }
  get_footer();
?>
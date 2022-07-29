<?php
  // for classic editor
  add_filter('use_block_editor_for_post', '__return_false');

  // enqueue the style and script files
  add_action('wp_enqueue_scripts', 'test_theme_script');
  function test_theme_script() {
    wp_enqueue_style('custom-styling', get_stylesheet_uri());
    wp_enqueue_script('custom-script', get_template_directory_uri().'/assets/js/script.js', array('jquery'), null, true);
    wp_localize_script( 'custom-script', 'ajax', array('ajaxurl' => admin_url( 'admin-ajax.php' )));
  }

  // for load more
  add_action("wp_ajax_filter_search", "filter_search");
  add_action("wp_ajax_nopriv_filter_search", "filter_search");
  function filter_search() {
    $offset = $_POST['offset'];
    $post_per_page = $_POST['post_per_page'];
    $color = $_POST['color'];
    $search = $_POST['search'];
    $args = array(
      'post_type' => 'bike',
      'orderby' => 'title',
      'order' =>'ASC',
      'post_status' => 'publish',
      'offset' => $offset,
    );

    if ($color && ($color != 'all')) {
      $args['posts_per_page'] = -1;
      $args['tax_query'] = array(
        array(
          'taxonomy' => 'color',
          'field' => 'slug',
          'terms' => $color
        )
      );
    }

    if ($search) {
      $args['posts_per_page'] = -1;
      $args['s'] = $search;
    }

    $query = new WP_Query( $args );
    if ($query -> have_posts()) {
      $args = array('query' => $query);
      get_template_part('template-parts/pages/bike/content', 'list', $args);
    }
    die();
  }

  // theme support
  add_action('after_setup_theme', 'custom_theme_setup');
  function custom_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support( 'post-thumbnails' );
    register_nav_menus( array(
      'primary' => __('Primary Menu', 'customtheme')
    ) );
  }

  //custom menu structure
  function custom_menu($location_name) {
    if (($locations = get_nav_menu_locations()) && $locations[$location_name]) {
      $menu_id = get_nav_menu_locations()[$location_name];
      $menu_items = wp_get_nav_menu_items($menu_id);

      $menu_list = '<nav class="navbar-'.$location_name.'">';
      $menu_list .= '<ul class="menu">';
      foreach ($menu_items as $menu_item) {
        $title = $menu_item->title;
        $url = $menu_item->url;
        $menu_list .= '<li class="menu-list">';
        $menu_list .= '<a href="'.$url.'" class="menu-item" title="'.$title.'">'.$title.'</a>';
        $menu_list .= '</li>';
      }
      $menu_list .= '</ul>';
      $menu_list .= '</nav>';
    }
    echo $menu_list;
  }

  //excerpt length
  add_action( 'excerpt_length', 'excerptLength', 999);
  function excerptLength( $length ) {
    return 50;
  }
  
  // custom post type
  add_action( 'init', function() {
    custom_post_type('bike', 'dashicons-post-status');
  });
  function custom_post_type($cpt, $icon = 'dashicons-admin-post') {
    $capitalize_cpt = ucfirst($cpt);
    $labels = array(
      'name'                => _x( $capitalize_cpt.'s', 'Post Type General Name', 'customtheme' ),
      'singular_name'       => _x( $cpt, 'Post Type Singular Name', 'customtheme' ),
      'menu_name'           => __( $capitalize_cpt.'s', 'customtheme' ),
      'all_items'           => __( 'All '.$capitalize_cpt.'s', 'customtheme' ),
      'add_new'             => __( 'Add New', 'customtheme' ),
      'edit_item'           => __( 'Edit '.$capitalize_cpt, 'customtheme' ),
      'update_item'         => __( 'Update '.$capitalize_cpt, 'customtheme' ),
      'search_items'        => __( 'Search '.$capitalize_cpt.'s', 'customtheme' ),
      'not_found'           => __( 'Not Found', 'customtheme' ),
      'not_found_in_trash'  => __( 'Not found in Trash', 'customtheme' ),
    );
    $args = array(
      'label'               => __( $cpt, 'customtheme' ),
      'description'         => __( $cpt.' description', 'customtheme' ),
      'labels'              => $labels,
      'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail' ),
      'hierarchical'        => true,
      'public'              => true,
      'show_ui'             => true,
      'show_in_menu'        => true,
      'show_in_nav_menus'   => true,
      'show_in_admin_bar'   => true,
      'menu_position'       => 4,
      'menu_icon'           => $icon,
      'can_export'          => true,
      'has_archive'         => true,
      'exclude_from_search' => true,
      'publicly_queryable'  => true,
      'capability_type'     => 'page',
    );
    register_post_type( $cpt, $args );
  }

  // custom taxonomy
  add_action( 'init', function() {
    custom_taxonomy('color', 'bike');
  });
  function custom_taxonomy($tax_name, $cpt) {
    $capitalize_tax_name = ucfirst($tax_name);
    $labels = array(
      'name' => _x( $capitalize_tax_name.'s', 'taxonomy general name' ),
      'singular_name'     => _x( $capitalize_tax_name, 'taxonomy singular name' ),
      'search_items'      =>  __( 'Search '.$capitalize_tax_name.'s' ),
      'all_items'         => __( 'All '.$capitalize_tax_name.'s' ),
      'parent_item'       => __( 'Parent '.$capitalize_tax_name ),
      'parent_item_colon' => __( 'Parent '.$capitalize_tax_name ),
      'edit_item'         => __( 'Edit '.$capitalize_tax_name ),
      'update_item'       => __( 'Update '.$capitalize_tax_name ),
      'add_new_item'      => __( 'Add New '.$capitalize_tax_name ),
      'new_item_name'     => __( 'New '.$capitalize_tax_name ),
      'not_found'         => __( 'No '.$tax_name.'s found' ),
      'menu_name'         => __( $capitalize_tax_name.'s' ),
    );
    register_taxonomy( $tax_name, array($cpt), array(
      'hierarchical'      => true,
      'labels'            => $labels,
      'show_ui'           => true,
      'show_in_rest'      => true,
      'show_admin_column' => true,
      'query_var'         => true,
      'rewrite'           => array( 'slug' => $tax_name ),
    ));
  }
?>
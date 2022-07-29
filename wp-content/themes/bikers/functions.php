<?php
  // for classic editor
  add_filter('use_block_editor_for_post', '__return_false');

  // custom post type
  add_action( 'init', function() {
    custom_post_type('bike', 'dashicons-post-status');
  });
  function custom_post_type($cpt, $icon = 'dashicons-admin-post') {
    $capitalize_cpt = ucfirst($cpt);
    var_dump($cpt);
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
?>
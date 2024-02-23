<?php

function add_book_taxonomies() {
    // Register a Genre taxonomy for books
    $labels = array(
        'name'              => _x('Genres', 'taxonomy general name'),
        'singular_name'     => _x('Genre', 'taxonomy singular name'),
        'search_items'      => __('Search Genres'),
        'all_items'         => __('All Genres'),
        'parent_item'       => __('Parent Genre'),
        'parent_item_colon' => __('Parent Genre:'),
        'edit_item'         => __('Edit Genre'),
        'update_item'       => __('Update Genre'),
        'add_new_item'      => __('Add New Genre'),
        'new_item_name'     => __('New Genre Name'),
        'menu_name'         => __('Genres'),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'genre'),
    );
    register_taxonomy('book_genre', 'book', $args);
}
add_action('init', 'add_book_taxonomies');

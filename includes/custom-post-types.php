<?php


//  this function adds a new post type named books to the website which can have title, description and thumbnail
function add_books_post_type_register_book() {
    $args = [
        'public' => true,
        'label'  => 'Books',
        'supports' => ['title', 'editor', 'thumbnail'],
        'menu_icon' => 'dashicons-book',
    ];
    register_post_type('book', $args);
}
add_action('init', 'add_books_post_type_register_book');


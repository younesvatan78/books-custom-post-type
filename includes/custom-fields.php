<?php
function add_books_post_type_add_metabox() {
    add_meta_box('book_author', 'Author', 'add_books_post_type_author_metabox_callback', 'book');
}

function add_books_post_type_author_metabox_callback($post) {
    
    $author = get_post_meta($post->ID, 'book_author', true);
    echo '<input type="text" name="book_author" value="' . esc_attr($author) . '" class="widefat" />';
}

function add_books_post_type_save_postdata($post_id) {
    if (array_key_exists('book_author', $_POST)) {
        update_post_meta($post_id, 'book_author', $_POST['book_author']);
    }
}

add_action('add_meta_boxes', 'add_books_post_type_add_metabox');
add_action('save_post', 'add_books_post_type_save_postdata');



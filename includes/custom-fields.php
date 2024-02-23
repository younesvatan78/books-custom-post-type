<?php
function add_books_post_type_add_metabox() {
    add_meta_box(
        'book_details',
        'Book Details',
        'add_books_post_type_details_metabox_callback',
        'book'
    );
}

function add_books_post_type_details_metabox_callback($post) {
    // Nonce field for validation
    wp_nonce_field('book_details_save', 'book_details_nonce');
    
    // Retrieve current values, if any
    $author = get_post_meta($post->ID, 'book_author', true);
    $year = get_post_meta($post->ID, 'book_year', true);
    $price = get_post_meta($post->ID, 'book_price', true);
    
    // Author field
    echo '<p><label for="book_author">Author:</label>';
    echo '<input type="text" id="book_author" name="book_author" value="' . esc_attr($author) . '" class="widefat" /></p>';
    
    // Year field
    echo '<p><label for="book_year">Year:</label>';
    echo '<input type="text" id="book_year" name="book_year" value="' . esc_attr($year) . '" class="widefat" /></p>';
    
    // Price field
    echo '<p><label for="book_price">Price:</label>';
    echo '<input type="text" id="book_price" name="book_price" value="' . esc_attr($price) . '" class="widefat" /></p>';
}

function add_books_post_type_save_postdata($post_id) {
    // Check nonce for security
    if (!isset($_POST['book_details_nonce']) || !wp_verify_nonce($_POST['book_details_nonce'], 'book_details_save')) {
        return;
    }

    // Check for autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    // Check user permissions
    if (isset($_POST['post_type']) && 'book' == $_POST['post_type']) {
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    }
    
        // Save the meta box fields
        if (array_key_exists('book_author', $_POST)) {
            update_post_meta($post_id, 'book_author', sanitize_text_field($_POST['book_author']));
        }
        if (array_key_exists('book_year', $_POST)) {
            update_post_meta($post_id, 'book_year', sanitize_text_field($_POST['book_year']));
        }
        if (array_key_exists('book_price', $_POST)) {
            update_post_meta($post_id, 'book_price', sanitize_text_field($_POST['book_price']));
        }    
}


add_action('add_meta_boxes', 'add_books_post_type_add_metabox');
add_action('save_post', 'add_books_post_type_save_postdata');



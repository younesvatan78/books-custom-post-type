<?php

function register_custom_book_api_routes() {
    register_rest_route('custom-book/v1', '/update-book/(?P<id>\d+)', array(
        'methods' => 'POST',
        'callback' => 'custom_book_update',
        'permission_callback' => '__return_true', 
        'args' => array(
            'id' => array(
                'validate_callback' => function($param, $request, $key) {
                    return is_numeric($param);
                }
            ),
            'title' => array(
                'required' => false,
                'validate_callback' => function($param, $request, $key) {
                    return is_string($param);
                }
            ),
            'description' => array(
                'required' => false,
                'validate_callback' => function($param, $request, $key) {
                    return is_string($param);
                }
            ),
            'author' => array(
                'required' => false,
                'validate_callback' => function($param, $request, $key) {
                    return is_string($param);
                }
            ),
            'price' => array(
                'required' => false,
                'validate_callback' => function($param, $request, $key) {
                    return is_numeric($param);
                }
            ),
            'year' => array(
                'required' => false,
                'validate_callback' => function($param, $request, $key) {
                    return is_numeric($param) && strlen($param) == 4;
                }
            ),
        ),
    ));
}

add_action('rest_api_init', 'register_custom_book_api_routes');

function custom_book_update($request) {
    $post_id = $request['id'];
    $post_data = array('ID' => $post_id);

    if (isset($request['title'])) {
        $post_data['post_title'] = sanitize_text_field($request['title']);
    }

    if (isset($request['description'])) {
        $post_data['post_content'] = sanitize_textarea_field($request['description']);
    }

    // Update the book post
    $result = wp_update_post($post_data, true);

    if (is_wp_error($result)) {
        return $result;
    }

    // Update custom fields for author, price, and year
    if (isset($request['author'])) {
        update_post_meta($post_id, 'book_author', sanitize_text_field($request['author']));
    }

    if (isset($request['price'])) {
        update_post_meta($post_id, 'book_price', sanitize_text_field($request['price']));
    }

    if (isset($request['year'])) {
        update_post_meta($post_id, 'book_year', sanitize_text_field($request['year']));
    }

    return new WP_REST_Response(array('message' => 'Book updated successfully', 'post_id' => $post_id), 200);
}

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
        ),
    ));
}
add_action('rest_api_init', 'register_custom_book_api_routes');

add_action('rest_api_init', 'register_custom_book_api_routes');

function custom_book_update($request) {
    $post_id = $request['id'];
    $post_data = array('ID' => $post_id);

    // Update the title if provided
    if (isset($request['title'])) {
        $post_data['post_title'] = sanitize_text_field($request['title']);
    }

    // Update the description (content) if provided
    if (isset($request['description'])) {
        $post_data['post_content'] = sanitize_textarea_field($request['description']);
    }

    // Verify post type is 'book'
    $post_type = get_post_type($post_id);
    if ('book' !== $post_type) {
        return new WP_Error('incorrect_post_type', 'Can only update books', array('status' => 404));
    }

    // Proceed with the update
    $result = wp_update_post($post_data, true);

    if (is_wp_error($result)) {
        return $result;
    }

    return new WP_REST_Response(array('message' => 'Book updated successfully', 'post_id' => $post_id), 200);
}

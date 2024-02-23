<?php
/**
 * Plugin Name: Add Books Post Type
 * Plugin URI: http://example.com
 * Description: A plugin to add a custom post type for books and manage authors.
 * Version: 1.0
 * Author: Younes
 * Author URI: mailto:younes.varlog@gmail.com
 */

if (!defined('WPINC')) {
    die;
}

// Include Custom Post Types and Taxonomies
require_once plugin_dir_path(__FILE__) . 'includes/custom-post-types.php';

// Include Custom Fields
require_once plugin_dir_path(__FILE__) . 'includes/custom-fields.php';

// Include REST API Enhancements
#require_once plugin_dir_path(__FILE__) . 'includes/rest-api.php';

// Include Shortcode for Searching Books
require_once plugin_dir_path(__FILE__) . 'includes/shortcode.php';


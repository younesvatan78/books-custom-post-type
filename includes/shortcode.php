<?php
// Ensure WordPress is loaded
if ( ! defined( 'ABSPATH' ) ) exit;

function add_books_post_type_search_shortcode() {
    ob_start(); // Start output buffering to capture the form and results HTML

    // Display the search form
    ?>
    <form action="" method="get">
        <label for="book-search">Search Books:</label>
        <input type="text" name="book-search" id="book-search" value="<?php echo esc_attr(get_query_var('book-search')); ?>" />
        <input type="submit" value="Search" />
    </form>
    <?php
    // Process the search form submission
    if (isset($_GET['book-search']) && !empty($_GET['book-search'])) {
        $search_term = sanitize_text_field($_GET['book-search']);

        $args = [
            'post_type' => 'book',
            'posts_per_page' => -1,
            's' => $search_term,
        ];

        $query = new WP_Query($args);

        if ($query->have_posts()) {
            echo '<ul>';
            while ($query->have_posts()) {
                $query->the_post();
                echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
            }
            echo '</ul>';
        } else {
            echo '<p>No books found.</p>';
        }
        wp_reset_postdata(); // Reset the query back to the original state
    }

    return ob_get_clean(); // Return the buffered content
}

add_shortcode('book_search', 'add_books_post_type_search_shortcode');


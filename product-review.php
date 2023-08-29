<?php
/*
Template Name: Avis Produits
*/

get_header();
?>

<main class="<?= esc_attr('cbd-theme-template-' . Benfrom09\CBD\CBDTheme::get_theme_page_template()); ?>">
    <section class="cbd-default-section">
        <?php
        // Pagination variables
$reviews_per_page = 10; // Number of reviews per page
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// Get the URL of the front page
$front_page_url = esc_url(home_url('/'));
$shop_url = wc_get_page_permalink('shop');
// Custom query for product reviews
$reviews_args = array(
    'post_type' => 'product',
    'post_status' => 'publish',
    'posts_per_page' => $reviews_per_page,
    'orderby' => 'date',
    'order' => 'DESC',
    'paged' => $paged,
);
$reviews_query = new WP_Query($reviews_args);

if ($reviews_query->have_posts()) :
    // Display the back link to the front page
    echo '<a class="shop-link" href="' . esc_url($shop_url) . '">Retour à la boutique </a>';
    echo '<h1>Avis clients</h1>';
    while ($reviews_query->have_posts()) :
        $reviews_query->the_post();

        

        // Get comments for the current product
        $product_reviews = get_comments(array(
            'post_id' => get_the_ID(),
            'status' => 'approve', // Approved comments
        ));
        /*
        if($product_reviews) {
            echo '<h2>' . get_the_title() . '</h2>';
        }
        */

        foreach ($product_reviews as $review) :
            $rating = get_comment_meta($review->comment_ID, 'rating', true);
            echo '<p>vote: ' . esc_html($rating) . '/5</p>';
            echo '<div class="review">';
            echo '<p><strong>' . esc_html(get_comment_author($review->comment_ID)) . '</strong> - ' . esc_html(get_comment_date('', $review->comment_ID)) . '</p>';
            echo '<p>' . esc_html(get_comment_text($review->comment_ID)) . '</p>';
            echo '</div>';
        endforeach;
    endwhile;

    // Pagination links
    echo '<div class="pagination">';
    echo paginate_links(array(
        'total' => $reviews_query->max_num_pages,
        'current' => $paged,
    ));
    echo '</div>';

    // Restore original post data
    wp_reset_postdata();
else :
    echo '<p>Aucun avis trouvé.</p>';
endif;
        ?>
    </section>
</main>
<?php
get_footer();
?>
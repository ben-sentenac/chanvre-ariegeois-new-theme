<div class="cbd-posts-product-categories">
    <div class="product-categories-title-container">
        <h2 class="post-product-categories-title font-xl">Nos produits</h2>
        <h3 class="post-product-categories-desc">TOUS LES PRODUITS SONT CERTIFIES A MOINS DE <span class="green">0.3%</span> DE THC</h3>
    </div>
    <div class="post-product-categories-container">
        <?php
        // echo do_shortcode('[featured_products]');
        //echo do_shortcode('[best_selling_products]');
        //echo do_shortcode('[recent_products]');
        //echo do_shortcode('[sale_products]');
        //echo do_shortcode('[product_categories]');
        Benfrom09\CBD\WoocommerceSetUp::wc_get_categories_product();
        ?>
    </div>
    <a class="cbd-btn"href="<?php echo wc_get_page_permalink('shop'); ?>">Voir la boutique</a>
</div>
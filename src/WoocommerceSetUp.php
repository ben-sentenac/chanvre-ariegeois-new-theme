<?php
namespace Benfrom09\CBD;

use Benfrom09\CBD\CBDTheme;


class WoocommerceSetUp
{

    public function __construct()
    {
        $this->woocommerce_setUp();
    }

    /**
     * woocommerce default options
     */
    public function woocommerce_setUp()
    {
        //set up woocommerce
        remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
        remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

        add_action('woocommerce_before_main_content', [$this, 'theme_wrapper_start'], 10);
        add_action('woocommerce_after_main_content', [$this, 'theme_wrapper_end'], 10);
        add_action('woocommerce_archive_description', [$this, 'shop_description']);
        add_action('wp_footer', [$this, 'add_plus_and_minus_qty_btn']);


        //add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');

        add_filter('woocommerce_add_to_cart_fragments', [$this, 'wc_refresh_mini_cart_count']);

        add_action('wp_ajax_get_cart_content', [$this,'get_cart_content']);
        add_action('wp_ajax_nopriv_get_cart_content',  [$this,'get_cart_content']); // For non-logged-in users

        
    }

    // Function to get the top-level category ID for a given category ID recursively
    public static function get_top_level_category($category_id, $category_ids)
    {
        $category = get_term($category_id, 'product_cat');
        $parent_id = $category->parent;

        if ($parent_id && in_array($parent_id, $category_ids)) {
            return $parent_id;
        } elseif ($parent_id) {
            return self::get_top_level_category($parent_id, $category_ids);
        }

        return null;
    }
    // Function to retrieve the first available subcategory image recursively
    public static function get_category_subcategory_image($category_id, $category_products)
    {
        $subcategories = get_terms(
            array(
                'taxonomy' => 'product_cat',
                'hide_empty' => false,
                'parent' => $category_id,
            )
        );

        foreach ($subcategories as $subcategory) {
            $subcategory_products = $category_products[$subcategory->term_id];
            $subcategory_product_id = isset($subcategory_products[0]) ? $subcategory_products[0] : null;

            if ($subcategory_product_id) {
                $subcategory_product = wc_get_product($subcategory_product_id);
                $subcategory_image_id = $subcategory_product->get_image_id();

                if ($subcategory_image_id) {
                    return wp_get_attachment_image_url($subcategory_image_id, 'thumbnail');
                } else {
                    $image_url = self::get_category_subcategory_image($subcategory->term_id, $category_products);

                    if ($image_url) {
                        return $image_url;
                    }
                }
            }
        }

        return null;
    }

    public static function wc_get_categories_product()
    {

        // Retrieve all the top-level product categories
        $top_level_categories = get_terms(
            array(
                'taxonomy' => 'product_cat',
                'hide_empty' => true,
                'parent' => 0,
            )
        );

        // Store category IDs in an array
        $category_ids = wp_list_pluck($top_level_categories, 'term_id');

        // Query published products with their categories
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            // Retrieve only published products
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'term_id',
                    'terms' => $category_ids,
                ),
            ),
        );

        $product_query = new \WP_Query($args);

        // Create an empty array to store products by category
        $category_products = array();

        // Initialize the category products array
        foreach ($top_level_categories as $category) {
            $category_products[$category->term_id] = array();
        }

        // Loop through the queried products and organize them by category
        while ($product_query->have_posts()) {
            $product_query->the_post();

            $product_id = get_the_ID();
            $product_categories = wp_get_post_terms($product_id, 'product_cat', array('fields' => 'ids'));

            foreach ($product_categories as $category_id) {
                // Check if the category is a top-level category
                if (in_array($category_id, $category_ids)) {
                    // Store the product ID in the corresponding category array
                    $category_products[$category_id][] = $product_id;
                } else {
                    // Check if the category is a subcategory of a top-level category
                    $parent_id = self::get_top_level_category($category_id, $category_ids);

                    if ($parent_id) {
                        // Store the product ID in the parent top-level category array
                        $category_products[$parent_id][] = $product_id;
                    }
                }
            }
        }

        // Restore the global post data
        wp_reset_postdata();

        // Retrieve category links and product images
        $category_links = array();
        $category_images = array();

        foreach ($top_level_categories as $category) {
            $category_id = $category->term_id;
            $category_links[$category_id] = get_term_link($category);

            // Retrieve the first product image for the category
            $products = $category_products[$category_id];
            $product_id = isset($products[0]) ? $products[0] : null;

            if ($product_id) {
                $product = wc_get_product($product_id);
                $image_id = $product->get_image_id();

                if ($image_id) {
                    $image_url = wp_get_attachment_image_url($image_id, 'thumbnail');
                } else {
                    // Check if the category has subcategories with images
                    $image_url = self::get_category_subcategory_image($category_id, $category_products);
                }

                if (!$image_url) {
                    // Fallback image URL for categories without images or subcategories
                    $image_url = 'https://example.com/path/to/fallback-image.jpg';
                }

                $category_images[$category_id] = $image_url;
            } else {
                // Fallback image URL for categories without associated products
                $image_url = 'https://example.com/path/to/fallback-image.jpg';
                $category_images[$category_id] = $image_url;
            }
        }


        // Display categories and products
        foreach ($top_level_categories as $category) {
            $category_name = $category->name;
            $category_id = $category->term_id;
            $category_image = $category_images[$category_id];

            // Display category name, image, and permalink
            ?>
            <a href="<?php echo $category_links[$category_id]; ?>">
                <article class="cbd-post-category">
                    <h3>
                        <?php echo $category_name; ?>
                    </h3>
                    <div class="cbd-post">
                        <?php
                        if ($category_image) {
                            echo '<img src="' . $category_image . '" alt="' . $category_name . '"/>';
                        }
                        ?>
                    </div>

                </article>
            </a>
            <?php
            // Retrieve the products for the category
            $products = $category_products[$category_id];

            // Display the products
            foreach ($products as $product_id) {
                $product = wc_get_product($product_id);
                $product_name = $product->get_name();
                $product_price = $product->get_price();
                // ... display product information
            }
        }


    }

    /**
     * shop page theme wrapper
     */
    public function theme_wrapper_start()
    {
        ?>
        <main class="<?= esc_attr('cbd-theme-template-' . CBDTheme::get_theme_page_template()); ?>">
            <section class="cbd-theme-woocommerce-section">
                <?php
    }

    public function theme_wrapper_end()
    {
        ?>
            </section>
        </main>'
        <?php
    }

    public function before_order_review()
    {
        ?>
        <!-- order review wrapper -->
        <div class="order_review_wrapper">
            <?php
    }

    public function after_order_review()
    {
        ?>
            <!-- end order review wrapper -->
        </div>
        <?php

    }

    public function shop_description()
    {
        ?>
        <p class="woocommerce-shop-description">
            Bienvenue sur la boutique du Chanvre Ariégeois. Tous les produits à la vente sont certifiés à moins de 0.3% de THC
            et
            sont issuent de variétés légales inscrites au catalogue officiel.
        </p>
        <?php 
            $promo = WooHelper::get_promo_codes()[0];
            $content = $promo->post_excerpt;
            $code = $promo->post_name;
            $expires = $promo->date_expires;
            $time = time();
            if($time < $expires):
        ?>
        <p class="shop-notification-promo-code woocommerce-info" style="font-weight:bold;">
            <?php echo esc_html($content) . ' avec le code <span class="yellow">' . esc_html($code) . ' </span>' ;?>
        </p>
        <?php endif;
    }

    public function add_plus_and_minus_qty_btn()
    {
        if (!is_product() && !is_cart())
            return;
        ?>
        <script type="text/javascript">
            function PbStyleQuantite(a) {
                var b, c = !1;
                a || (a = ".qty"),
                    b = jQuery("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").find(a),
                    b.length && (jQuery.each(b, function (a, b) {
                        "date" !== jQuery(b).prop("type") && "hidden" !== jQuery(b).prop("type") && (jQuery(b).parent().hasClass("buttons_added") || (jQuery(b).parent().addClass("buttons_added").prepend('<input type="button" value="-" class="minus" />'),
                            jQuery(b).addClass("input-text").after('<input type="button" value="+" class="plus" />'),
                            c = !0))
                    }),
                        c && (jQuery("input" + a + ":not(.product-quantity input" + a + ")").each(function () {
                            var a = parseFloat(jQuery(this).attr("min"));
                            a && a > 0 && parseFloat(jQuery(this).val()) < a && jQuery(this).val(a)
                        }),
                            jQuery(".plus, .minus").unbind("click"),
                            jQuery(".plus, .minus").on("click", function () {
                                var b = jQuery(this).parent().find(a),
                                    c = parseFloat(b.val()),
                                    d = parseFloat(b.attr("max")),
                                    e = parseFloat(b.attr("min")),
                                    f = b.attr("step");
                                c && "" !== c && "NaN" !== c || (c = 0),
                                    "" !== d && "NaN" !== d || (d = ""),
                                    "" !== e && "NaN" !== e || (e = 0),
                                    "any" !== f && "" !== f && void 0 !== f && "NaN" !== parseFloat(f) || (f = 1),
                                    jQuery(this).is(".plus") ? d && (d == c || c > d) ? b.val(d) : b.val(c + parseFloat(f)) : e && (e == c || c < e) ? b.val(e) : c > 0 && b.val(c - parseFloat(f)),
                                    b.trigger("change")
                            })))
            }
            jQuery(window).on("load", function () {
                PbStyleQuantite()
            }),
                jQuery(document).ajaxComplete(function () {
                    PbStyleQuantite()
                });
        </script>
        <?php
    }
    /**
     * Add plus btn aside qty btn in product page
     *
     * @return void
     */
    public function add_plus_btn()
    {
        echo '<button type="button" class="plus" >+</button>';
    }
    /**
     * Add minus btn aside qty btn in product page
     *
     * @return void
     */
    public function add_minus_btn()
    {
        echo '<button type="button" class="minus" >-</button>';
    }

    /**
     * Cart Link.
     *
     * Displayed a link to the cart including the number of items present and the cart total.
     *
     * @return void
     */
    public static function woocommerce_cart_link()
    {
        if (WOOCOMMERCE_ACTIVE):
            ?>
            <a class="cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>"
                title="<?php esc_attr_e('Voir le panier', 'cestbiendici'); ?>">
                <div class="cart-total">
                    <img src="<?php echo esc_url(CBDTheme::get_icon('cart_white.svg')); ?>" alt="">
                </div>
            </a>
            <?php
        endif;
    }


    public static function get_cart_count()
    {
        $item_count_text = sprintf(
            /* translators: number of items in the mini cart. */
            _n('%d', '%d', WC()->cart->get_cart_contents_count(), 'cestbiendici'),
            WC()->cart->get_cart_contents_count()
        );
        echo esc_html($item_count_text);
    }


    public function get_cart_content()
    {
        $cart_items = [];

        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
            $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
            
            $product_name = $_product->get_name();
            $product_price = $_product->get_price();
            $product_img = $_product->get_image();
            $product_qty = $cart_item['quantity'];
    
            $cart_items[] = array(
                'name' => $product_name,
                'price' => $product_price,
                'img' => $product_img,
                'qty' => $product_qty,
                
            );
            
        }
        
        wp_send_json($cart_items); // Send the cart content as JSON response
    
    }

    public function wc_refresh_mini_cart_count($fragments)
    {
        ob_start();
        ?>
        <div id="mini-cart-count">
            <?php self::get_cart_count()?>
        </div>
        <?php
        $fragments['#mini-cart-count'] = ob_get_clean();
        return $fragments;
    }
}
<?php
namespace Benfrom09\CBD;


/**
 * WooHelper
 */
class WooHelper
{
    /**
     * get_last_woocommerce_comments
     *
     * @param  mixed $number
     * @return array
     */
    public static function get_last_woocommerce_comments(int $number = 4, $order = 'DESC'): array
    {
        $order === 'ASC' ? 'ASC' : 'DESC';
        $args = [
            'post_type' => 'product', // Change this to 'product' or 'product_variation' depending on your needs
            'number' => $number,
            'status' => 'approve',
            'order' => $order
        ];


        $comments = get_comments($args);
        return $comments;

    }

    public static function get_promo_codes(int $number = 5)
    {
        $number = absint($number);

        $args = [
            'post_type' => 'shop_coupon',
            // WooCommerce coupon post type
            'post_status' => 'publish',
            // Only published coupons
            'posts_per_page' => $number,
            // Number of coupons to retrieve -1 == all coupons
            'orderby' => 'date',
            // Order by date
            'order' => 'DESC', // Order in descending order
        ];

         // Query the coupons
            $coupons = get_posts( $args );

            foreach($coupons as $coupon) {
                $expire = get_post_meta($coupon->ID,'date_expires',true);
                $coupon->date_expires = $expire;

            }
            return $coupons;
    }
}
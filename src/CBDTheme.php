<?php
namespace Benfrom09\CBD;

use Benfrom09\CBD\WoocommerceSetUp;

/**
 * 
 */
class CBDTheme
{

    const THEME_VERSION = '1.0.0';
    public function __construct()
    {
        $this->load_theme_constants();
    }
    /**
     * run theme
     *
     * @return void
     */
    public function run(): void
    {
        //
        add_action('after_setup_theme', [$this, 'setup_theme']);

        if (WOOCOMMERCE_ACTIVE) {
            //set up woocommerce
            new WoocommerceSetUp();
        }

        add_action('wp_enqueue_scripts', [$this, 'register_scripts']);
        add_action('customize_register', [$this, 'theme_customizer']);

        add_action('wp_head',[$this,'add_ajax_url']);
    }


    /**
     * load ttheme constant
     *
     * @return void
     */
    private function load_theme_constants(): void
    {

        //assets directory location
        define('CBD_THEME_ASSETS', get_template_directory_uri() . '/resources');
        define('CBD_THEME_DOMAIN', 'cbd_domain');
        define('WOOCOMMERCE_ACTIVE', class_exists('Woocommerce'));
        define('THEME_VERSION', self::THEME_VERSION);

    }

    /**
     * setup_theme
     *
     * @return void
     */
    public function setup_theme()
    {
        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');



        /**
         * add support for woocommerce
         */
        add_theme_support('woocommerce', [
            'thumbnail_image_width' => 150,
            'single_image_width' => 150,
            'gallery_thumbnail_image_width' => 150,
            'product_grid' => [
                'default_rows' => 2,
                'min_rows' => 1,
                'default_columns' => 4,
                'min_columns' => 1,
                'max_columns' => 6,
            ]
        ]);

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support(
            'custom-logo',
            array(
                'height' => 400,
                'width' => 400,
                'flex-width' => true,
                'flex-height' => true,
            )
        );

        /**
         * display full screen images in gutemberg 
         */
        add_theme_support('align-wide');

        //disable custom font-size
        add_theme_support('disable-custom-font-sizes');
        /**
         * The embed blocks automatically apply styles to embedded content to reflect the aspect ratio of content that is embedded in an iFrame
         */
        add_theme_support('responsive-embeds');


        remove_theme_support('widgets-block-editor');


        add_filter('nav_menu_css_class', [$this, 'add_active_class_to_menu_item'], 10, 2);


        $this->cbd_register_nav_menus();
    }

    public function add_active_class_to_menu_item($classes, $item)
    {
        if (in_array('current-post-ancestor', $classes) || in_array('current-page-ancestor', $classes) || in_array('current-menu-item', $classes)) {
            $classes[] = 'active ';
        }
        return $classes;
    }

    public function cbd_register_nav_menus()
    {
        register_nav_menus([
            'menu-1' => esc_html__('Menu header', 'cestbiendici'),
            'menu-2' => esc_html__('Menu mobile','cestbiendici'),
            'menu-3' => esc_html__('Menu footer', 'cestbiendici'),
        ]);
    }

    /**
     * register_scripts
     *
     * @return void
     */
    public function register_scripts()
    {
        $jsFileName = basename(glob(get_template_directory() . '/resources/build/main.min.*.js')[0]);
        $jsFileUri = CBD_THEME_ASSETS . '/build/' . $jsFileName;
        wp_enqueue_script('cbd-js', $jsFileUri, [], true);
        $cssFileName = basename(glob(get_template_directory() . '/resources/build/main.min.*.css')[0]);
        $cssFileUri = CBD_THEME_ASSETS . '/build/' . $cssFileName;
        wp_enqueue_style('cbd-style', $cssFileUri, [], true);

        if (WOOCOMMERCE_ACTIVE) {
            $wooCssFilePath = get_template_directory_uri() . '/woocommerce/style.css';
            wp_enqueue_style('woo_css', $wooCssFilePath, [], 1.0, 'all');
        }
    }

    /**
     * get the theme page template
     *
     * @return string
     */
    public static function get_theme_page_template(): string
    {
        global $template;
        return substr(basename($template), 0, -4);
    }

    /**
     * @param string $name
     * Get the default logo theme located in resources/img/logo
     * @return  string
     */
    public static function get_default_logo(string $name = ''): string
    {
        $file = get_template_directory() . '/resources/img/logo/' . $name;
        if (file_exists($file)) {
            return CBD_THEME_ASSETS . '/img/logo/' . $name;
        }
        return '';
    }
    public static function get_icon(string $icon = ''): string
    {
        $file = get_template_directory() . '/resources/img/icon/' . $icon;
        if (file_exists($file)) {
            return CBD_THEME_ASSETS . '/img/icon/' . $icon;
        }
        return '';
    }

    public static function get_img(string $img = ''): string
    {
        $file = get_template_directory() . '/resources/img/' . $img;
        if (file_exists($file)) {
            return CBD_THEME_ASSETS . '/img/' . $img;
        }
        return '';
    }

    /**
     * get_default_hero_background_img
     *
     * @param  string $name
     * @return string
     */
    public static function get_default_hero_background_img(string $name = ''): string
    {

        $file = get_template_directory() . '/resources/img/hero/' . $name;
        if (file_exists($file)) {
            return CBD_THEME_ASSETS . '/img/hero/' . $name;
        }
        return '';
    }

    /**
     * get fontawesome
     *
     * @return void
     */
    public static function get_fontawesome():void
    {
        ?>
        <script src="https://kit.fontawesome.com/f6fb60eb24.js" crossorigin="anonymous"></script>
        <?php
    }


    /**
     * add custom option to theme
     *
     * @param  mixed $wp_customize
     * @return void
     */
    public function theme_customizer($wp_customize):void
    {


        $wp_customize->add_panel('front_page_section', [
            'title' => __('Front page', 'cestbiendici'),
            'description' => __('Customize front page', 'cestbiendici'),
            'priority' => 10
        ]);



        //add custom background
        $wp_customize->add_section('header_hero_section', [
            'title' => __('Header Hero Section', 'cestbiendici'),
            'priority' => 10,
            'panel' => 'front_page_section'
        ]);


        $wp_customize->add_setting('hero_title_setting', [
            'default' => 'chanvre-ariegeois.fr',
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'refresh'
        ]);

        $wp_customize->add_setting('hero_title2_setting', [
            'default' => 'Une culture respectueuse de la terre',
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'refresh'
        ]);

        $sentence = 'Des produits <span class="yellow">100%</span>naturel';

        $wp_customize->add_setting('hero_title3_setting', [
            'default' => $sentence,
            'sanitize_callback' => wp_kses($sentence, [
                'span' => [
                    'class' => []
                ]
            ]),
            'transport' => 'refresh'
        ]);

        $wp_customize->add_control('hero_title2_control', [
            'type' => 'text',
            'priority' => 30,
            'section' => 'header_hero_section',
            'settings' => 'hero_title2_setting',
            'label' => __('h2', 'cestbiendici')
        ]);
        $wp_customize->add_control('hero_title3_control', [
            'type' => 'text',
            'priority' => 40,
            'section' => 'header_hero_section',
            'settings' => 'hero_title3_setting',
            'label' => __('h3', 'cestbiendici')
        ]);
        $wp_customize->add_control('hero_title_control', [
            'type' => 'text',
            'priority' => 20,
            'section' => 'header_hero_section',
            'settings' => 'hero_title_setting',
            'label' => __('Site Title', 'cestbiendici')
        ]);


        $wp_customize->add_setting('hero_background_image_setting', [
            'default' => self::get_img('hero/hero_1366.jpg'),
            'transport' => 'refresh'
        ]);
        $wp_customize->add_control(new \WP_Customize_Image_Control($wp_customize, 'hero_background_image', [
            'label' => 'Background Image',
            'section' => 'header_hero_section',
            'settings' => 'hero_background_image_setting',
            'type' => 'image',
            'sna'
        ]));

        $wp_customize->add_setting('hero_logo_setting', [
            'default' => self::get_img('logo/logo_square_blanc.png'),
            'transport' => 'refresh'
        ]);
        $wp_customize->add_control(new \WP_Customize_Image_Control($wp_customize, 'hero_logo_image', [
            'label' => 'Hero logo',
            'section' => 'header_hero_section',
            'settings' => 'hero_logo_setting',
            'type' => 'image',
            'sna'
        ]));

        $wp_customize->add_section('front_page_section_one', [
            'title' => __('Front Page Section 1', 'cestbiendici'),
            'priority' => 10,
            'panel' => 'front_page_section'
        ]);


        $wp_customize->add_setting('front_page_section_1_setting', [
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'refresh'
        ]);


    }
    /**
     * create random string
     */
    public static function create_nonce():string {
        return bin2hex(random_bytes(16));
    }

    /**
     * add ajax to the theme
     */
    public function add_ajax_url():void
    {
        ?>
        <script type="text/javascript">
            const ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
            const nounce = '<?php wp_create_nonce($this->create_nonce()); ?>';
        </script>
        <?php
    }
}
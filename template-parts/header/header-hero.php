<!-- HEADER-HERO -->
<?php
$background_image = get_theme_mod('hero_background_image') ?: Benfrom09\CBD\CBDTheme::get_default_hero_background_img('hero_1366.jpg');
?>
<section class="cbd-hero-section p-relative">
    <?php require_once dirname(__DIR__) . '/navbar/navbar-mobile.php'; ?>
    <?php require_once dirname(__DIR__) . '/navbar/navbar.php'; ?>
    <div class="cbd-hero-container">
        <div class="cbd-hero-overlay" style="background-image:url('<?php echo esc_url($background_image); ?>');"></div>
        <div class="cbd-hero-content">
            <div class="cbd-txt-content p-relative show-block">
                <h1 id="site-title" class="show-block-1">
                    chanvre-ariegeois.fr
                    <!-- 
                    <svg>
                        <text x="0" y="50%" text-anchor="start" dominant-baseline="middle" id="SvgText"></text>
                    </svg>
-->
                </h1>
                <h2 class="site-subtitle show-block-2">
                    Une culture respectueuse de la terre
                </h2>
                <h3 class="site-ad show-block-3">
                    Des produits <span class="yellow">100%</span> naturels
                </h3>
                <a class="cbd-btn show-block-4" href="<?php echo wc_get_page_permalink('shop') ;?>">Voir la boutique</a>

            </div>
            <div class="cbd-main-logo p-relative show-block">
                <img class="show-block-1" src="<?php echo esc_url(Benfrom09\CBD\CBDTheme::get_default_logo('logo_square_blanc.png')); ?>"
                    alt="" srcset="">
            </div>
        </div>
    </div>

</section>
<!-- end HEADER-HERO -->
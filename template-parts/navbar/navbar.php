<nav class="cbd-main-navbar">
    <div class="cbd-nav-logo-section">
        <figure class="cbd-nav-logo-container">
            <img src="<?php echo esc_url(Benfrom09\CBD\CBDTheme::get_default_logo('logo_rectangle_blanc.png')); ?>" alt=""
                srcset="">
        </figure>
    </div>
    <div class="cbd-main-menu-section">
    <?php wp_nav_menu(
            [
                'theme_location' => 'menu-1',
                'container' => false,
                'menu_class' => '',
                'fallback_cb' => '__return_false',
                'items_wrap' => '<ul id="%1$s" class="cbd-nav-menu">%3$s</ul>',
                'depth' => 2,
            ]

        );
        ?>
        <!-- 
        <ul class="cbd-nav-menu">
            <li>
                <a href="">Acceuil</a>
            </li>
            <li>
                <a href="">La Boutique</a>
            </li>
            <li>
                <a href="">Qui suis-je</a>
            </li>
            <li>
                <a href="">Contact</a>
            </li>
        </ul>
-->
    </div>
    <div class="cbd-icon-section">
        <div class="icon-container">
            <img src="<?php echo esc_url(Benfrom09\CBD\CBDTheme::get_icon('search.svg')); ?>" alt="">
        </div>
    <?php if (WOOCOMMERCE_ACTIVE): ?>
        <div class="icon-container">
            <?php Benfrom09\CBD\WoocommerceSetUp::woocommerce_cart_link() ; ?>
        </div>
        <div id="mini-cart-count"><?php Benfrom09\CBD\WoocommerceSetUp::get_cart_count();?></div>
    <?php endif;?>
    </div>
    <div class="login-icon-section">
        <?php if(is_user_logged_in()): ?>
        <div class="loggin-indicator"></div>
        <div class="login-name">
            <?php
                $user = wp_get_current_user()->user_firstname ? wp_get_current_user()->user_firstname : wp_get_current_user()->user_email;
             ?>
            Bienvenue <?php echo $user; ?>
        </div>
        <?php endif;?>
    </div>
</nav>
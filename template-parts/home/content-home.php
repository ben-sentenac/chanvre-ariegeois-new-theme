<section class="cbd-home-section cbd-islocal">
    <div class="cbd-islocal-content show-block">
        <p id="isLocalText" class="cbd-islocal-text">Nous vous offrons une gamme de produits de qualité, cultivés, récoltés et manucurés
            à la main!</p>
        <p class="cbd-slogan s1 show-block-2">
            <span class="green">100%</span> local, <span class="green">100%</span> naturels, <span class="green">0%</span> phytos.
        </p>
        
        <p class="text-default show-block-3">Utilisé depuis des millénaires et parfaitement adapté aux enjeux environnementaux.
        Nos transformations se font de manière artisanale, par macération dans de l’huile végétale, ainsi , tous les cannabinoïdes présents dans la plante sont conservés preservant ainsi « l’effet d’entourage ».
        </p>
    </div>
    <div id="isLocalImg" class="cbd-islocal-img show-block">
        <img class="show-block-2" style="-webkit-mask-image: url('<?php echo esc_url(Benfrom09\CBD\CBDTheme::get_img('theme/smokio-second-stroke.png')); ?>');"
            src="<?php echo esc_url(Benfrom09\CBD\CBDTheme::get_img('theme/fleur_produit.jpg')); ?>" alt="" srcset="">
    </div>
</section>
<section class="cbd-home-section cbd-shop"
    style="background-image:url(<?php echo esc_url(Benfrom09\CBD\CBDTheme::get_img('theme/shop.jpg')); ?>);">
    <?php get_template_part('template-parts/home/products'); ?>
</section>
<section class="cbd-promo-code">
    <?php $promo_codes =  Benfrom09\CBD\WooHelper::get_promo_codes();
        $last_promo_code_in_array = end($promo_codes);
        $content = $last_promo_code_in_array->post_excerpt;
        $code = $last_promo_code_in_array->post_name;
    ?>
    <div class="promo-code-container">
        <?php echo esc_html($content);?> avec le code <span class="yellow"> <?php echo esc_html($code);?></span>
    </div>
</section>
<section class="cbd-home-section cbd-shop-comments">
    <?php get_template_part('template-parts/comments/comment', 'home'); ?>
    <div class="see-all-review-link text-center">
        <a class="cbd-btn" href="avis-produit">voir les avis</a>
    </div>
</section>
<?php get_template_part('template-parts/home/location'); ?>
<section class="cbd-home-section cbd-about show-block">
    <h2 class="font-xl show-block-1">
        Au fait c'est quoi le CBD
    </h2>
    <div class="cbd-about-container show-block-2">
        <figure class="cbd-about-image-container">
            <img src="<?php echo esc_url(Benfrom09\CBD\CBDTheme::get_img('theme/cbd_molecule.png')); ?>" alt=""
                srcset="">
        </figure>
        <div class="cbd-text-content">
            <p>
                Le Cannabidiol ou CBD est une molécule que l’on retrouve dans le chanvre. il fait partie des
                cannabinoïdes. On en dénombre environ 144 à l’heure actuelle: CBD, THC, CBN, CBG, CBC, etc.
            </p>
            <p>
                Le CBD est le second cannabinoïde le plus présent à l’état naturel dans le chanvre, Recherché pour ses
                effets vertueux (il est notamment décontractant, anti-inflammatoire et antidépresseur), Il possède des
                propriétés bioactives qui influencent le système nerveux à partir du système endocannabinoïde (réseau de
                récepteur du système nerveux, responsable de la perception, de la concentration, de la mémoire et du
                mouvement).
            </p>
            <p>
                Le CBD vient directement stimuler la sérotonine ( responsable en partie des humeurs ) et l’anandamine (
                endocannabinoïde ), mais également d’autres récepteurs jouant des rôles clés dans l’organisme.
            </p>
            <p>
                Ainsi, il influe sur l’homéostasie du corps : il permet de retrouver un équilibre sur l’ensemble de
                l’organisme tels que l’appétit, l’humeur, les douleurs, le sommeil, la respiration, la circulation
                sanguine, la température, etc… Ses bienfaits sont de plus en plus reconnus et étudiés.
            </p>
            <p>
                Grâce à son absence d’effets psychoactifs, le CBD permet donc de bénéficier de propriétés du chanvre
                sans perdre le contrôle de soi. C’est ce qui lui vaut son surnom de « cannabis bien-être.
            </p>
        </div>
        <div class="cbd-video-container show-block-3">
        <div class="video-container">
            <iframe src="https://www.youtube.com/embed/YAS-cbzQSAo"
                title="C Bien D&#39;ici - Chanvre Ariégeois (CBD: plus qu&#39;une culture bien-être)" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen></iframe>
        </div>
    </div>
    </div>

</section>
<section class="cbd-home-section cbd-about-me show-block">
    <div class="cbd-about-me-container">
        <div class="cbd-about-me-zoom show-block-3">
            <img src="<?php echo esc_url(Benfrom09\CBD\CBDTheme::get_img('theme/portrait.jpg')); ?>" alt="" srcset="">
        </div>
        <div class="cbd-about-me-text-content show-block-1">
            <?php 
            $default_title = 'Qui suis-je ?';
            $default_content = '<p>Ariégeoise d’origine, je m’appelle Célia et à 38 ans 
            j’ai choisi de me reconvertir dans un métier sensé à
            haut potentiel pour la transition écologique.</p>
        <p>
            Je m’intéresse plus particulièrement aux vertus « bien-être » de la plante, mon objectif étant de
            proposer des produits locaux, naturels, bon pour le corps et l’esprit !
            Je travaille sur une petite parcelle, ce qui me permet de tout faire à la main, la culture, la récolte,
            le séchage, la manucure…
        </p>
        <p>J’utilise des variétés légales inscrites au catalogue officiel des 
        semences garantissant moins de 0,3 % de THC., ce que je fais confirmer par des analyses en 
        laboratoire spécialisé.</p>';
                $title = !empty(get_field('who-am-i-title')) ?  get_field('who-am-i-title') : $default_title;
                $content = !empty(get_field('who-am-i-content')) ? get_field('who-am-i-content') : $default_content;
            ?>
            <h3><?php echo esc_html($title); ?> </h3>
            <?php echo wp_kses_post($content); ?>
        </div>
    </div>
</section>
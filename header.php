<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <?php wp_head(); ?>
    <meta property="og:title" content="Le chanvre-ariegeois">
    <meta property="og:type" content="website" />
    <meta property="og:description" content="Vente de fleur de CBD">
    <meta property="og:image"
        content="http://chanvre-ariegeois.fr/wp-content/uploads/2022/07/RVB_celia_sentenac_reou_logo_exe_couleur-principale.png">
    <meta property="og:url" content="https://chanvre-ariegeois.fr">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Proza+Libre&family=Roboto+Serif:wght@200&display=swap"
        rel="stylesheet">
    <?php if (is_front_page()) :
    ?>
    <!-- css open street map -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin=""/>
    <?php
    endif;
    ?>
    

</head>

<body <?php body_class(); ?> data-theme="light">
    <?php wp_body_open(); ?>
    <!-- begin #PageWrapper -->
    <div id="PageWrapper">
        <?php if (is_front_page()) {
            get_template_part('template-parts/header/header-hero');
        } else {
            get_template_part('template-parts/navbar/navbar-mobile');
            get_template_part('template-parts/navbar/navbar');
        }
        ?>
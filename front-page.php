<?php get_header(); ?>

<main class="<?= esc_attr('cbd-theme-template-' . Benfrom09\CBD\CBDTheme::get_theme_page_template()); ?>">
    <section class="cbd-front-page-section">
        <?php if (have_posts()):
            while (have_posts()):
                the_post(); ?>
            <?php get_template_part('template-parts/home/content','home'); ?>
            <?php endwhile; endif; ?>
    </section>
</main>

<?php get_footer(); ?>
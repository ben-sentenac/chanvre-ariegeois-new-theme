<!-- end  #PageWrapper -->
<footer class="cbd-footer">
    <figure class="cbd-footer-logo">
        <img src="<?php echo esc_url(Benfrom09\CBD\CBDTheme::get_img('logo/logo_rectangle_blanc.png')); ?>" alt=""
            srcset="">
    </figure>
    <div class="cbd-footer-content">
        <div class="cbd-contact show-block">
            <span class="cbd-mail contact-box show-block-1">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                    viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path
                        d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z" />
                </svg>
                chanvreariegeois@gmail.com
            </span>
            <span class="cbd-phone contact-box show-block-2">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                    viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path
                        d="M280 0C408.1 0 512 103.9 512 232c0 13.3-10.7 24-24 24s-24-10.7-24-24c0-101.6-82.4-184-184-184c-13.3 0-24-10.7-24-24s10.7-24 24-24zm8 192a32 32 0 1 1 0 64 32 32 0 1 1 0-64zm-32-72c0-13.3 10.7-24 24-24c75.1 0 136 60.9 136 136c0 13.3-10.7 24-24 24s-24-10.7-24-24c0-48.6-39.4-88-88-88c-13.3 0-24-10.7-24-24zM117.5 1.4c19.4-5.3 39.7 4.6 47.4 23.2l40 96c6.8 16.3 2.1 35.2-11.6 46.3L144 207.3c33.3 70.4 90.3 127.4 160.7 160.7L345 318.7c11.2-13.7 30-18.4 46.3-11.6l96 40c18.6 7.7 28.5 28 23.2 47.4l-24 88C481.8 499.9 466 512 448 512C200.6 512 0 311.4 0 64C0 46 12.1 30.2 29.5 25.4l88-24z" />
                </svg>
                07-49-98-34-41
            </span>
            <span class="cbd-social contact-box facebook show-block-3">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                    viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path
                        d="M400 32H48A48 48 0 0 0 0 80v352a48 48 0 0 0 48 48h137.25V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.27c-30.81 0-40.42 19.12-40.42 38.73V256h68.78l-11 71.69h-57.78V480H400a48 48 0 0 0 48-48V80a48 48 0 0 0-48-48z" />
                </svg>
                <a href="http://">Retrouvez moi sur facebook</a>
            </span>
        </div>
        <div class="footer-col-3 legal show-block">
            <a class="show-block-1" href="http://">Mentions legales</a>
            <a class="show-block-2" href="http://">Conditions générale de ventes</a>
            <img class="show-block-3" src="<?php echo esc_url(Benfrom09\CBD\CBDTheme::get_icon('forb.png')); ?>" alt=""
                srcset="">
            <img class="show-block-3" src="<?php echo esc_url(Benfrom09\CBD\CBDTheme::get_icon('no-prag.svg')); ?>"
                alt="" srcset="">
        </div>
        <div class="footer-col-2 show-block">
            <h3 class="show-block-1">Visitez aussi</h3>
            <div class="partners">
                <a class="show-block-2" href="http://">
                    <img src="<?php echo esc_url(Benfrom09\CBD\CBDTheme::get_img('logo/Chanvre-Lgal-Pro-logo.png')); ?>"
                        alt="" srcset="">
                </a>
                <a class="show-block-3" href="http://">
                    <img src="<?php echo esc_url(Benfrom09\CBD\CBDTheme::get_img('logo/LogoAFPC_png.png')); ?>" alt=""
                        srcset="">
                </a>
                <a class="show-block-4" href="http://">
                    <img src="<?php echo esc_url(Benfrom09\CBD\CBDTheme::get_img('logo/logo-nou.webp')); ?>" alt=""
                        srcset="">
                </a>

            </div>
        </div>
    </div>

</footer>
</div>
<?php if (is_front_page()):
    ?>
    <!-- css open street js -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <?php
endif;
?>
<?php wp_footer(); ?>
</body>

</html>
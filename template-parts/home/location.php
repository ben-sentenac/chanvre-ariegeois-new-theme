<section class="cbd-home-section cbd-location">

    <svg xmlns:xlink="http://www.w3.org/1999/xlink" id="wave" style="transform:rotate(0deg); transition: 0.3s"
        viewBox="0 0 1440 290" version="1.1" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <linearGradient id="sw-gradient-0" x1="0" x2="0" y1="1" y2="0">
                <stop stop-color="rgba(34, 119, 92, 1)" offset="0%" />
                <stop stop-color="rgba(34, 119, 92, 1)" offset="100%" />
            </linearGradient>
        </defs>
        <path style="transform:translate(0, 0px); opacity:1" fill="url(#sw-gradient-0)"
            d="M0,261L60,256.2C120,251,240,242,360,207.8C480,174,600,116,720,111.2C840,106,960,155,1080,149.8C1200,145,1320,87,1440,67.7C1560,48,1680,68,1800,62.8C1920,58,2040,29,2160,14.5C2280,0,2400,0,2520,0C2640,0,2760,0,2880,9.7C3000,19,3120,39,3240,72.5C3360,106,3480,155,3600,188.5C3720,222,3840,242,3960,227.2C4080,213,4200,164,4320,154.7C4440,145,4560,174,4680,169.2C4800,164,4920,126,5040,106.3C5160,87,5280,87,5400,116C5520,145,5640,203,5760,207.8C5880,213,6000,164,6120,159.5C6240,155,6360,193,6480,193.3C6600,193,6720,155,6840,149.8C6960,145,7080,174,7200,183.7C7320,193,7440,184,7560,178.8C7680,174,7800,174,7920,145C8040,116,8160,58,8280,29C8400,0,8520,0,8580,0L8640,0L8640,290L8580,290C8520,290,8400,290,8280,290C8160,290,8040,290,7920,290C7800,290,7680,290,7560,290C7440,290,7320,290,7200,290C7080,290,6960,290,6840,290C6720,290,6600,290,6480,290C6360,290,6240,290,6120,290C6000,290,5880,290,5760,290C5640,290,5520,290,5400,290C5280,290,5160,290,5040,290C4920,290,4800,290,4680,290C4560,290,4440,290,4320,290C4200,290,4080,290,3960,290C3840,290,3720,290,3600,290C3480,290,3360,290,3240,290C3120,290,3000,290,2880,290C2760,290,2640,290,2520,290C2400,290,2280,290,2160,290C2040,290,1920,290,1800,290C1680,290,1560,290,1440,290C1320,290,1200,290,1080,290C960,290,840,290,720,290C600,290,480,290,360,290C240,290,120,290,60,290L0,290Z" />
    </svg>
    <div class="cbd-location-container p-relative show-block">
        <div class="cbd-location-title">
            <h2 class="font-xl show-block-1">Ou sommes nous</h2>
        </div>
        <div class="location show-block-3">
            <figure class="location-img-container p-relative">
                <img class="location-img"
                    src="<?php echo esc_url(Benfrom09\CBD\CBDTheme::get_img('theme/location_b.png')); ?>" alt=""
                    srcset="">
                <figcaption class="location-txt-content font-xl">
                    Situés dans les Pyrénées Ariègeoises, Nous vous proposons du CBD développant le caractère et les
                    saveurs uniques de notre térroir
                </figcaption>
            </figure>
            <div class="patchwork flex-v-center p-relative show-block-2">
                <figure class="patchwork-img ">
                    <img src="<?php echo esc_url(Benfrom09\CBD\CBDTheme::get_img('theme/produit.png')); ?>" alt=""
                        srcset="">
                </figure>
            </div>
        </div>
        <div class="store-location">
             <h3 class="font-xl">Nos point de ventes</h3>
            <div class="store-location-content">
                <div class="local-stores-address">
                    <p>Retrouvez nos produits dans un point de vente en ariège</p>
                    <ul class="shop-locate">
                        <?php display_post_meta() ; ?>
                    </ul>
                </div>
                <div id="map" style="height:400px"></div>
            </div>
        </div>
        <div class="draw show-block-4">
            <figure class="draw-image-container">
                <img class="draw-image"
                    src="<?php echo esc_url(Benfrom09\CBD\CBDTheme::get_img('theme/cana_green.png')); ?>" alt=""
                    srcset="">
            </figure>
        </div>
    </div>
</section>
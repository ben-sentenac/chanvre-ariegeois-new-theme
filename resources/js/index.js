addEventListener('DOMContentLoaded', (e) => {
    console.log(ajaxurl);

    const UI = {
        frontPage: {
            isLocalText: document.getElementById('isLocalText'),
            isLocalImg: document.getElementById('isLocalImg'),
        },
        navbar: {
            hamburger: document.getElementById('hamburger'),
            menuMobile: document.getElementById('menuMobile'),
            menuCloseBtn: document.getElementById('menuCloseBtn'),
        },
        cart: {
            cart_icon: document.getElementById('cart_icon'),
            miniCartCount: document.getElementById('mini-cart-count'),
        }
    }
    const DESKTOP_BREAKPOINT = 980;

    //intersection observer 
    const observer = new IntersectionObserver((entries) => {
        for (const entry of entries) {
            if (entry.isIntersecting) {
                entry.target.classList.add('show-block-visible');
                observer.unobserve(entry.target);
            }
        }
    },
        {
            threshold: 0.1
        });


    document.querySelectorAll('.show-block').forEach(el => {
        observer.observe(el);
    });


    //intersection observer

    function isMobile() {
        return window.innerWidth < DESKTOP_BREAKPOINT;
    }

    function toggleMenu(e) {
        e.preventDefault();
        //menuMobile.classList.toggle('hidden');
        let attr = menuMobile.getAttribute('aria-expanded') === "false" ? "true" : "false";
        menuMobile.setAttribute('aria-expanded', attr);
        animateMenu();
    }

    /**
     * menu animation on mobile
     */
    function animateMenu() {
        if (menuMobile.classList.contains('hidden')) {
            menuMobile.classList.remove('hidden');
            setTimeout(() => {
                menuMobile.classList.remove('opacity-none');
            }, 0);
        } else {
            menuMobile.classList.add('opacity-none');
            menuMobile.addEventListener('transitionend', (e) => {
                menuMobile.classList.add('hidden');

            }, {
                capture: false,
                once: true,
                passive: false
            });
        }
    }
    /**
     * open street map integration
     */
    async function initMap() {
        let lat = 42.932629;
        let lon = 1.443469;

        fetchPlaces();

        const places = await fetchPlaces();
        console.log(places);

        let map = L.map('map', {
            center: [lat, lon],
            zoom: 9,
            dragging: false,
            scrollWheelZoom: false
        });

        L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
            // Il est toujours bien de laisser le lien vers la source des données
            attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
            minZoom: 1,
            maxZoom: 20
        }).addTo(map);

        for (const place of places) {
            const {_place_latitude, _place_longitude} = place.meta;
            let marker = L.marker([parseFloat(_place_latitude), parseFloat(_place_longitude)]).addTo(map);
            marker.bindPopup(`${place.title.rendered} <br> ${place.content.rendered}`);
        }
    }

    async function fetchPlaces() {
        try {
            const opts = {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            }
            const response = await fetch('http://localhost/chanvre-ariegeois.fr/wp-json/wp/v2/place', opts);
            const data = await response.json();

            return data;

        } catch (error) {
            console.error('Error fetching data:', error);
        }
    }

    /**
     * ajax_cart_modal_script
     */

    async function ajax_cart_modal_script() {
        try {
            const response = await fetch(ajaxurl + '?action=get_cart_content');
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const data = await response.json();
            return data;
        } catch (error) {
            console.error('Fetch Error:', error);
        }

    }

    const { hamburger, menuCloseBtn } = UI.navbar;


    if (isMobile()) {
        hamburger.addEventListener('click', toggleMenu, false);
        menuCloseBtn.addEventListener('click', toggleMenu, false);

    }
    addEventListener('resize', () => {

        if (!isMobile()) {
            hamburger.removeEventListener('click', toggleMenu);
            menuCloseBtn.removeEventListener('click', toggleMenu);
        }
        hamburger.addEventListener('click', toggleMenu);
        menuCloseBtn.addEventListener('click', toggleMenu);

    });



    initMap();


})

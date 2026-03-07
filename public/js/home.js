/* ----------------------------------------------------------
   NAVBAR STICKY + BOUTON RETOUR EN HAUT
   Déclencheur : scroll > 80px
---------------------------------------------------------- */
const navbar    = document.querySelector('.navbar');
const backToTop = document.getElementById('backToTop');

window.addEventListener('scroll', () => {
    if (window.scrollY > 80) {
        navbar.classList.add('scrolled');
        if (backToTop) backToTop.classList.add('visible');
    } else {
        navbar.classList.remove('scrolled');
        if (backToTop) backToTop.classList.remove('visible');
    }
});

if (backToTop) {
    backToTop.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
}


/* ----------------------------------------------------------
   WOW.JS — Initialisation des animations au scroll
---------------------------------------------------------- */
new WOW().init();


/* ----------------------------------------------------------
   MODAL VIDÉO HERO
   - Hover sur .play-wrapper : change le style du bouton
   - Clic sur #playBtn       : ouvre le modal avec l'URL YouTube
   - Fermeture du modal      : vide le src de l'iframe (arrêt autoplay)
---------------------------------------------------------- */
const playBtn      = document.getElementById('playBtn');
const videoModal   = document.getElementById('videoModal');
const videoIframe  = document.getElementById('videoIframe');
const playWrapper  = document.querySelector('.play-wrapper');

if (playWrapper && playBtn) {
    playWrapper.addEventListener('mouseenter', () => {
        playBtn.style.background    = '#FF6A00';
        playBtn.style.borderColor   = 'black';
        playBtn.querySelector('svg').style.stroke = 'black';
    });
    playWrapper.addEventListener('mouseleave', () => {
        playBtn.style.background    = 'transparent';
        playBtn.style.borderColor   = 'white';
        playBtn.querySelector('svg').style.stroke = 'white';
    });

    playBtn.addEventListener('click', () => {
        // Remplacer l'URL par celle de la vidéo de présentation du projet
        videoIframe.src = "https://www.youtube.com/embed/bGtaQn-SigM?si=5YIU0zbGiP-_K0GV&autoplay=1";
        new bootstrap.Modal(videoModal).show();
    });
}

if (videoModal) {
    videoModal.addEventListener('hidden.bs.modal', () => {
        videoIframe.src = "";
    });
}


/* ----------------------------------------------------------
   MODAL VIDÉO — Slides Watch Live
   Chaque slide porte l'URL dans son attribut data-video
---------------------------------------------------------- */
document.querySelectorAll('.slide-play-wrapper').forEach(wrapper => {
    const videoModal = document.getElementById('videoModal');
    const videoIframe = document.getElementById('videoIframe');
    
    if (videoModal && videoIframe) {
        wrapper.addEventListener('click', () => {
            const videoUrl = wrapper.closest('.swiper-slide').getAttribute('data-video');
            videoIframe.src = videoUrl;
            new bootstrap.Modal(videoModal).show();
        });
    }
});


/* ----------------------------------------------------------
   CARROUSEL SHOP
   4 slides desktop / 2 tablette / 1 mobile
---------------------------------------------------------- */
if (document.querySelector('.shop-swiper')) {
    new Swiper('.shop-swiper', {
        slidesPerView: 4,
        spaceBetween: 20,
        loop: true,
        navigation: {
            nextEl: '.shop-next',
            prevEl: '.shop-prev',
        },
        breakpoints: {
            0:    { slidesPerView: 1, spaceBetween: 12 },
            576:  { slidesPerView: 2, spaceBetween: 16 },
            992:  { slidesPerView: 3, spaceBetween: 20 },
            1200: { slidesPerView: 4, spaceBetween: 20 },
        },
    });
}


/* ----------------------------------------------------------
   CARROUSEL WATCH LIVE — Effet Coverflow
   Slide centrale agrandie (depth 200 / modifier 3)
   Flèches + pagination points (mobile)
---------------------------------------------------------- */
if (document.querySelector('.watch-swiper')) {
    new Swiper('.watch-swiper', {
        effect: 'coverflow',
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: 'auto',
        loop: true,
        coverflowEffect: {
            rotate: 0,
            stretch: 0,
            depth: 200,
            modifier: 3,
            slideShadows: false,
        },
        pagination: {
            el: '.watch-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.watch-next',
            prevEl: '.watch-prev',
        },
    });
}


/* ----------------------------------------------------------
   ANNÉE DYNAMIQUE — Footer copyright
---------------------------------------------------------- */
const currentYearEl = document.getElementById('currentYear');
if (currentYearEl) {
    currentYearEl.textContent = new Date().getFullYear();
}


/* ----------------------------------------------------------
   EFFET PARALLAX — Hero Background
   Déclencheur : scroll
---------------------------------------------------------- */
window.addEventListener('scroll', () => {
    const scrolled = window.scrollY;
    const heroParallax = document.querySelector('#hero .parallax');
    const rate = scrolled * 0.4;
    
    if (heroParallax && scrolled <= window.innerHeight) {
        heroParallax.style.transform = `translateY(${rate}px)`;
    }
});

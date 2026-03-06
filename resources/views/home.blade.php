<!-- Inclusion du header -->
@include('snippets.header')

<body>

    <!-- Inclusion de la navbar -->
    @include('snippets.navbar')


    <!-- ============================================================
         HERO
         - Image de fond semi-transparente (à remplacer par l'asset réel)
         - Titre + slogan avec animations Animate.css
         - Bouton play circulaire avec effet sonar → ouvre modal YouTube
    ============================================================ -->
    <section id="hero">
        <!-- Image de fond (remplacer src par l'image réelle du projet) -->
        <img class="bg-image parallax" src="{{ asset('img/labe.jpg') }}" alt="Hero background">

        <div class="container position-relative d-flex flex-column justify-content-center align-items-center h-100">
            <h1 class="display-3 fw-bold animate__animated animate__fadeInDown">LooterStrike</h1>
            <p class="lead mb-4 animate__animated animate__fadeInUp">Strike Fast. Loot Hard.</p>

            <!-- Bouton play + cercles sonar -->
            <div class="play-wrapper">
                <button id="playBtn" class="play-btn" aria-label="Regarder la vidéo">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <polygon points="6,3 20,12 6,21"/>
                    </svg>
                </button>
                <span class="circle-anim"></span>
                <span class="circle-anim delay1"></span>
                <span class="circle-anim delay2"></span>
            </div>
        </div>
    </section>


    <!-- ============================================================
         MATCHES
         - 3 lignes de matchs avec animation WOW fadeInLeft/Right
         - Chaque ligne : équipe gauche | score VS + date | équipe droite
         - Les logos des équipes sont à remplacer par les vrais assets
    ============================================================ -->
    <section id="upcoming-matches" class="matches-section">
        <div class="container">

            <!-- En-tête de section -->
            <div class="section-heading text-center mb-5 wow animate__animated animate__fadeInDown">
                <h3>Upcoming Matches</h3>
                <h2>Battles Extreme <br> Masters <span>Tournament</span></h2>
                <p>Our success in creating business solutions comes from our talented and committed team.</p>
            </div>

            <!-- Match 1 -->
            <div class="match-row">
                <div class="match-team left wow animate__animated animate__fadeInLeft" data-wow-delay="0ms">
                    <img src="https://placehold.co/60x60/1a1a2e/FF6A00?text=T1" alt="Purple Death Cadets">
                    <div>
                        <h4><a href="#">Purple Death Cadets</a></h4>
                        <div class="match-info">Group 04 | Match 06th</div>
                    </div>
                </div>
                <div class="match-center">
                    <div class="match-score">VS</div>
                    <div class="match-date">25TH May 2024 — 10:00</div>
                    <div class="watch-links">
                        <a href="https://www.youtube.com" target="_blank" rel="noopener"><i class="fab fa-youtube"></i></a>
                        <a href="https://www.twitch.tv"   target="_blank" rel="noopener"><i class="fab fa-twitch"></i></a>
                    </div>
                </div>
                <div class="match-team right wow animate__animated animate__fadeInRight" data-wow-delay="0ms">
                    <img src="https://placehold.co/60x60/1a1a2e/FF6A00?text=T2" alt="Trigger Brain Squad">
                    <div>
                        <h4><a href="#">Trigger Brain Squad</a></h4>
                        <div class="match-info">Group 04 | Match 06th</div>
                    </div>
                </div>
            </div>

            <!-- Match 2 -->
            <div class="match-row">
                <div class="match-team left wow animate__animated animate__fadeInLeft" data-wow-delay="150ms">
                    <img src="https://placehold.co/60x60/1a1a2e/FF6A00?text=T3" alt="The Black Hat Hackers">
                    <div>
                        <h4><a href="#">The Black Hat Hackers</a></h4>
                        <div class="match-info">Group 04 | Match 07th</div>
                    </div>
                </div>
                <div class="match-center">
                    <div class="match-score">VS</div>
                    <div class="match-date">10TH Jan 2024 — 12:30</div>
                    <div class="watch-links">
                        <a href="https://www.youtube.com" target="_blank" rel="noopener"><i class="fab fa-youtube"></i></a>
                        <a href="https://www.twitch.tv"   target="_blank" rel="noopener"><i class="fab fa-twitch"></i></a>
                    </div>
                </div>
                <div class="match-team right wow animate__animated animate__fadeInRight" data-wow-delay="150ms">
                    <img src="https://placehold.co/60x60/1a1a2e/FF6A00?text=T4" alt="Your Worst Nightmare">
                    <div>
                        <h4><a href="#">Your Worst Nightmare</a></h4>
                        <div class="match-info">Group 05 | Match 02nd</div>
                    </div>
                </div>
            </div>

            <!-- Match 3 -->
            <div class="match-row">
                <div class="match-team left wow animate__animated animate__fadeInLeft" data-wow-delay="300ms">
                    <img src="https://placehold.co/60x60/1a1a2e/FF6A00?text=T5" alt="Witches and Quizards">
                    <div>
                        <h4><a href="#">Witches and Quizards</a></h4>
                        <div class="match-info">Group 02 | Match 03rd</div>
                    </div>
                </div>
                <div class="match-center">
                    <div class="match-score">VS</div>
                    <div class="match-date">15TH Dec 2024 — 04:20</div>
                    <div class="watch-links">
                        <a href="https://www.youtube.com" target="_blank" rel="noopener"><i class="fab fa-youtube"></i></a>
                        <a href="https://www.twitch.tv"   target="_blank" rel="noopener"><i class="fab fa-twitch"></i></a>
                    </div>
                </div>
                <div class="match-team right wow animate__animated animate__fadeInRight" data-wow-delay="300ms">
                    <img src="https://placehold.co/60x60/1a1a2e/FF6A00?text=T6" alt="Resting Bitch Faces">
                    <div>
                        <h4><a href="#">Resting Bitch Faces</a></h4>
                        <div class="match-info">Group 02 | Match 03rd</div>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <!-- ============================================================
         WATCH LIVE
         - Carrousel Swiper en mode coverflow (5 slides)
         - data-video : URL YouTube embed à passer au modal au clic
         - Flèches .watch-prev/.watch-next + pagination .watch-pagination
    ============================================================ -->
    <section id="watch-live" class="watch-section">
        <div class="container">

            <!-- En-tête de section -->
            <div class="section-heading text-center mb-5 wow animate__animated animate__fadeInDown">
                <h3>Watch The Gameplay</h3>
                <h2>Watch Live <span>Streaming</span></h2>
                <p>Our success in creating business solutions comes from our talented and committed team.</p>
            </div>

            <div class="watch-carousel-wrap">
                <div class="swiper watch-swiper">
                    <div class="swiper-wrapper">

                        <!-- Slide 1 — Remplacer data-video par l'ID YouTube réel -->
                        <div class="swiper-slide" data-video="https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1">
                            <img src="https://placehold.co/900x500/1a1a2e/FF6A00?text=Match+Replay+1" alt="Stream 1">
                            <div class="slide-play-wrapper">
                                <button class="slide-play-btn" aria-label="Lancer la vidéo">
                                    <svg viewBox="0 0 24 24"><polygon points="6,3 20,12 6,21"/></svg>
                                </button>
                                <span class="slide-circle"></span>
                                <span class="slide-circle d1"></span>
                                <span class="slide-circle d2"></span>
                            </div>
                        </div>

                        <!-- Slide 2 -->
                        <div class="swiper-slide" data-video="https://www.youtube.com/embed/9bZkp7q19f0?autoplay=1">
                            <img src="https://placehold.co/900x500/1a1a2e/FF6A00?text=Match+Replay+2" alt="Stream 2">
                            <div class="slide-play-wrapper">
                                <button class="slide-play-btn" aria-label="Lancer la vidéo">
                                    <svg viewBox="0 0 24 24"><polygon points="6,3 20,12 6,21"/></svg>
                                </button>
                                <span class="slide-circle"></span>
                                <span class="slide-circle d1"></span>
                                <span class="slide-circle d2"></span>
                            </div>
                        </div>

                        <!-- Slide 3 -->
                        <div class="swiper-slide" data-video="https://www.youtube.com/embed/kJQP7kiw5Fk?autoplay=1">
                            <img src="https://placehold.co/900x500/1a1a2e/FF6A00?text=Match+Replay+3" alt="Stream 3">
                            <div class="slide-play-wrapper">
                                <button class="slide-play-btn" aria-label="Lancer la vidéo">
                                    <svg viewBox="0 0 24 24"><polygon points="6,3 20,12 6,21"/></svg>
                                </button>
                                <span class="slide-circle"></span>
                                <span class="slide-circle d1"></span>
                                <span class="slide-circle d2"></span>
                            </div>
                        </div>

                        <!-- Slide 4 -->
                        <div class="swiper-slide" data-video="https://www.youtube.com/embed/RgKAFK5djSk?autoplay=1">
                            <img src="https://placehold.co/900x500/1a1a2e/FF6A00?text=Match+Replay+4" alt="Stream 4">
                            <div class="slide-play-wrapper">
                                <button class="slide-play-btn" aria-label="Lancer la vidéo">
                                    <svg viewBox="0 0 24 24"><polygon points="6,3 20,12 6,21"/></svg>
                                </button>
                                <span class="slide-circle"></span>
                                <span class="slide-circle d1"></span>
                                <span class="slide-circle d2"></span>
                            </div>
                        </div>

                        <!-- Slide 5 -->
                        <div class="swiper-slide" data-video="https://www.youtube.com/embed/JGwWNGJdvx8?autoplay=1">
                            <img src="https://placehold.co/900x500/1a1a2e/FF6A00?text=Match+Replay+5" alt="Stream 5">
                            <div class="slide-play-wrapper">
                                <button class="slide-play-btn" aria-label="Lancer la vidéo">
                                    <svg viewBox="0 0 24 24"><polygon points="6,3 20,12 6,21"/></svg>
                                </button>
                                <span class="slide-circle"></span>
                                <span class="slide-circle d1"></span>
                                <span class="slide-circle d2"></span>
                            </div>
                        </div>

                    </div>
                    <div class="swiper-button-prev watch-prev"></div>
                    <div class="swiper-button-next watch-next"></div>
                    <div class="swiper-pagination watch-pagination"></div>
                </div>
            </div>

        </div>
    </section>


    <!-- ============================================================
         SHOP — Affiliation Amazon
         - Carrousel Swiper 4/2/1 colonnes selon la taille d'écran
         - Remplacer les href="#" des .product-btn par les liens affiliés réels
         - Remplacer les images placehold.co par les vraies photos produit
    ============================================================ -->
    <section id="shop" class="shop-section">
        <div class="container">

            <!-- En-tête de section -->
            <div class="section-heading text-center mb-5 wow animate__animated animate__fadeInDown">
                <h3>Tendances Gaming</h3>
                <h2>Top Gear <span>Amazon</span></h2>
                <p>Les meilleurs équipements gaming du moment, sélectionnés pour vous.</p>
            </div>

            <div class="shop-carousel-wrap">
                <div class="swiper shop-swiper">
                    <div class="swiper-wrapper">

                        <!-- Produit 1 : Mouse -->
                        <div class="swiper-slide">
                            <div class="product-card">
                                <div class="product-thumb">
                                    <img src="https://placehold.co/300x260/1a1a2e/FF6A00?text=Mouse" alt="Souris gaming">
                                    <span class="product-badge hot">Hot</span>
                                    <a class="product-btn" href="#" target="_blank" rel="noopener sponsored"><i class="fab fa-amazon"></i> Voir sur Amazon</a>
                                </div>
                                <div class="product-info">
                                    <div class="product-top">
                                        <span class="product-cat">Mouse</span>
                                        <div class="product-stars">
                                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                        </div>
                                    </div>
                                    <h5><a href="#">Fantech Pro Mouse</a></h5>
                                    <span class="product-price">$49.00</span>
                                </div>
                            </div>
                        </div>

                        <!-- Produit 2 : Keyboard -->
                        <div class="swiper-slide">
                            <div class="product-card">
                                <div class="product-thumb">
                                    <img src="https://placehold.co/300x260/1a1a2e/FF6A00?text=Keyboard" alt="Clavier mécanique">
                                    <span class="product-badge sale">-30%</span>
                                    <a class="product-btn" href="#" target="_blank" rel="noopener sponsored"><i class="fab fa-amazon"></i> Voir sur Amazon</a>
                                </div>
                                <div class="product-info">
                                    <div class="product-top">
                                        <span class="product-cat">Keyboard</span>
                                        <div class="product-stars">
                                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                                        </div>
                                    </div>
                                    <h5><a href="#">Mechanical RGB Keyboard</a></h5>
                                    <span class="product-price">$89.00</span>
                                </div>
                            </div>
                        </div>

                        <!-- Produit 3 : Headset -->
                        <div class="swiper-slide">
                            <div class="product-card">
                                <div class="product-thumb">
                                    <img src="https://placehold.co/300x260/1a1a2e/FF6A00?text=Headset" alt="Casque gaming">
                                    <span class="product-badge instock">In Stock</span>
                                    <a class="product-btn" href="#" target="_blank" rel="noopener sponsored"><i class="fab fa-amazon"></i> Voir sur Amazon</a>
                                </div>
                                <div class="product-info">
                                    <div class="product-top">
                                        <span class="product-cat">Headset</span>
                                        <div class="product-stars">
                                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                        </div>
                                    </div>
                                    <h5><a href="#">7.1 Surround Headset</a></h5>
                                    <span class="product-price">$69.00</span>
                                </div>
                            </div>
                        </div>

                        <!-- Produit 4 : Monitor -->
                        <div class="swiper-slide">
                            <div class="product-card">
                                <div class="product-thumb">
                                    <img src="https://placehold.co/300x260/1a1a2e/FF6A00?text=Monitor" alt="Écran gaming">
                                    <span class="product-badge hot">Hot</span>
                                    <a class="product-btn" href="#" target="_blank" rel="noopener sponsored"><i class="fab fa-amazon"></i> Voir sur Amazon</a>
                                </div>
                                <div class="product-info">
                                    <div class="product-top">
                                        <span class="product-cat">Monitor</span>
                                        <div class="product-stars">
                                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                                        </div>
                                    </div>
                                    <h5><a href="#">144Hz Gaming Monitor</a></h5>
                                    <span class="product-price">$249.00</span>
                                </div>
                            </div>
                        </div>

                        <!-- Produit 5 : Chair -->
                        <div class="swiper-slide">
                            <div class="product-card">
                                <div class="product-thumb">
                                    <img src="https://placehold.co/300x260/1a1a2e/FF6A00?text=Chair" alt="Chaise gaming">
                                    <span class="product-badge instock">In Stock</span>
                                    <a class="product-btn" href="#" target="_blank" rel="noopener sponsored"><i class="fab fa-amazon"></i> Voir sur Amazon</a>
                                </div>
                                <div class="product-info">
                                    <div class="product-top">
                                        <span class="product-cat">Chair</span>
                                        <div class="product-stars">
                                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                        </div>
                                    </div>
                                    <h5><a href="#">Ergonomic Gaming Chair</a></h5>
                                    <span class="product-price">$199.00</span>
                                </div>
                            </div>
                        </div>

                        <!-- Produit 6 : Controller -->
                        <div class="swiper-slide">
                            <div class="product-card">
                                <div class="product-thumb">
                                    <img src="https://placehold.co/300x260/1a1a2e/FF6A00?text=Controller" alt="Manette gaming">
                                    <span class="product-badge sale">-20%</span>
                                    <a class="product-btn" href="#" target="_blank" rel="noopener sponsored"><i class="fab fa-amazon"></i> Voir sur Amazon</a>
                                </div>
                                <div class="product-info">
                                    <div class="product-top">
                                        <span class="product-cat">Controller</span>
                                        <div class="product-stars">
                                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                                        </div>
                                    </div>
                                    <h5><a href="#">Xbox Pro Controller</a></h5>
                                    <span class="product-price">$79.00</span>
                                </div>
                            </div>
                        </div>

                        <!-- Produit 7 : Mousepad -->
                        <div class="swiper-slide">
                            <div class="product-card">
                                <div class="product-thumb">
                                    <img src="https://placehold.co/300x260/1a1a2e/FF6A00?text=Mousepad" alt="Tapis de souris XXL">
                                    <span class="product-badge instock">In Stock</span>
                                    <a class="product-btn" href="#" target="_blank" rel="noopener sponsored"><i class="fab fa-amazon"></i> Voir sur Amazon</a>
                                </div>
                                <div class="product-info">
                                    <div class="product-top">
                                        <span class="product-cat">Mousepad</span>
                                        <div class="product-stars">
                                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                        </div>
                                    </div>
                                    <h5><a href="#">XXL Desk Mousepad</a></h5>
                                    <span class="product-price">$29.00</span>
                                </div>
                            </div>
                        </div>

                        <!-- Produit 8 : Webcam -->
                        <div class="swiper-slide">
                            <div class="product-card">
                                <div class="product-thumb">
                                    <img src="https://placehold.co/300x260/1a1a2e/FF6A00?text=Webcam" alt="Webcam 4K">
                                    <span class="product-badge hot">Hot</span>
                                    <a class="product-btn" href="#" target="_blank" rel="noopener sponsored"><i class="fab fa-amazon"></i> Voir sur Amazon</a>
                                </div>
                                <div class="product-info">
                                    <div class="product-top">
                                        <span class="product-cat">Webcam</span>
                                        <div class="product-stars">
                                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                                        </div>
                                    </div>
                                    <h5><a href="#">4K Streaming Webcam</a></h5>
                                    <span class="product-price">$119.00</span>
                                </div>
                            </div>
                        </div>

                        <!-- Produit 9 : Microphone -->
                        <div class="swiper-slide">
                            <div class="product-card">
                                <div class="product-thumb">
                                    <img src="https://placehold.co/300x260/1a1a2e/FF6A00?text=Microphone" alt="Microphone USB">
                                    <span class="product-badge sale">-15%</span>
                                    <a class="product-btn" href="#" target="_blank" rel="noopener sponsored"><i class="fab fa-amazon"></i> Voir sur Amazon</a>
                                </div>
                                <div class="product-info">
                                    <div class="product-top">
                                        <span class="product-cat">Microphone</span>
                                        <div class="product-stars">
                                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                        </div>
                                    </div>
                                    <h5><a href="#">USB Condenser Microphone</a></h5>
                                    <span class="product-price">$89.00</span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="swiper-button-prev shop-prev"></div>
                    <div class="swiper-button-next shop-next"></div>
                </div>
            </div>

        </div>
    </section>


    <!-- ============================================================
         NEWS — Grille 3 cartes d'actualités
         - .news-tag       : badge catégorie (coin haut gauche)
         - .news-read-more : lien flèche qui s'écarte au hover
         - WOW.js          : fadeInUp avec délais décalés (100/250/400ms)
    ============================================================ -->
    <section id="news" class="news-section">
        <div class="container">

            <!-- En-tête de section -->
            <div class="section-heading text-center mb-5 wow animate__animated animate__fadeInDown">
                <h3>Actualités</h3>
                <h2>Latest <span>News</span></h2>
                <p>Restez informé des dernières nouvelles de la scène esport et gaming.</p>
            </div>

            <div class="row g-4">
                <!-- Carte 1 -->
                <div class="col-lg-4 col-md-6">
                    <article class="news-card wow animate__animated animate__fadeInUp" data-wow-delay="100ms">
                        <div class="news-thumb">
                            <img src="https://placehold.co/600x400/1a1a2e/FF6A00?text=News+1" alt="Actualité 1">
                            <span class="news-tag">Tournoi</span>
                        </div>
                        <div class="news-body">
                            <ul class="news-meta">
                                <li><i class="far fa-calendar-alt"></i> 15 Mars 2024</li>
                                <li><i class="far fa-user"></i> Admin</li>
                            </ul>
                            <h4><a href="#">LooterStrike Championship : Les équipes qualifiées</a></h4>
                            <p>Découvrez les équipes qui se sont qualifiées pour la grande finale du championship...</p>
                            <a href="#" class="news-read-more">Lire la suite <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </article>
                </div>

                <!-- Carte 2 -->
                <div class="col-lg-4 col-md-6">
                    <article class="news-card wow animate__animated animate__fadeInUp" data-wow-delay="250ms">
                        <div class="news-thumb">
                            <img src="https://placehold.co/600x400/1a1a2e/FF6A00?text=News+2" alt="Actualité 2">
                            <span class="news-tag">Technique</span>
                        </div>
                        <div class="news-body">
                            <ul class="news-meta">
                                <li><i class="far fa-calendar-alt"></i> 10 Mars 2024</li>
                                <li><i class="far fa-user"></i> Admin</li>
                            </ul>
                            <h4><a href="#">Guide : Comment améliorer votre aim</a></h4>
                            <p>Nos joueurs professionnels partagent leurs conseils pour perfectionner votre visée...</p>
                            <a href="#" class="news-read-more">Lire la suite <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </article>
                </div>

                <!-- Carte 3 -->
                <div class="col-lg-4 col-md-6">
                    <article class="news-card wow animate__animated animate__fadeInUp" data-wow-delay="400ms">
                        <div class="news-thumb">
                            <img src="https://placehold.co/600x400/1a1a2e/FF6A00?text=News+3" alt="Actualité 3">
                            <span class="news-tag">Équipement</span>
                        </div>
                        <div class="news-body">
                            <ul class="news-meta">
                                <li><i class="far fa-calendar-alt"></i> 5 Mars 2024</li>
                                <li><i class="far fa-user"></i> Admin</li>
                            </ul>
                            <h4><a href="#">Top 10 des souris gaming en 2024</a></h4>
                            <p>Nous avons testé les meilleures souris gaming du marché pour vous...</p>
                            <a href="#" class="news-read-more">Lire la suite <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </article>
                </div>
            </div>

        </div>
    </section>

    <!-- Inclusion du footer -->
    @include('snippets.footer')

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
                    <div class="swiper-wrapper" id="products-container">

                        <!-- Les produits seront chargés dynamiquement depuis /api/products -->

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
                @forelse($articles as $index => $article)
                <div class="col-lg-4 col-md-6">
                    <article class="news-card wow animate__animated animate__fadeInUp" data-wow-delay="{{ $index * 100 }}ms">
                        <div class="news-thumb">
                            @if($article['image'])
                            <img src="{{ $article['image'] }}" alt="{{ Str::limit($article['title'], 50) }}">
                            @else
                            <img src="https://placehold.co/600x400/1a1a2e/FF6A00?text=News" alt="Actualité">
                            @endif
                            <span class="news-tag">{{ $article['source'] }}</span>
                        </div>
                        <div class="news-body">
                            <ul class="news-meta">
                                <li><i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($article['date'])->translatedFormat('d M Y') }}</li>
                                <li><i class="far fa-user"></i> {{ $article['author'] }}</li>
                                <li><i class="fas fa-newspaper"></i> {{ $article['source'] }}</li>
                            </ul>
                            <h4><a href="{{ $article['link'] }}" target="_blank" rel="noopener">{{ Str::limit($article['title'], 60) }}</a></h4>
                            @if(!empty($article['content']))
                            <p>{!! Str::words(html_entity_decode(strip_tags($article['content'])), 30, '...') !!}</p>
                            @else
                            <p class="text-muted small">Cliquez pour lire la suite...</p>
                            @endif
                            <a href="{{ $article['link'] }}" target="_blank" rel="noopener" class="news-read-more">Lire la suite sur {{ $article['source'] }} <i class="fas fa-external-link-alt"></i></a>
                        </div>
                    </article>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p class="text-muted">Aucune actualité disponible pour le moment.</p>
                </div>
                @endforelse
            </div>

        </div>
    </section>

    <!-- Script pour charger les produits dynamiquement -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch('/api/products')
            .then(response => response.json())
            .then(products => {
                const container = document.getElementById('products-container');
                
                products.forEach(product => {
                    // Générer les étoiles
                    let starsHtml = '';
                    for (let i = 1; i <= 5; i++) {
                        if (i <= product.stars) {
                            starsHtml += '<i class="fas fa-star"></i>';
                        } else {
                            starsHtml += '<i class="far fa-star"></i>';
                        }
                    }

                    // Déterminer l'URL de l'image
                    const imageUrl = product.image || `https://placehold.co/300x260/1a1a2e/FF6A00?text=${encodeURIComponent(product.category)}`;

                    // Générer le HTML du produit
                    const productHtml = `
                        <div class="swiper-slide">
                            <div class="product-card">
                                <div class="product-thumb">
                                    <img src="${imageUrl}" alt="${product.title}">
                                    ${product.badge ? `<span class="product-badge ${product.badge}">${product.badge_label}</span>` : ''}
                                    <a class="product-btn" href="${product.amazon_url}" target="_blank" rel="noopener sponsored"><i class="fab fa-amazon"></i> Voir sur Amazon</a>
                                </div>
                                <div class="product-info">
                                    <div class="product-top">
                                        <span class="product-cat">${product.category}</span>
                                        <div class="product-stars">
                                            ${starsHtml}
                                        </div>
                                    </div>
                                    <h5><a href="${product.amazon_url}" target="_blank" rel="noopener sponsored">${product.title}</a></h5>
                                    <span class="product-price">${product.price > 0 ? '$' + product.price : 'Check price'}</span>
                                </div>
                            </div>
                        </div>
                    `;
                    
                    container.insertAdjacentHTML('beforeend', productHtml);
                });
            })
            .catch(error => {
                console.error('Erreur lors du chargement des produits:', error);
                const container = document.getElementById('products-container');
                container.innerHTML = '<p class="text-center text-gray-400">Aucun produit disponible pour le moment.</p>';
            });
    });
    </script>

    <!-- Inclusion du footer -->
    @include('snippets.footer')

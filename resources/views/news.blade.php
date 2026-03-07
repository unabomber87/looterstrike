<!-- Inclusion du header -->
@include('snippets.header')

<body>

    <!-- Inclusion de la navbar -->
    @include('snippets.navbar')


    <!-- ============================================================
         HERO SECTION - Page News
    ============================================================ -->
    <section id="hero-news" class="hero-section">
        <!-- Image de fond -->
        <img class="bg-image parallax" src="{{ asset('img/labe.jpg') }}" alt="News background">
        
        <div class="hero-overlay"></div>
        
        <div class="container position-relative d-flex flex-column justify-content-center align-items-center h-100">
            <h1 class="display-3 fw-bold animate__animated animate__fadeInDown">Actualités</h1>
            <p class="lead mb-4 animate__animated animate__fadeInUp">Les dernières nouvelles de la scène gaming et esport</p>
            
            <!-- Scroll indicator -->
            <div class="scroll-indicator animate__animated animate__bounce animate__infinite">
                <i class="fas fa-chevron-down"></i>
            </div>
        </div>
    </section>


    <!-- ============================================================
         NEWS SECTION - Infinite Scroll
    ============================================================ -->
    <section id="news-section" class="news-section">
        <div class="container">

            <!-- En-tête de section -->
            <div class="section-heading text-center mb-5 wow animate__animated animate__fadeInDown">
                <h3>Actualités</h3>
                <h2>Latest <span>News</span></h2>
                <p>Restez informé des dernières nouvelles de la scène esport et gaming.</p>
            </div>

            <!-- Grid des articles -->
            <div class="row g-4" id="news-grid">
                @forelse($articles as $index => $article)
                <div class="col-lg-4 col-md-6 news-item" data-wow-delay="{{ $index * 100 }}ms">
                    <article class="news-card wow animate__animated animate__fadeInUp">
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

            <!-- Loader pour infinite scroll -->
            <div id="news-loader" class="text-center py-5" style="display: none;">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Chargement...</span>
                </div>
                <p class="mt-2 text-muted">Chargement des articles...</p>
            </div>

            <!-- Message de fin -->
            <div id="news-end" class="text-center py-4" style="display: none;">
                <div class="news-end-message">
                    <i class="fas fa-check-circle"></i>
                    <p>Vous avez vu tous les articles !</p>
                </div>
            </div>

        </div>
    </section>

    <!-- Inclusion du footer -->
    @include('snippets.footer')


    <!-- ============================================================
         JavaScript pour Infinite Scroll
    ============================================================ -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const newsGrid = document.getElementById('news-grid');
        const loader = document.getElementById('news-loader');
        const endMessage = document.getElementById('news-end');
        
        let currentPage = 1;
        let isLoading = false;
        let hasMore = {{ $articles->hasMorePages() ? 'true' : 'false' }};
        const limit = 9;
        
        // Fonction pour charger plus d'articles
        async function loadMoreArticles() {
            if (isLoading || !hasMore) return;
            
            isLoading = true;
            loader.style.display = 'block';
            
            try {
                const response = await fetch(`/api/news?page=${currentPage + 1}&limit=${limit}`);
                const data = await response.json();
                
                if (data.articles && data.articles.length > 0) {
                    // Créer un fragment pour ajouter les éléments en une seule fois (plus performant)
                    const fragment = document.createDocumentFragment();
                    
                    // Ajouter les nouveaux articles avec animation fluide
                    data.articles.forEach((article, index) => {
                        const col = document.createElement('div');
                        col.className = 'col-lg-4 col-md-6 news-item fade-in-up';
                        col.style.animationDelay = (index * 0.1) + 's';
                        col.innerHTML = `
                            <article class="news-card">
                                <div class="news-thumb">
                                    ${article.image 
                                        ? `<img src="${article.image}" alt="${article.title.substring(0, 50)}">`
                                        : `<img src="https://placehold.co/600x400/1a1a2e/FF6A00?text=News" alt="Actualité">`
                                    }
                                    <span class="news-tag">${article.source}</span>
                                </div>
                                <div class="news-body">
                                    <ul class="news-meta">
                                        <li><i class="far fa-calendar-alt"></i> ${formatDate(article.date)}</li>
                                        <li><i class="far fa-user"></i> ${article.author || 'Inconnu'}</li>
                                        <li><i class="fas fa-newspaper"></i> ${article.source}</li>
                                    </ul>
                                    <h4><a href="${article.link}" target="_blank" rel="noopener">${article.title.substring(0, 60)}${article.title.length > 60 ? '...' : ''}</a></h4>
                                    ${article.content 
                                        ? `<p>${article.content.substring(0, 150)}${article.content.length > 150 ? '...' : ''}</p>`
                                        : `<p class="text-muted small">Cliquez pour lire la Suite...</p>`
                                    }
                                    <a href="${article.link}" target="_blank" rel="noopener" class="news-read-more">Lire la suite sur ${article.source} <i class="fas fa-external-link-alt"></i></a>
                                </div>
                            </article>
                        `;
                        fragment.appendChild(col);
                    });
                    
                    // Ajouter le fragment au DOM en une seule opération
                    newsGrid.appendChild(fragment);
                    
                    currentPage++;
                    hasMore = data.hasMore;
                }
                
                if (!hasMore) {
                    endMessage.style.display = 'block';
                }
                
            } catch (error) {
                console.error('Erreur lors du chargement des articles:', error);
            } finally {
                isLoading = false;
                loader.style.display = 'none';
            }
        }
        
        // Fonction pour formater la date
        function formatDate(dateString) {
            const date = new Date(dateString);
            const months = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'];
            return `${date.getDate()} ${months[date.getMonth()]} ${date.getFullYear()}`;
        }
        
        // Détecter le scroll pour infinite scroll avec debounce
        let scrollTimeout;
        window.addEventListener('scroll', function() {
            if (scrollTimeout) {
                clearTimeout(scrollTimeout);
            }
            scrollTimeout = setTimeout(function() {
                const scrollPosition = window.innerHeight + window.scrollY;
                const pageHeight = document.documentElement.scrollHeight;
                
                // Charger plus quand on est à 400px du bas
                if (pageHeight - scrollPosition < 400) {
                    loadMoreArticles();
                }
            }, 200);
        });
        
        // Précharger plus d'articles au début si disponibles
        @if($articles->hasMorePages())
        setTimeout(loadMoreArticles, 2500);
        @endif
    });
    </script>

    <style>
    /* Styles spécifiques pour la page news */
    #hero-news {
        position: relative;
        height: 60vh;
        min-height: 400px;
        overflow: hidden;
    }
    
    #hero-news .bg-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 0;
    }
    
    #hero-news .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, rgba(26, 26, 46, 0.7), rgba(26, 26, 46, 0.9));
        z-index: 1;
    }
    
    #hero-news .container {
        position: relative;
        z-index: 2;
    }
    
    .scroll-indicator {
        margin-top: 2rem;
        color: #FF6A00;
        font-size: 2rem;
    }
    
    .news-section {
        padding: 80px 0;
        background: linear-gradient(180deg, #0f0f1a 0%, #1a1a2e 100%);
        min-height: 100vh;
    }
    
    /* Animation fluide pour les nouveaux articles */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .fade-in-up {
        animation: fadeInUp 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        opacity: 0;
    }
    
    /* Loader animation */
    #news-loader .spinner-border {
        color: #FF6A00 !important;
        width: 3rem;
        height: 3rem;
    }
    
    /* News card hover effect */
    .news-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .news-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(255, 106, 0, 0.2);
    }
    
    /* Message de fin stylisé */
    .news-end-message {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        padding: 16px 32px;
        background: linear-gradient(135deg, rgba(255, 106, 0, 0.15) 0%, rgba(255, 106, 0, 0.05) 100%);
        border: 1px solid rgba(255, 106, 0, 0.3);
        border-radius: 50px;
        animation: fadeIn 0.5s ease;
    }
    
    .news-end-message i {
        font-size: 1.5rem;
        color: #FF6A00;
    }
    
    .news-end-message p {
        margin: 0;
        font-size: 1.1rem;
        color: #FF6A00;
        font-weight: 500;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    </style>

</body>
</html>

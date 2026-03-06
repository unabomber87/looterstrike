<!-- ============================================================
     FOOTER — 4 colonnes : Brand | Liens | Contact | Newsletter
     - .footer-title::after  : trait orange sous chaque titre
     - .footer-links a::before : point orange au hover
     - .footer-bottom        : bande copyright semi-transparente
============================================================ -->
<footer class="site-footer">
    <div class="container">
        <div class="row">
            <!-- Colonne Brand -->
            <div class="col-lg-3 col-md-6 footer-item mb-4">
                <a class="footer-brand" href="{{ route('home') }}">Looter<span>Strike</span></a>
                <p>Votre source principale pour les tournois de gaming, les streams en direct et l'actualité esport.</p>
                <ul class="footer-social">
                    <li><a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a></li>
                </ul>
            </div>

            <!-- Colonne Liens utiles -->
            <div class="col-lg-3 col-md-6 footer-item mb-4">
                <h4 class="footer-title">Liens utiles</h4>
                <ul class="footer-links">
                    <li><a href="#">Accueil</a></li>
                    <li><a href="#upcoming-matches">Matchs</a></li>
                    <li><a href="#watch-live">Live</a></li>
                    <li><a href="#shop">Shop</a></li>
                    <li><a href="#news">Actualités</a></li>
                </ul>
            </div>

            <!-- Colonne Contact -->
            <div class="col-lg-3 col-md-6 footer-item mb-4">
                <h4 class="footer-title">Contact</h4>
                <ul class="footer-contact">
                    <li><i class="fas fa-map-marker-alt"></i> Paris, France</li>
                    <li><i class="fas fa-envelope"></i> contact@looterstrike.com</li>
                    <li><i class="fas fa-phone"></i> +33 1 23 45 67 89</li>
                </ul>
            </div>

            <!-- Colonne Newsletter -->
            <div class="col-lg-3 col-md-6 footer-item mb-4">
                <h4 class="footer-title">Newsletter</h4>
                <p style="font-size: 0.88rem; opacity: 0.6; margin-bottom: 1rem;">Abonnez-vous pour recevoir nos dernières nouvelles et offres spéciales.</p>
                <form class="footer-newsletter" action="#" method="POST">
                    <input type="email" placeholder="Votre email" required>
                    <button type="submit" class="footer-subscribe"><span>S'abonner</span></button>
                </form>
            </div>
        </div>
    </div>

    <!-- Barre copyright -->
    <div class="footer-bottom">
        <div class="container">
            <p>&copy; <span id="currentYear"></span> LooterStrike. Tous droits réservés.</p>
        </div>
    </div>
</footer>


<!-- ============================================================
     BOUTON RETOUR EN HAUT
     - Classe .visible ajoutée / retirée par le listener scroll JS
============================================================ -->
<button class="back-to-top" id="backToTop" aria-label="Retour en haut">
    <i class="fas fa-chevron-up"></i>
</button>


<!-- ============================================================
     MODAL VIDÉO
============================================================ -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="background: #000; border: none;">
            <div class="modal-body p-0 position-relative">
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Fermer"></button>
                <div class="ratio ratio-16x9">
                    <iframe id="videoIframe" src="" title="LooterStrike video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- ============================================================
     SCRIPTS — Tous les JS sont regroupés ici en bas de page
     Ordre important :
       1. Swiper       (carrousels)
       2. Bootstrap    (modal)
       3. WOW.js       (animations au scroll)
       4. Script custom (navbar sticky, modal vidéo, carrousels init)
============================================================ -->

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Bootstrap 5 JS (bundle = Popper inclus) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- WOW.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>

<!-- Custom JS -->
<script src="{{ asset('js/home.js') }}"></script>

</body>
</html>

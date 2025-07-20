<?php
?>
</main>

<footer class="bg-[#f5f5dc] pt-10 pb-2 mt-auto">

    <div class="container flex gap-20 justify-evenly pb-10">
        <div class="max-w-md text-justify">
            <h3 class="text-2xl font-bold mb-6">À propos de nous</h3>
            <p>
                Eventribe connecte organisateurs et passionnés à travers des rencontres humaines et projets culturels.
                Que vous soyez artiste, pro ou curieux, la plateforme vous accompagne : création d’événements, inscriptions, suivi et bien plus encore.
                Notre mantra : accessibilité, créativité, fluidité. <br>Rejoignez la tribu et donnez vie à vos idées !
            </p>
        </div>
        <div>
            <h3 class="text-2xl font-bold mb-6">Navigation</h3>
            <ul class="flex flex-col space-x-4 text-lg font-medium">
                <li><a href="/" class="hover:text-[#ff952aff] transition duration-300">Accueil</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="/my_events.php" class="hover:text-[#ff952aff] transition duration-300">Mes Inscriptions</a></li>
                    <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                        <li><a href="/admin/index.php" class="hover:text-[#ff952aff] transition duration-300">Admin</a></li>
                    <?php endif; ?>
                    <li><a href="/logout.php" class="hover:text-[#ff952aff] transition duration-300">Déconnexion (<?php echo htmlspecialchars($_SESSION['username']); ?>)</a></li>
                <?php else: ?>
                    <li><a href="/login.php" class="hover:text-[#ff952aff] transition duration-300">Connexion</a></li>
                    <li><a href="/register.php" class="hover:text-[#ff952aff] transition duration-300">Inscription</a></li>
                <?php endif; ?>
            </ul>
        </div>
        <div>
            <a href="/" class="relative text-lg font-semibold mb-2 md:mb-0 w-[180px] h-[75px] flex items-center justify-center overflow-hidden group">
                <span class="relative z-10 hover:text-[#ff952aff] bg-[#f5f5dc] transition-colors duration-300 ease-in-out cursor-pointer">eventribe</span>
                <div class="absolute inset-0 w-[180px] h-[80px] bg-[url('/assets/img/SplashPaintCom.svg')] group-hover:bg-[url('/assets/img/SplashPaintOrange.svg')] bg-no-repeat bg-center bg-contain opacity-80 animate-pulse"></div>
            </a>
        </div>
    </div>
    <div class="container text-center text-sm">
        &copy; <?php echo date('Y'); ?> Gestion d'Événements. Tous droits réservés.
    </div>
</footer>
</body>

</html>
<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'Gestion d\'Événements'; ?></title>
    <link href="/assets/css/src/output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
        .container {
            max-width: 95%;
            margin: 0 auto;
        }
    </style>
</head>

<body class="min-h-screen w-full flex flex-col text-[#333] bg-[#f5f5dc] font-['Inter', sans-serif]"
    style="background-image: url('/assets/img/SplashPaintOrange.svg'); background-repeat: no-repeat; background-position: center; background-size: cover; background-attachment: fixed;">
    <header class="bg-gradient-to-r from-[#f5f5dc] to-[rgb(248,248,236)] text-gray-900 shadow-lg px-6">
        <nav class="container flex flex-col px-4 md:flex-row justify-between items-center">
            <a href="/" class="relative text-lg font-semibold mb-2 md:mb-0 w-[180px] h-[75px] flex items-center justify-center overflow-hidden group">
                <span class="relative z-10 hover:text-[#ff952aff] bg-[#f5f5dc] transition-colors duration-300 ease-in-out cursor-pointer">eventribe</span>
                <div class="absolute inset-0 w-[180px] h-[80px] bg-[url('/assets/img/SplashPaintCom.svg')] group-hover:bg-[url('/assets/img/SplashPaintOrange.svg')] bg-no-repeat bg-center bg-contain opacity-80 animate-pulse"></div>
            </a>

            <ul class="flex space-x-4 text-lg font-medium">
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
        </nav>
    </header>

    <main class="flex-grow container py-4 px-1 md:py-12 md:px-6">
        <?php
        // Affiche les messages de session (succès/erreur)
        if (isset($_SESSION['message'])): ?>
            <div class="p-4 mb-4 rounded-lg <?php echo strpos($_SESSION['message'], 'réussie') !== false || strpos($_SESSION['message'], 'succès') !== false ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>" role="alert">
                <?php echo htmlspecialchars($_SESSION['message']); ?>
            </div>
        <?php unset($_SESSION['message']); // Supprime le message après l'affichage
        endif;
        ?>
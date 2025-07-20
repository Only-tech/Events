<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Assure que les fonctions d'authentification sont disponibles
require_once '../includes/auth_functions.php';

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'Administration'; ?></title>
    <link rel="stylesheet" href="/assets/css/src/output.css">

    <style>
        .container {
            max-width: 95%;
            margin: 0 auto;
        }

        a:active,
        button:active {
            transform: scale(0.95);
        }

        #preview {
            display: none;
        }
    </style>
</head>

<body class="min-h-screen w-full flex flex-col text-[#333] bg-[#f4f7f6] font-['Inter', sans-serif]">
    <header class="bg-gradient-to-r from-gray-800 to-gray-900 text-white shadow-lg py-4 px-6">
        <nav class="container flex flex-col md:flex-row justify-between items-center">
            <a href="/admin/index.php" class="text-2xl font-bold mb-2 md:mb-0">Administration</a>
            <ul class="flex space-x-4">
                <li><a href="/admin/index.php" class="hover:text-gray-300 transition duration-300">Tableau de bord</a></li>
                <li><a href="/admin/manage_events.php" class="hover:text-gray-300 transition duration-300">Gérer les Événements</a></li>
                <li><a href="/admin/manage_registrations.php" class="hover:text-gray-300 transition duration-300">Gérer les Inscriptions</a></li>
                <li><a href="/admin/manage_users.php" class="hover:text-gray-300 transition duration-300">Gérer les Utilisateurs</a></li>
                <li><a href="../logout.php" class="hover:text-gray-300 transition duration-300">Déconnexion (<?php echo htmlspecialchars($_SESSION['username']); ?>)</a></li>
            </ul>
        </nav>
    </header>

    <main class="flex-grow container py-4 px-1 md:py-15 md:px-0 xl:px-8">
        <?php
        // Affiche les messages de session (succès/erreur)
        if (isset($_SESSION['message'])): ?>
            <div class="p-4 mb-4 rounded-lg <?php echo strpos($_SESSION['message'], 'réussie') !== false || strpos($_SESSION['message'], 'succès') !== false ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>" role="alert">
                <?php echo htmlspecialchars($_SESSION['message']); ?>
            </div>
        <?php unset($_SESSION['message']); // Supprime le message après l'affichage
        endif;
        ?>
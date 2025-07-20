<?php

require_once './includes/db_connect.php';
require_once './includes/auth_functions.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $_SESSION['message'] = "Veuillez remplir tous les champs.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "Format d'email invalide.";
    } elseif ($password !== $confirm_password) {
        $_SESSION['message'] = "Les mots de passe ne correspondent pas.";
    } elseif (strlen($password) < 6) {
        $_SESSION['message'] = "Le mot de passe doit contenir au moins 6 caractères.";
    } else {
        if (registerUser($username, $email, $password)) {
            header('Location: login.php'); // Redirige vers la page de connexion après inscription réussie
            exit();
        }
        // Le message d'erreur est déjà défini dans registerUser()
    }
    header('Location: register.php'); // Redirige pour afficher le message
    exit();
}

$pageTitle = "Inscription";
include './includes/templates/header.php';
?>

<div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">
    <h1 class="text-3xl font-bold text-gray-900 mb-6 text-center">Inscription</h1>
    <?php if (!empty($_SESSION['message'])): ?>
        <div class="mb-4 text-red-600 text-center font-semibold">
            <?php echo htmlspecialchars($_SESSION['message']); ?>
            <?php unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>

    <form action="register.php" method="POST">
        <div class="mb-4">
            <label for="username" class="block text-sm font-medium text-gray-700">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email :</label>
            <input type="email" id="email" name="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe :</label>
            <input type="password" id="password" name="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>
        <div class="mb-6">
            <label for="confirm_password" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe :</label>
            <input type="password" id="confirm_password" name="confirm_password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>
        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out w-full">S'inscrire</button>
    </form>
    <p class="mt-6 text-center text-gray-600">
        Déjà un compte ? <a href="login.php" class="text-indigo-600 hover:underline">Connectez-vous ici</a>.
    </p>
</div>

<?php include './includes/templates/footer.php'; ?>
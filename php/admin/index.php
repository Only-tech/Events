<?php
require_once 'admin_guard.php';

require_once '../includes/db_connect.php';
require_once '../includes/auth_functions.php';
// require_once '../includes/user_functions.php';
require_once '../includes/event_functions.php';



$pageTitle = "Tableau de bord Admin";
include './templates/header.php';

// Les nombres totales d'événements, d'utilisateurs et d'inscriptions
$totalEvents = count(getAllEventsWithRegistrationCount());
$totalUsers = countUsers();
$totalRegistrations = countRegistrations();
function countUsers()
{
    global $pdo;
    $stmt = $pdo->query("SELECT COUNT(*) FROM users");
    return (int) $stmt->fetchColumn();
}
?>


<h1 class="text-4xl font-extrabold text-gray-900 mb-8 text-center">Tableau de bord Administrateur</h1>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">Total Événements</h2>
        <p class="text-5xl font-bold text-indigo-600"><?php echo htmlspecialchars($totalEvents); ?></p>
    </div>
    <!-- Cartes de statistiques -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">Utilisateurs Enregistrés</h2>
        <p class="text-5xl font-bold text-gray-600"><?php echo htmlspecialchars($totalUsers); ?></p>
    </div>
    <div class="bg-white rounded-lg shadow-lg overflow-hidden p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">Inscriptions Totales</h2>
        <p class="text-5xl font-bold text-gray-600"><?php echo htmlspecialchars($totalRegistrations); ?></p>
    </div>
</div>

<div class="bg-white rounded-lg shadow-lg p-6">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">Actions Administrateur</h2>
    <ul class="space-y-4">
        <li>
            <a href=" manage_events.php" class="font-semibold text-lg text-indigo-700 hover:text-indigo-900 border-2 rounded-[9999px] px-4 p-2 shadow-lg transition duration-300 ease-in-out w-full block text-center">
                Gérer les Événements (Créer, Modifier, Supprimer)
            </a>
        </li>
        <li>
            <a href="manage_registrations.php" class="font-semibold text-lg text-indigo-700 hover:text-indigo-900 border-2 rounded-[9999px] px-4 p-2 shadow-lg transition duration-300 ease-in-out w-full block text-center">
                Gérer les Inscriptions (Voir les participants)
            </a>
        </li>
    </ul>
</div>

<?php include './templates/footer.php'; ?>
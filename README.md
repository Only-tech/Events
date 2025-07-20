# Application Web de Gestion d'Événements Eventribe

**Eventribe** permet de gérer des événements avec un front-office (s'inscrire et se désinscrire d'un événement) pour les visiteurs et un back-office (ajouter, modifier, supprimer un événement, désinscrire des participants d'un événement, consulter les statistiques de participations) pour l'administration.

---

## Technologies Utilisées

- HTML5, Tailwind CSS, js, PHP (Frontend, Backend)

- PostgreSQL (Base de données)

- json (Serveur)

- Docker

#### Les plus

- Authentification: Sessions PHP, mots de passe hashés

- Sécurité: Requêtes SQL préparées (PDO)

---

## Structure du Projet

```
/Events
├── docker-compose.yml
├── Dockerfile
├── severs.json
├── data.sql # Schéma de la base de données
├── php/ # Tous les fichiers
│ ├── index.php # Page d'accueil (liste des événements)
│ ├── event_detail.php # Page de détail d'un événement
│ ├── register.php # Formulaire d'inscription
│ ├── login.php # Formulaire de connexion
│ ├── logout.php # Déconnexion
│ ├── register_event.php # Inscription à un événement
│ ├── unregister_event.php # Désinscription d'un événement
│ └── admin/ # Interface d'administration (back-office)
| │ ├── index.php # Dashboard admin
│ | ├── manage_events.php # Gestion CRUD des événements
│ | ├── manage_users.php # Gestion des utilisateurs
│ | ├── manage_registrations.php # Gestion des inscriptions
│ | └── templates/ # Templates spécifiques à l'admin
│ | |  ├── header.php
│ | |  └── footer.php
| ├── includes/ # Fichiers PHP inclus
│ | ├── db_connect.php # Connexion à la base de données
│ | ├── auth_functions.php # Fonctions d'authentification et de gestion des utilisateurs
│ | ├── event_functions.php # Fonctions de gestion des événements
│ | ├── user_functions.php # Fonctions de gestion des utilisateurs
│ | └── templates/ # Templates généraux
│ | |   ├── header.php
│ | |   └── footer.php
```

---

## Installation et Lancement

##### Prérequis:

- Docker Desktop installé.

- Un éditeur de code VS Code

- Cloner le dépôt:

git clone <https://github.com/Only-tech/Events.git>

##### Entrer cette commande dans le Terminal à chaque démarrage de l'éditeur du code :

npx @tailwindcss/cli -i ./php/assets/css/src/input.css -o ./php/assets/css/src/output.css --watch

#### Configuration Docker :

Un fichier docker-compose.yml incluant:

db: Un conteneur PostgreSQL.

php: Un conteneur PHP-FPM.

json: Un conteneur json pour servir l'application web.

Vous devriez configurer les volumes pour mapper le code de votre machine hôte vers les conteneurs.

#### Variables d'environnement :

Créez un fichier server.json à la racine du projet avec les informations de connexion à la base de données :

DB_HOST=db
DB_NAME=event_db
DB_USER=user
DB_PASSWORD=password

#### Initialisation de la base de données:

Exécutez le script data.sql dans votre conteneur PostgreSQL pour créer les tables.

**Placez data.sql dans /docker-entrypoint-initdb.d/ pour qu'il s'exécute automatiquement au démarrage du conteneur DB**

#### Lancement des conteneurs:

docker-compose up --build -d

Accès à l'application web:

Front-office: http://localhost:8102

Back-office: http://localhost:8102/admin/index.php ou depuis http://localhost:8102 connecté en admin

---

## Structure de la Base de Données

Le schéma de la base de données est défini dans data.sql. Il se compose de trois tables principales : users, events et registrations.

##### users: Stocke les informations des utilisateurs.

- id: Clé primaire, identifiant unique de l'utilisateur.

- username: Nom d'utilisateur unique.

- email: Adresse email unique.

- password_hash: Mot de passe hashé (sécurisé).

- is_admin: Booléen pour les rôles (bonus).

- created_at: Horodatage de création.

##### events: Stocke les détails des événements.

- id: Clé primaire, identifiant unique de l'événement.

- title: Titre de l'événement.

- description_short: Courte description.

- description_long: Description complète.

- event_date: Date et heure de l'événement.

- location: Lieu de l'événement.

- available_seats: Nombre de places disponibles.

- image_url: URL de l'image de l'événement (bonus).

- created_at: Horodatage de création.

##### registrations: Gère les inscriptions des utilisateurs aux événements.

- id: Clé primaire, identifiant unique de l'inscription.

- user_id: Clé étrangère vers users.id.

- event_id: Clé étrangère vers events.id.

- registered_at: Horodatage de l'inscription.

---

#### Informations sur les Accès

Pour les tests, vous pouvez créer un compte administrateur directement dans la base de données après avoir exécuté le schéma.
Exemple (après avoir hashé un mot de passe avec password_hash en PHP) :

INSERT INTO users (username, email, password_hash, is_admin)
VALUES ('admin', 'admin@example.com', '$2y$10$...votre_hash_de_mot_de_passe...', TRUE);

Remplacez ...votre_hash_de_mot_de_passe... par le hash réel généré par password_hash('votre_mot_de_passe_admin', PASSWORD_DEFAULT).

**Usages des Jointures SQL pour récupérer des données combinées de plusieurs tables.**

#### Lister tous les événements avec le nombre d'inscrits:

Pour afficher la liste des événements sur la page d'accueil ou dans l'interface d'administration, en incluant le nombre d'utilisateurs inscrits à chaque événement, nous utiliserons une LEFT JOIN avec la table registrations et un COUNT.

```
SELECT
e.id,
e.title,
e.event_date,
e.location,
e.description_short,
e.available_seats,
COUNT(r.id) AS registered_count
FROM
events e
LEFT JOIN
registrations r ON e.id = r.event_id
GROUP BY
e.id, e.title, e.event_date, e.location, e.description_short, e.available_seats
ORDER BY
e.event_date ASC;
```

Cette requête permet d'afficher même les événements sans aucune inscription (LEFT JOIN).

##### Afficher la liste des événements où un utilisateur est inscrit:

Pour un utilisateur connecté, afficher les événements auxquels il s'est inscrit.

```
SELECT
e.id,
e.title,
e.event_date,
e.location,
e.description_short
FROM
events e
JOIN
registrations r ON e.id = r.event_id
WHERE
r.user_id = :user_id
ORDER BY
e.event_date ASC;
```

Ici, une JOIN est utilisée pour lier les événements aux inscriptions d'un utilisateur spécifique.

##### Dans l'admin, afficher tous les participants d'un événement:

Pour un événement donné dans l'interface d'administration, lister tous les utilisateurs qui s'y sont inscrits.

```
SELECT
u.id AS user_id,
u.username,
u.email,
r.registered_at
FROM
users u
JOIN
registrations r ON u.id = r.user_id
WHERE
r.event_id = :event_id
ORDER BY
r.registered_at ASC;
```

Cette JOIN combine les informations des utilisateurs avec leurs inscriptions pour un événement spécifique.

---

## Autres Fonctionnalités Implémentées

- Confirmation avant suppression d'un événement

- Gestion des rôles Admin vs utilisateur via la colonne is_admin dans la table users.

- Upload d'une image pour illustrer un événement via la colonne image_url.

- Gestion des messages d'erreurs et de succès : $\_SESSION['message'] pour les messages flash.

## Credit

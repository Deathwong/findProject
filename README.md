# findProject

Application web PHP (style MVC léger) permettant de publier et consulter des annonces, gérer des favoris et échanger des messages entre utilisateurs.

## Prérequis
- PHP 8.0+ avec extensions PDO et pdo_mysql activées
- MySQL/MariaDB
- Git (pour cloner le dépôt)
- Serveur web (WAMP/XAMPP) ou serveur PHP intégré
  - WAMP: https://www.wampserver.com/
  - XAMPP: https://www.apachefriends.org/
- Navigateur moderne

## Installation (Windows / WAMP ou XAMPP)
1. Installer un serveur web local et MySQL:
   - WAMP: https://www.wampserver.com/
   - ou XAMPP: https://www.apachefriends.org/
   Démarrez Apache et MySQL.
2. Cloner le projet dans votre dossier web:
   ```powershell
   cd C:\wamp64\www
   git clone https://github.com/Deathwong/findProject.git findProject
   cd findProject
   ```
   - Alternatif (SSH):
   ```powershell
   git clone git@github.com:Deathwong/findProject.git findProject
   cd findProject
   ```
   - Alternative sans Git: téléchargez le ZIP et extrayez-le dans `C:\wamp64\www\findProject`.
3. Créer la base de données et les tables:
   - Ouvrez votre client MySQL (phpMyAdmin, HeidiSQL, MySQL Shell, etc.).
   - Exécutez, dans l’ordre, les scripts SQL du dossier `conception`:
     - `conception\create_database.sql`
     - `conception\create_tables.sql`
     - (Optionnel) `conception\data.sql` pour des données d’exemple
4. Configurer la connexion BD si nécessaire dans `service\PdoConnectionHandler.php`:
   - DATA_BASE_NAME: `find`
   - HOST: `localhost`
   - PORT: `3306`
   - USER_NAME: `root`
   - PASS_WORD: "" (valeur par défaut sous WAMP)
5. Accéder à l’application dans le navigateur:
   - Via WAMP/XAMPP: http://localhost/findProject/views/index.php
   - Alternative (serveur PHP intégré, sans WAMP/XAMPP):
     ```powershell
     php -S localhost:8000 -t views
     # Ouvrez http://localhost:8000/index.php
     ```




## Structure du projet
- `Controller/` — Contrôleurs (logique de routing et actions)
- `model/` — Modèles métier (entités)
- `service/` — Accès aux données et services (PDO, requêtes)
- `views/` — Vues (pages PHP)
- `assets/` — CSS, JS, images
- `conception/` — Scripts SQL (création BD, tables, données)
- `dto/` — Objets de transfert de données (cartes, projections)
- `utils/` — Fonctions utilitaires

## Pages principales
- `views/index.php` — Accueil / liste d’annonces
- `views/detailsAnnonce.php` — Détail d’une annonce
- `views/createAnnonce.php`, `views/editAnnonce.php`, `views/deleteAnnonce.php` — CRUD annonces
- `views/message.php`, `views/sendMessage.php` — Messagerie
- `views/signin.php`, `views/signup.php`, `views/exitUser.php` — Authentification

## Configuration base de données
Le fichier `service\PdoConnectionHandler.php` centralise la connexion PDO:
- Hôte, port, nom BD, utilisateur et mot de passe se règlent via des constantes.
- Encodage: `utf8mb4`
- Mode erreurs: exceptions
- Mode fetch par défaut: objets (`PDO::FETCH_OBJ`)

Astuce: Si vous changez le nom de la base via `create_database.sql`, ajustez la constante `DATA_BASE_NAME` en conséquence.

## Données d’exemple
Exécutez `conception\data.sql` pour remplir la base avec des exemples d’annonces, catégories et utilisateurs.

## Dépannage
- Erreur PDO: vérifiez les constantes dans `PdoConnectionHandler.php`, que le serveur MySQL est démarré et que la BD/tables existent.
- 404/chemins: assurez-vous d’accéder via `views/index.php` ou de configurer votre serveur pour pointer le document root vers `views/`.
- Droits d’écriture: si vous ajoutez l’upload d’images, vérifiez les permissions du dossier cible.

## Licence
Ce projet est fourni tel quel. Ajoutez ici votre licence si nécessaire.

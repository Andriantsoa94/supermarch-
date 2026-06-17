# 📋 TODO LIST DETAILEE : TD Caisse de Supermarché
**Framework :** CodeIgniter 4 | **Base de données :** SQLite3 | **Promo :** P18 (Juin 2026)

---

## Étape 1 : Base de Données SQLite (30 min)
- [x] Créer le fichier de base de données vide (ex: `caisse.db` dans `writable/` ou à la racine).
- [x] Rédiger et exécuter le script de création des tables (`schema.sql`) :
  - [x] **Table `caisse`** : `id` (INT Autoincrement), `numero` (INT/VARCHAR).
  - [x] **Table `produit`** : `id` (INT Autoincrement), `designation` (VARCHAR), `prix` (NUMERIC), `stock` (INT).
  - [x] **Table `achat`** : `id` (INT Autoincrement), `caisse_id` (INT), `produit_id` (INT), `quantite` (INT), `statut` (VARCHAR, ex: 'en_cours' ou 'cloture').
  - [x] **Table `utilisateur`** : `id` (INT Autoincrement), `username` (VARCHAR), `password` (VARCHAR).
- [x] Insérer les données de test obligatoires :
  - [x] **2 caisses** (ex: Caisse 1, Caisse 2).
  - [x] **5 produits** (ex: Biscuit [1000], Pain [400], Eau [1500], etc.).
  - [x] **1 utilisateur** pour le futur login (ex: admin / admin123).

---

## Étape 2 : Configuration & Architecture (30 min)
- [x] **Fichier `.env` ou `app/Config/Database.php`** :
  - [x] Passer l'environnement en mode `development`.
  - [x] Configurer le driver sur `SQLite3`.
  - [x] Renseigner le chemin absolu ou relatif vers `caisse.db`.
- [x] **Fichier `app/Config/App.php`** :
  - [x] Configurer `$baseURL` (ex: `http://localhost:8080/`).
- [x] **Dossier `app/Views/templates/`** (Découpage du template fourni) :
  - [x] Créer `header.php` (Inclure le CSS, la zone d'affichage dynamique de la caisse active via la session, et la barre de navigation).
  - [x] Créer `footer.php` (Fermeture des balises HTML, scripts JS facultatifs).

---

## Étape 3 : Choix de la Caisse (45 min)
- [x] **Modèle** : Créer `app/Models/CaisseModel.php`.
- [x] **Contrôleur** : Créer `app/Controllers/CaisseController.php`.
  - [x] Méthode `index()` : Charger `CaisseModel`, récupérer toutes les caisses avec `findAll()`, et envoyer les données à la vue de sélection.
- [x] **Vue** : Créer `app/Views/caisse/selection.php`.
  - [x] Intégrer la liste déroulante `<select name="caisse_id">` alimentée dynamiquement par la base de données.
  - [x] Ajouter le bouton **Valider**.
- [x] **Logique de Session (Dans `CaisseController`)** :
  - [x] Créer la méthode `validerCaisse()`.
  - [x] Récupérer le `caisse_id` envoyé en POST via `$this->request->getPost('caisse_id')`.
  - [x] Récupérer les détails de cette caisse et les stocker en session : `session()->set('caisse_active', $caisse);`.
  - [x] Rediriger l'utilisateur vers la page des achats : `return redirect()->to('/achats');`.

---

## Étape 4 : Saisie des Achats (1h45)
- [x] **Modèles** : 
  - [x] Créer `app/Models/ProduitModel.php`.
  - [x] Créer `app/Models/AchatModel.php` (Écrire une méthode personnalisée `getAchatsEnCours($caisse_id)` qui fait un `$this->select(...)->join('produit', ...)->where(...)` pour récupérer la désignation et le prix unitaire).
- [x] **Contrôleur** : Créer `app/Controllers/AchatController.php`.
  - [x] Dans le constructeur ou la méthode : vérifier si `session()->has('caisse_active')`. Si absent -> rediriger immédiatement vers le choix de la caisse (`/caisse`).
  - [x] Méthode `index()` :
    - [x] Récupérer la liste de tous les produits (pour le formulaire du haut).
    - [x] Récupérer les achats en cours associés à la caisse active (pour le tableau du bas).
    - [x] Calculer la somme totale des montants (`prix * quantite`) cumulés.
    - [x] Envoyer toutes ces données à la vue.
- [x] **Vue** : Créer `app/Views/achats/saisie.php`.
  - [x] **Partie Haute : Formulaire d'ajout (60 min)** :
    - [x] Créer le formulaire avec le `<select name="produit_id">` bouclant sur les produits disponibles.
    - [x] Ajouter le champ de saisie numérique `<input type="number" name="quantite" min="1">`.
    - [x] Ajouter le bouton **Valider** pointant vers la route d'ajout.
  - [x] **Partie Basse : Tableau récapitulatif (45 min)** :
    - [x] Créer la structure du tableau HTML (`Produit`, `Prix Unit`, `Qté`, `Montant`).
    - [x] Faire une boucle `foreach` sur les achats en cours récupérés.
    - [x] Afficher la ligne `Total` finale en affichant la variable de somme calculée dans le contrôleur.
- [x] **Logique d'Ajout (Dans `AchatController`)** :
  - [x] Créer la méthode `ajouter()`.
  - [x] Récupérer les données POST (`produit_id`, `quantite`) ainsi que le `caisse_id` stocké en session.
  - [x] Insérer une nouvelle ligne dans la table `achat` avec le statut 'en_cours'.
  - [x] Rediriger vers la page principale des achats : `return redirect()->to('/achats');`.

---

## Étape 5 : Fonctionnalités Avancées (Travaux à faire 4)
- [x] **Authentification (Écran de Login)** :
  - [x] Créer `app/Controllers/AuthController.php` (Méthodes `login()` pour afficher la vue et `authentifier()` pour vérifier les identifiants en base).
  - [x] Créer la vue de connexion `app/Views/auth/login.php`.
  - [x] Mettre à jour la session en cas de succès : `session()->set('isLoggedIn', true);`.
  - [x] Ajouter un filtre ou une condition stricte pour interdire l'accès à l'application si l'utilisateur n'est pas connecté.
- [x] **Bouton "Clôturer Achat"** :
  - [x] Ajouter le bouton `<button>` ou lien de clôture juste en dessous du tableau récapitulatif dans `app/Views/achats/saisie.php`.
  - [x] Créer la méthode `cloturer()` dans `AchatController.php`.
  - [x] Exécuter une requête de mise à jour (`UPDATE`) dans la table `achat` pour passer le statut de 'en_cours' à 'cloture' pour toutes les lignes correspondant à l'ID de la caisse active.
  - [x] Rediriger vers `/achats` (le tableau se rechargera vide, prêt pour le client suivant).

---

## Configuration des Routes (`app/Config/Routes.php`)
Assurer l'enchaînement des écrans en déclarant les routes suivantes :
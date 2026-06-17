# Todo List - Système de Gestion RH (CodeIgniter 4)

Ce document détaille toutes les tâches nécessaires pour mener à bien le projet de système RH interne, en se basant sur les spécifications techniques.

---

## Phase 1 : Initialisation du Projet et Base de Données (20 min)

- [x] **Configuration de l'environnement**
    - [x] Configurer le fichier `.env` pour utiliser la base de données SQLite.
    - [x] S'assurer que le framework CodeIgniter 4 est correctement installé.

- [x] **Migrations de la Base de Données**
    - [x] Créer le fichier de migration pour la table `departements`.
    - [x] Créer le fichier de migration pour la table `types_conge`.
    - [x] Créer le fichier de migration pour la table `employes`.
    - [x] Créer le fichier de migration pour la table `soldes`.
    - [x] Créer le fichier de migration pour la table `conges`.
    - [x] Exécuter la commande `php spark migrate` pour créer les tables.

- [x] **Seeders (Données de test)**
    - [x] Créer un seeder principal `DatabaseSeeder`.
    - [x] Dans le seeder, ajouter :
        - [x] 1 utilisateur `admin`.
        - [x] 2 utilisateurs `employe`.
        - [x] 1 utilisateur `rh`.
        - [x] 2 `départements`.
        - [x] 3 `types_conge` (ex: Payé, Maladie, Spécial).
        - [x] Initialiser les soldes pour chaque employé pour chaque type de congé déductible.
    - [x] Exécuter `php spark db:seed` pour peupler la base de données.

- [x] **Routing Initial**
    - [x] Définir les groupes de routes `/employe`, `/rh`, `/admin`.
    - [x] Créer des contrôleurs squelettes (`EmployeController`, `RhController`, `AdminController`, `AuthController`).

---

## Phase 2 : Authentification et Gestion des Rôles (40 min)

- [x] **Système de Connexion/Déconnexion**
    - [x] Créer la vue du formulaire de connexion (`login.php`).
    - [x] Implémenter la méthode `login()` dans `AuthController` qui vérifie l'email et le mot de passe (`password_verify`).
    - [x] Stocker les informations utilisateur (`id`, `nom`, `role`) dans la session CI4.
    - [x] Implémenter la méthode `logout()` pour détruire la session.
    - [x] Rediriger l'utilisateur vers son tableau de bord respectif après connexion.

- [x] **Filtres et Sécurité**
    - [x] Créer un filtre `AuthFilter` qui vérifie si un utilisateur est connecté.
    - [x] Appliquer le filtre aux groupes de routes `/employe`, `/rh`, `/admin`.
    - [x] Dans chaque méthode de contrôleur, vérifier le rôle de l'utilisateur pour s'assurer qu'il a les droits d'accès.
    - [x] Activer la protection CSRF sur tous les formulaires.

---

## Phase 3 : Espace Employé (60 min)

- [x] **Tableau de bord Employé**
    - [x] Afficher le solde de congés restant par type (`jours_attribues - jours_pris`).
    - [x] Lister les demandes de congé de l'employé avec leur statut (`en_attente`, `approuvée`, `refusée`).

- [x] **Soumission d'une Demande de Congé**
    - [x] Créer le formulaire de demande (sélection du type de congé, date de début, date de fin, motif).
    - [x] Dans le contrôleur :
        - [x] Valider les données du formulaire (dates valides, solde suffisant, pas de chevauchement).
        - [x] Calculer le nombre de jours ouvrables entre les dates.
        - [x] Enregistrer la demande en base avec le statut `en_attente`.
        - [x] Utiliser le pattern PRG (POST/Redirect/GET) avec un message flash de succès/erreur.

- [x] **Annulation d'une Demande**
    - [x] Ajouter un bouton "Annuler" pour les demandes avec le statut `en_attente`.
    - [x] Implémenter la logique pour changer le statut à `annulee` ou supprimer la demande.

- [x] **Profil Utilisateur**
    - [x] Créer une page où l'employé peut modifier son nom et son mot de passe.

---

## Phase 4 : Espace RH (50 min)

- [x] **Tableau de bord RH**
    - [x] Afficher la liste de toutes les demandes de congé avec le statut `en_attente`.
    - [x] Permettre de filtrer les demandes par statut ou département.

- [x] **Traitement des Demandes**
    - [x] Sur la vue d'une demande, afficher les détails complets (employé, dates, motif, solde restant de l'employé).
    - [x] Ajouter des boutons "Approuver" et "Refuser".
    - [x] Implémenter la logique `approve()`:
        - [x] Changer le statut de la demande à `approuvée`.
        - [x] **Mettre à jour la table `soldes` en déduisant les jours (`jours_pris`).**
        - [x] Enregistrer qui a traité la demande (`traite_par`).
    - [x] Implémenter la logique `refuse()`:
        - [x] Changer le statut de la demande à `refusée`.
        - [x] Ajouter un commentaire optionnel expliquant le refus.
        - [x] Le solde de l'employé reste intact.

---

## Phase 5 : Back-Office Administrateur (30 min)

- [x] **Gestion des Employés (CRUD)**
    - [x] Lister tous les employés avec leurs informations (rôle, département).
    - [x] Créer un formulaire pour ajouter un nouvel employé.
    - [x] Créer un formulaire pour modifier un employé existant (changer son rôle, département, etc.).
    - [x] Implémenter une fonctionnalité pour "désactiver" un employé (`actif = 0`).

- [x] **Gestion des Entités**
    - [x] CRUD complet pour les `départements`.
    - [x] CRUD complet pour les `types_conge`.

- [x] **Tableau de Bord Admin**
    - [x] Afficher un résumé des absences du mois en cours.
    - [x] Permettre d'ajuster manuellement le solde de congés d'un employé.

---

## Phase 6 : Finalisation et Finitions (20 min)

- [x] **Interface et Expérience Utilisateur**
    - [x] Créer un layout de base (`app.php`) avec une barre de navigation/sidebar.
    - [x] La sidebar doit afficher des liens différents en fonction du rôle de l'utilisateur.
    - [x] S'assurer que les messages flash (succès, erreur) sont affichés correctement.
    - [x] Soigner la présentation des vues.

- [x] **Documentation**
    - [x] Mettre à jour le fichier `README.md`.
    - [x] Inclure les instructions d'installation (`composer install`, `php spark migrate`, `php spark db:seed`).
    - [x] Fournir les identifiants pour le compte `admin` et un compte `employe` de test.

- [x] **Vérification Finale**
    - [x] Tester le workflow complet d'une demande de congé.
    - [x] Vérifier que les soldes sont correctement mis à jour.
    - [x] S'assurer que les restrictions de rôle sont bien appliquées partout.

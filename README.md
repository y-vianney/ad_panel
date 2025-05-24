# Système de Gestion de Panneaux Publicitaires
Application de gestion de panneaux publicitaires développée avec PHP Vanilla, permettant la gestion complète des réservations d'espaces publicitaires.

## 🎯 Fonctionnalités principales
### Gestion des panneaux
- Création et modification de panneaux publicitaires
- Gestion des emplacements et caractéristiques
- Suivi de l'état des panneaux (disponible, réservé)

### Système de réservation
- Réservation de panneaux avec dates spécifiques
- Calcul automatique des tarifs basé sur :
  - Dimensions du panneau (longueur × largeur)
  - Type de panneau (multiplicateur spécifique)
  - Durée de réservation
  - Prix de base du panneau

### Gestion des utilisateurs
- Système d'authentification complet
- Profils clients avec informations personnalisées
- Historique des réservations
- Modification des informations personnelles

## 🛠 Technologies utilisées
- PHP 8.x
- MySQL
- HTML5/CSS3
- Architecture MVC

## 💻 Installation
1. Cloner le repository

2. Configurer la base de données
    - Importer le fichier SQL `database/bd_panel.sql`
    - Configurer les accès dans `app/config/database.php`

## 📁 Structure du projet
`
<pre>
projet/
├── app/ # Logique applicative
│ ├── controllers/ # Contrôleurs
│ ├── models/ # Modèles de données
│ ├── middleware/ # Middlewares (auth, roles)
│ └── database/ # Configuration BDD
├── public/ # Assets publics
│ ├── css/ # Styles
│ ├── js/ # Scripts
│ ├── images/ # Images
│ └── fonts/ # Polices
└── views/ # Templates
  ├── client/ # Vues client
  ├── panneau/ # Vues panneaux
  └── reservation/ # Vues réservations
</pre>
`

## 🚀 Roadmap
### En cours de développement
[-] Système de filtrage<br>
[+] Interface d'administration complète<br>
[+] Gestion des rôles utilisateurs<br>
[-] Documentation complète

### Prochaines fonctionnalités
[-] Système de notifications<br>
[-] Tableau de bord analytics<br>
[-] Export de rapports<br>
[-] Interface multilingue

# Projet de gestion de panneaux publicitaires
Application de gestion de panneaux publicitaires, développée avec `PHP Vanilla`.
</br>
</br>
<b>Fonctionnalités</b> :
- Réserver un panneau
- Gérer ses réservations
- Modifier une réservation
- Annuler une réservation
- Modifier son profil

## Dernières modifications
- <u>Gestion des réservations</u>:
  - Demande d'annulation: Changer le statut de la réclamation quand une demande d'annulation est faite
  - Modification des informations d'une réservation: Changer le panneau et les dates de réservation (Date debut, date fin), et en conséquence, le montant de la réservation
  - Implémentation de la fonction de calcul du montant de la réservation; basé sur la durée, le prix du panneau, l'aire du panneau (longueur x largeur) et un poids déterminé en fonction du type de panneau
  - Modification de l'interface de modification de panneau

- <u>Gestion du profil utilisateur</u>:
  - Modification des informations utilisateur: Ajout du formulaire de modification des informations de l'utilisateur connecté (Nom, prénoms, adresse) - Contact, email et mot de passe, pas encore pris en compte

- <u>Global</u>:
  - Ajout du thread répétitif de mis à jour des statuts - Un <b>thread</b> est une action qui s'exécute indépendamment du reste de l'application


## Tâches restantes
- <b>Ajout des filtres</b>
- <b>Gestion de l'administration</b>:
  - Gestion des rôles utilisateurs
  - Ajout des pages d'administration: Créer un panneau, gérer les utilisateurs, gérer les réservations (les demandes d'annulation, à ne pas oublier)
  - Implémentation du middleware de gestion de rôle
- <b>Ajout des commentaires</b>
- <b>Création d'une documentation</b>


# Arborescence

. <br>
├── app <br>
│  ├── controller <br>
│  ├── database <br>
│  ├── middleware <br>
│  └── models <br>
├── public <br>
│  ├── css <br>
│  ├── fonts <br>
│  ├── images <br>
│  ├── js <br>
│  └── svg <br>
└── views <br>
   ├── client <br>
   ├── panneau <br>
   └── reservation <br>

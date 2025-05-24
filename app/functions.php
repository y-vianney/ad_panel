<?php
// Inclusion du fichier de constantes
require_once "models/constants.php";

/**
 * Valide les données du formulaire client
 * Vérifie la présence de tous les champs requis
 * 
 * @param array $method Tableau contenant les données du formulaire ($_POST ou $_GET)
 * @return bool Retourne true si tous les champs requis sont présents
 */
function validateClient($method): bool
{
    return (
        isset($method['nom']) &&
        isset($method['prenom']) &&
        isset($method['adresse']) &&
        isset($method['contact'])
    );
}

/**
 * Valide les données du formulaire de réservation
 * Vérifie la présence des champs obligatoires pour une réservation
 * 
 * @param array $method Tableau contenant les données du formulaire
 * @return bool Retourne true si tous les champs requis sont présents
 */
function validateReservation($method): bool
{
    return (
        isset($method['date_deb']) &&
        isset($method['date_fin']) &&
        isset($method['panneau']) &&
        isset($method['mode'])
    );
}

/**
 * Valide les données du formulaire de panneau publicitaire
 * Vérifie la présence de tous les champs nécessaires
 * 
 * @param array $method Tableau contenant les données du formulaire
 * @return bool Retourne true si tous les champs requis sont présents
 */
function validatePanneau($method): bool
{
    return (
        isset($method['emplacement']) &&
        isset($method['longueur']) &&
        isset($method['largeur']) &&
        isset($method['prix']) &&
        isset($method['type']) &&
        isset($method['etat']) &&
        isset($method['description'])
    );
}

/**
 * Calcule le montant d'une réservation de panneau publicitaire
 * Le calcul prend en compte les dimensions du panneau, son type et la durée
 *
 * @param string $type Type de panneau (influençant le multiplicateur)
 * @param float $height Hauteur du panneau en mètres
 * @param float $width Largeur du panneau en mètres
 * @param int $panelPrice Prix de base du panneau
 * @param int $duration Durée de la réservation en jours
 * @return int Montant total de la réservation arrondi
 */
function montantReservation(string $type, float $height, float $width, int $panelPrice, int $duration): int 
{
    // Calcul de la surface du panneau
    $area = $height * $width;
    
    // Récupération du multiplicateur selon le type
    $multiplier = getMultiplier($type);
    
    // Calcul du prix total (surface * multiplicateur * durée * prix_base / 10)
    $price = ($area * $multiplier * $duration * $panelPrice) / 10;

    return round($price);
}

/**
 * Récupère le multiplicateur de prix associé à un type de panneau
 * Utilise la constante globale $types_p pour les références
 *
 * @param string $currPanelType Type de panneau dont on cherche le multiplicateur
 * @return float Multiplicateur associé au type (1.0 par défaut)
 */
function getMultiplier(string $currPanelType): float 
{
    global $types_p;

    // Recherche du type dans la liste des types définis
    $typeFound = array_filter($types_p, function ($type) use ($currPanelType) {
        return $type['value'] === $currPanelType;
    });
    
    // Récupération du premier (et normalement unique) résultat
    $typeFound = array_values($typeFound)[0];

    // Retourne le multiplicateur si trouvé, sinon 1.0 par défaut
    return count($typeFound) > 0 ? $typeFound['multiplier'] : 1.0;
}
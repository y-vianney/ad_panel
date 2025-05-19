<?php
require_once "models/constants.php";

function validateClient($method): bool
{  // Function used to validate the form data based on the client fields
    return (
        isset($method['nom']) &&
        isset($method['prenom']) &&
        isset($method['adresse']) &&
        isset($method['contact'])
    );
}

function validateReservation($method): bool
{  // Function used to validate the form data based on the client fields
    return (
        isset($method['date_deb']) &&
        isset($method['date_fin']) &&
        isset($method['panneau']) &&
        isset($method['mode'])
    );
}

function validatePanneau($method): bool
{  // Function used to validate the form data based on the client fields
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
 * Calculate the price for a reservation
 *
 * @param string $type
 * @param float $height
 * @param float $width
 * @param int $panelPrice
 * @param int $duration
 *
 * @return integer
 */
function montantReservation(string $type, float $height, float $width, int $panelPrice, int $duration): int {
    $area = $height * $width;
    $multiplier = getMultiplier($type);
    $price = ($area * $multiplier * $duration * $panelPrice) / 10;

    return round($price);
}

function getMultiplier(string $currPanelType): float {
    global $types_p;

    $typeFound = array_filter($types_p, function ($type) use ($currPanelType) {
        return $type['value'] === $currPanelType;
    });
    $typeFound = array_values($typeFound)[0];

    return count($typeFound) > 0 ? $typeFound['multiplier'] : 1.0;
}

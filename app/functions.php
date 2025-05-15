<?php

function validateClient($method)
{  // Function used to validate the form data based on the client fields
    return (
        isset($method['nom']) &&
        isset($method['prenom']) &&
        isset($method['adresse']) &&
        isset($method['contact'])
    );
}

function validateReservation($method)
{  // Function used to validate the form data based on the client fields
    return (
        isset($method['date_deb']) &&
        isset($method['date_fin']) &&
        isset($method['panneau']) &&
        isset($method['mode'])
    );
}

function validatePanneau($method)
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
 * Calcul basé sur le type, le taille (longueur et largeur), la durée
 *
 * @return integer
 */
function montantReservation() {
    return 45000;
}

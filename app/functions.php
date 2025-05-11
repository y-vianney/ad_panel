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
        isset($method['montant'])
    );
}

/**
 * Calcul basé sur le type, le taille (longueur et largeur), la durée
 *
 * @return integer
 */
function montantReservation() {

}

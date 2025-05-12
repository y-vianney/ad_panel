<?php

$types_p = [
    [
        "value" => "Panneaux modernes",
        "label" => "Panneaux modernes"
    ],
    [
        "value" => "Panneaux classiques",
        "label" => "Panneaux classiques"
    ],
    [
        "value" => "City led",
        "label" => "City led"
    ],
    [
        "value" => "Big size",
        "label" => "Big size"
    ],
    [
        "value" => "Kilometrique",
        "label" => "Kilometrique"
    ],
];

$emplacements = [
    [
        "value" => "Abidjan, Cocody",
        "label" => "Abidjan, Cocody"
    ],
    [
        "value" => "Abidjan, Yopougon",
        "label" => "Abidjan, Yopougon"
    ],
];

$state_p = [
    [
        "value" => "Disponible",
        "label" => "Disponible"
    ],
    [
        "value" => "Réservé",
        "label" => "Réservé"
    ],
    [
        "value" => "En maintenance",
        "label" => "En maintenance"
    ],
];

$controls_p = [
    "emplacement" => [
        "label" => "Emplacement",
        "type" => "select",
        "options" => $emplacements,
    ],
    "longueur" => [
        "label" => "Longueur",
        "type" => "number",
        "step" => "0.01",
        "min" => "0",
    ],
    "largeur" => [
        "label" => "Largeur",
        "type" => "number",
        "step" => "0.01",
        "min" => "0",
    ],
    "type" => [
        "label" => "Type",
        "type" => "select",
        "options" => $types_p,
    ],
    "etat" => [
        "label" => "Etat",
        "type" => "select",
        "options" => $state_p,
    ],
    "prix" => [
        "label" => "Prix",
        "type" => "number",
    ],
    "description" => [
        "label" => "Desrciption",
        "type" => "text",
    ],
];

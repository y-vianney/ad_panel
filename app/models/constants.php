<?php

$modes = [
    [
        "value" => "Wave",
        "label" => "Wave",
        "alt" => "wave"
    ],
    [
        "value" => "MTN Money",
        "label" => "MTN Money",
        "alt" => "mtn"
    ],
    [
        "value" => "Orange Money",
        "label" => "Orange Money",
        "alt" => "orange"
    ],
];

$types_p = [
    [
        "value" => "Panneaux modernes",
        "label" => "Panneaux modernes",
        "multiplier" => 1.5
    ],
    [
        "value" => "Panneaux classiques",
        "label" => "Panneaux classiques",
        "multiplier" => 1.0
    ],
    [
        "value" => "City led",
        "label" => "City led",
        "multiplier" => 2.0
    ],
    [
        "value" => "Big size",
        "label" => "Big size",
        "multiplier" => 2.5
    ],
    [
        "value" => "Kilometrique",
        "label" => "Kilometrique",
        "multiplier" => 3.0
    ],
];

$emplacements = [
    [
        "value" => "Abidjan - Plateau, Avenue Chardy",
        "label" => "Abidjan - Plateau, Avenue Chardy"
    ],
    [
        "value" => "Yopougon - Sideci, en face de la pharmacie Akadjoba",
        "label" => "Yopougon - Sideci, en face de la pharmacie Akadjoba"
    ],
    [
        "value" => "Cocody - Deux Plateaux, Vallon",
        "label" => "Cocody - Deux Plateaux, Vallon"
    ],
    [
        "value" => "Marcory - Zone 4, rue Paul Langevin",
        "label" => "Marcory - Zone 4, rue Paul Langevin"
    ],
    [
        "value" => "Treichville - Boulevard de Marseille",
        "label" => "Treichville - Boulevard de Marseille"
    ],
    [
        "value" => "Abobo - Rond-point Gagnoa",
        "label" => "Abobo - Rond-point Gagnoa"
    ],
    [
        "value" => "Koumassi - Remblais, proche du marché",
        "label" => "Koumassi - Remblais, proche du marché"
    ],
    [
        "value" => "Bingerville - Entrée ville",
        "label" => "Bingerville - Entrée ville"
    ],
    [
        "value" => "Port-Bouët - Route aéroportuaire",
        "label" => "Port-Bouët - Route aéroportuaire"
    ],
    [
        "value" => "Adjamé - Gare routière",
        "label" => "Adjamé - Gare routière"
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

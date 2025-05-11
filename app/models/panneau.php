<?php

/**
 * "ville" => [
 * "label" => "Ville",
 * "type" => "select",
 * "options" => [
 * [
 * "value" => "abidjan",
 * "label" => "Abidjan"
 * ],
 * [
 * "value" => "yamoussoukro",
 * "label" => "Yamoussoukro"
 * ],
 * [
 * "value" => "bouake",
 * "label" => "Bouaké"
 * ],
 * [
 * "value" => "soubre",
 * "label" => "Soubré"
 * ],
 * ],
 * ],
 * "quartier" => [
 * "label" => "Quartier",
 * "type" => "select",
 * "options" => [
 * [
 * "ville" => "abidjan",
 * "value" => "cocody",
 * "label" => "Cocody"
 * ],
 * [
 * "ville" => "abidjan",
 * "value" => "yopougon",
 * "label" => "Yopougon"
 * ],
 * ],
 * ],
 */

$panneauControls = [
    "emplacement" => [
        "label" => "Emplacement",
        "type" => "select",
        "options" => [
            [
                "value" => "abidjan_cocody",
                "label" => "Abidjan, Cocody"
            ],
            [
                "value" => "abidjan_yop",
                "label" => "Abidjan, Yopougon"
            ],
        ]
    ],
    "longueur" => [
        "label" => "Longueur",
        "type" => "number",
    ],
    "largeur" => [
        "label" => "Largeur",
        "type" => "number",
    ],
    "type" => [
        "label" => "Type",
        "type" => "select",
        "options" => [
            [
                "value" => "modern",
                "label" => "Panneaux modernes"
            ],
            [
                "value" => "classique",
                "label" => "Panneaux classiques"
            ],
            [
                "value" => "city_led",
                "label" => "City led"
            ],
            [
                "value" => "big_size",
                "label" => "Big size"
            ],
            [
                "value" => "kilometrique",
                "label" => "Kilometrique"
            ],
        ]
    ],
    "etat" => [
        "label" => "Etat",
        "type" => "select",
        "options" => [
            [
                "value" => "disponible",
                "label" => "Disponible"
            ],
            [
                "value" => "reserve",
                "label" => "Réservé"
            ],
            [
                "value" => "maintenance",
                "label" => "En maintenance"
            ],
        ]
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

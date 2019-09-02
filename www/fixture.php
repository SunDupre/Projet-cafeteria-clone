<?php
/**
 * Insert test dataset for development process.
 */
require_once 'includes/connection.php';

$connection = new Connection();

// Create an admin user
$connection->insertUser(
    'cuistot@realise.ch', password_hash('cuistot', PASSWORD_DEFAULT),
    true, true, 'somekey', 'Cuistot', 'Le'
);

const SQL_DATE_FORMAT = 'Y-m-d';

$monday = date(SQL_DATE_FORMAT, strtotime('monday this week'));
$tuesday = date(SQL_DATE_FORMAT, strtotime('tuesday this week'));
$wednesday = date(SQL_DATE_FORMAT, strtotime('wednesday this week'));
$thursday = date(SQL_DATE_FORMAT, strtotime('thursday this week'));
$friday = date(SQL_DATE_FORMAT, strtotime('friday this week'));

// Insert plats du jour
$connection->insertDish(
    'Brochet de bœufs à la plancha',
    '',
    10.50,
    $monday,
    $monday,
    NULL,
    PLAT_DU_JOUR_TYPE
);
$connection->insertDish(
    'Céviché de Saumon',
    '',
    10.50,
    $tuesday,
    $tuesday,
    NULL,
    PLAT_DU_JOUR_TYPE
);
$connection->insertDish(
    'The Real César',
    '',
    10.50,
    $wednesday,
    $wednesday,
    NULL,
    PLAT_DU_JOUR_TYPE
);
$connection->insertDish(
    'Tartare de Bœuf',
    '',
    10.50,
    $thursday,
    $thursday,
    NULL,
    PLAT_DU_JOUR_TYPE
);
$connection->insertDish(
    'Taboulé de Quinoa et son Agneau',
    '',
    10.50,
    $friday,
    $friday,
    NULL,
    PLAT_DU_JOUR_TYPE
);


// Insert vegetarian dish
$connection->insertDish(
    'Curry végétarien',
    'Curry de chou fleur rôti et pois chiches',
    11.50,
    $monday,
    $friday,
    NULL,
    PLAT_VEGETARIEN_TYPE
);

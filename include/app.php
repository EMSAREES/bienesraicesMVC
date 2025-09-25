<?php

require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

// Cargar .env
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/');
$dotenv->load();

//Conectarnos ala base de datos
$db = conectarDB();

use Model\ActiveRecord;
ActiveRecord::setDB($db);



// define('TEMPLATES_URL', __DIR__ . '/templates');
// define('FUCTION_URL', __DIR__ . 'funciones.php');

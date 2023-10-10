<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');

$dotenv->load();

$capsule = new Capsule;
$capsule->addConnection(require_once __DIR__ . '/../config/database.php');
$capsule->setAsGlobal();
$capsule->bootEloquent();
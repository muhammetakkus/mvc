<?php

/* Model'e [Entity] namespace eklendiği zaman çalışmıyor? */
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

/* Modeli inclıde edince çalışıyor */
include "App/Model/Message.php";

$dbParams = array(
    'driver' => 'pdo_mysql',
    'user' => 'root',
    'password' => '',
    'dbname' => 'test_slim_pdo'
);

$config = Setup::createAnnotationMetadataConfiguration(array(APP."Model"), true);
$entityManager = EntityManager::create($dbParams, $config);

//Get All
$messages = $entityManager->getRepository('Message')->findAll();
var_dump($messages);
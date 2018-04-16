<?php

/** twitter.com/muhammetakkusON **/
/** github.com/muhammetakkus **/

/* ALL ERROR */
error_reporting(E_ALL);
ini_set('display_errors', 1);

/**/
session_start();
ob_start();

/* TIMEZONE */
date_default_timezone_set('Europe/Istanbul');

/**/
header('Conten-Type: text/html; char-set:utf-8');

/*
$dbconf = [
    'driver' => 'mysql',
    'host' => 'localhost',
    'user' => 'root',
    'password' => '',
    'database' => ''
];
*/

/* ROOT PATH */
define ('PATH', realpath('.') . DIRECTORY_SEPARATOR);
define ('APP', PATH . 'app' . DIRECTORY_SEPARATOR);
define ('VIEW', APP . 'View' . DIRECTORY_SEPARATOR);
/* uri */
define('URL', (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/');
/* Current PATH */
// define('DIR', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR);

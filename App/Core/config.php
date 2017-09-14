<?php

/** twitter.com/muhammetakkusON **/
/** github.com/muhammetakkus **/

/* ALL ERROR */
error_reporting(E_ALL);
ini_set("display_errors", 1);

/**/
session_start();
ob_start();

/* TIMEZONE */
date_default_timezone_set('Europe/Istanbul');

/**/
header("Conten-Type: text/html; char-set:utf-8");

/* DB CONFIG - bu bilgileri PDO.php sayfasındaki db sınıfında kullan */
$dbconf = [
    'driver' => 'mysql',
    'host' => 'localhost',
    'user' => 'root',
    'password' => '',
    'database' => ''
];

/* must be defined - the folder name where files are stored */
$root_directory = "mvc";

/* ROOT */
define ('PATH', realpath(".") . DIRECTORY_SEPARATOR);

/* Current PATH */
define('DIR', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR);

/* FOLDER PATH */
define('URL', (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . "/" . $root_directory . "/");

/* DEFINES */
define ('APP', PATH . "App/");
define ('MODEL', PATH . "App/Model/");
define ('VIEW', PATH . "App/View/");
define ('ASSET', URL . "Asset/");

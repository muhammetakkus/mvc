<?php

/*bunun config dosyası için ayrı array oluştur config kısmında - alınan dbname host- vs yi destekleyen her db de uygula*/

$dsn = 'mysql:host=localhost;dbname=test_slim_pdo;charset=utf8';
$usr = 'root';
$pwd = '';

$pdo = new \Slim\PDO\Database($dsn, $usr, $pwd);




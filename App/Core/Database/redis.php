<?php

$redis = new Redis();
//connect satırını yazmayınca redis server kapalı hatası veriyor
$redis->connect('localhost');

$redis->set("name", "username");
echo $redis->get("name");

var_dump($redis->keys("*"));
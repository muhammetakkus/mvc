<?php

use App\Core\Router\Route as Route;

$route = new Route;

$route->route("GET", "/", function (){
    echo "home page";
});

/* başına / koymayınca route bulmuyor --ayarla*/
$route->route("GET", "/api/user", "Home@index");

$route->route("GET", "/content", "Home@content");
$route->route("POST", "/name", "Home@name");



//$route->route("GET", "/a/.*", "Test@index");

$route->route("GET", "/aa/asdasd/{id}", "Test@test");
$route->route("GET", "/test/profile/{username}/{id}/{a}", "Test@index");




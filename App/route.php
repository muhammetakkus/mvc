<?php

use App\Core\Router\Route;

$route = new Route;

/** Routers **/
$route->route("GET", "/", function() {
    echo "home page";
});

/* başına / koymayınca route bulmuyor --ayarla*/
$route->route("GET", "/api/user", "Home@index");

$route->route("GET", "/content", "Home@content");
$route->route("POST", "/name", "Home@name");

$route->route("GET", "/test", "Test@tester");

//$route->route("GET", "/a/.*", "Test@index");

$route->route("GET", "/aa/asdasd/{id}", "Test@test");
$route->route("GET", "/test/profile/{username}/{id}/{a}", "Test@index");




<?php

/* */
use Routy\Route;

Route::get('/', function (){
    echo '<h2>home page</h2>';
});
Route::get('/home', 'Home@Index');
Route::post('/test-post', 'Home@postName');

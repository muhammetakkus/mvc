<?php

/* */
use Routy\Routy;

/* Routes */
Routy::get("/", function (){
    echo "<h2>home page</h2>";
});

Routy::get("/aaa", 'home@aaa');

/* Check URL == Router */
Routy::check();

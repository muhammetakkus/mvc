<?php

use App\Core\Controller;
use App\Model\User;

class Dc extends Controller
{
    public function index()
    {
        $user = new User;
        $user->setName("mehmet akkuş");
    }
}
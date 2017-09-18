<?php

namespace App\Model;

class User
{
    public function getName()
    {
        return "my cache working test user name model";
    }

    public function setName($name)
    {
        return $name;
    }
}

?>
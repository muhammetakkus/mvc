<?php

use App\Core\Controller;

class Test extends Controller
{
    public function index($id = null,$par2 = null)
    {
        if (!empty($id))
        {
            echo $id;
            echo $par2;
        }else {
            echo "id yok";
        }
    }
}
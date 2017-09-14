<?php

use App\Core\Controller;
use App\Model\Teste;
use App\Core\Src\Cache;

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

    public function testx()
    {

    }
}
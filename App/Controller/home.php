<?php

use App\Core\Controller;
use App\Core\Src\Cache;
use App\Model\User;

class Home extends Controller
    {
        public function aaa(){
            echo "xxx";
        }

		public function index()
		{
            $cache = new Cache();

            $data["test"] = $cache->get("testerr",30);

            if(!$data["test"])
			{
                $user = new User;
                $name = $user->getName();

                $cache->set('testerr', $name);
			}

            //cachin yöntemini değiştir
			//if(!$cache->get("x")){
			//set işlemi }
			//get işlemi 
			//yani kontrol yapıldıktan sonra her türlü get yapılacak
			//$cache->exixst("key") şeklinde boolean döndüren sadece key kontrolü yapan fonknun olabilir
			
			$this->view("test", $data);

		  	//echo "Home/index (index.php?url=home/index)";
			
		}

		public function redirect()
		{
        	Helper::to("/");
		}

		public function content()
    	{
			$data["colors"] = ["red","yellow","pink"];
			$data["id"] = ["name" => "muhammet", "last name" => "akkuş"];

			$this->view('content', $data);
    	}

    	public function name()
		{
			$name = $_POST["name"];
			echo "name = " . $name;
		}

	}
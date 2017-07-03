<?php


use App\Core\Controller;
use App\Core\Src\Cache;
use App\Model\Users;

class Home extends Controller
    {

		public function index()
		{
			$cache = new Cache();

            if($cache->get("user-name") == false)
            {
                //User Model
                $user = new Users;
                $name = $user->getName();

                //Modelden aldığımı bilgiyi cache ile yazdırıyoruz
                $cache->set("user-name",$name,"200");
            }

            $data["test"] = $cache->get("user-name");

            if($cache->get("aa") == false)
            {
                $cache->set("aa","xxcx","1");
            }

            $data["aa"] = $cache->get("aa");

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

?>

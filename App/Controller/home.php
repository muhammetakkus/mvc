<?php


use App\Core\Controller;
use App\Core\Src\Cache;
use App\Model\Users;

class Home extends Controller
    {

		public function index()
		{
			$cache = new Cache();

            $data["test"] = $cache->get("user-name");

            if(!$data["test"])
			{
				echo "cache?";
                //User Model
                $user = new Users;
                $name = $user->getName();

                $cache->set("user-name",$name,"200");
                $data["test"] = $cache->get("user-name");
			}

			$cache->set("aa","test cach s s","12");
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

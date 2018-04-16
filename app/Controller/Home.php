<?php use View\Loader;

use Model\User;

class Home extends Loader
{
	public function Index()
	{
		$data['colors'] = ['red', 'yellow', 'pink'];
		$data['id'] = ['name' => 'mehmet', 'last name' => 'akkuş'];
		$this->view('content', $data);
	}

	public function postName()
	{
		$name = $_POST['name'];
		echo 'name = ' . $name;
	}

	public function redirect()
	{
		Helper::to('/');
	}

	public function setUser()
	{
			$user = new User;
			$user->setName("mehmet akkuş");
	}
}

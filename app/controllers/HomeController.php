<?php

class HomeController extends BaseController {

	public function getIndex()
	{
		$this->layout->title = 'Home';
		$this->layout->nest('content', 'home.index');
	}

}
<?php

class Home extends Controller {

	function Home()
	{
		parent::Controller();	
	}
	
	function index()
	{
		//$this->load->view('welcome_message');
		$params['view'] = array('view_path' => '/', 'view_name' => 'test');
        $this->load->view('index', $params);

	}
	
	function help(){
	$this->load->view('welcome_message');
	}
	
	function test($f='11', $l='22'){
	echo "f: $f ; l: $l";
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
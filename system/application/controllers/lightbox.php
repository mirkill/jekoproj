<?php
/**
 * All lightbox from site
 * @author MegBeg
 */
class Lightbox extends Controller {

	function Lightbox()
	{
		parent::Controller();	
	}
	
	function index()
	{
		//$this->load->view('welcome_message');
		$this->load->view('index');
	}
	function register()
	{
	    $this->load->view('lightbox/register');
	}
	function login()
	{
	    $this->load->view('lightbox/login');
	}
}

/* End of file lightbox.php */
<?php

class Profile extends Controller {

	function Profile()
	{
		parent::Controller();
		$this->load->model('profile_model');
		$this->load->model('clan_model');
	}
	
	function index()
	{
		//$this->load->view('welcome_message');
		$this->check_login();

		$params['notification'] = $this->notification_model->get_notification('5');
		$params['clan'] = $this->clan_model->get_clan_info($this->session->userdata('clan_id'));
		$params['join_request'] = $this->clan_model->check_join_request($this->session->userdata('id'));
		$params['clan_list'] = $this->clan_model->get_clan_names();
		$params['view'] = array('view_path' => '/', 'view_name' => 'profile');
        $this->load->view('index', $params);

	}
	
	function clan_create(){
	$name = $this->input->post('clan_name');
	$lvl = $this->input->post('clan_lvl');
	$server = $this->input->post('server');
	
	return $this->clan_model->create_clan($name, $lvl, $server);
	}

        function check_login(){
            if(!$this->session->userdata('username')){
		$params['view'] = array('view_path' => '/', 'view_name' => 'no_acces');
                $this->load->view('index', $params);
		    return;
		}
        }
        function new_character(){
            $this->check_login();
            $params['view'] = array('view_path' => '/', 'view_name' => 'new_character');
            $this->load->view('index', $params);
        }
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
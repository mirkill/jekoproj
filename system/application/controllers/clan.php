<?php

class Clan extends Controller
{
    
    function Clan()
    {
        parent::Controller();
        //		$this->load->model('profile_model');
        $this->load->model('clan_model');
    }
    
    function join_request()
    {
        $clan_id = $this->input->post('clan_id');
        return $this->clan_model->join_request($clan_id);
    }
    
    function cancel_join()
    {
        $id = $this->session->userdata('id');
        $result = $this->clan_model->cancel_join($id);
        if ($result) {
            redirect('/message/success/dejoin', 'refresh');
        
        } else {
            redirect('/message/error/', 'refresh');
        }
    }
    
    /**
     * Clan control page for CL
     * @return unknown_type
     */
    function control()
    {
        if ($this->session->userdata('user_role') != 'clan_master') {
            redirect('/message/error/access_cl', 'refresh');
        } else {
            $params['joiner'] = $this->clan_model->check_join_request($this->session->userdata('clan_id'), 'clan');
            $params['view'] = array('view_path' => '/', 'view_name' => 'clan_control');
            $this->load->view('index', $params);
        }
    }
    /**
     * Accept or dismiss request for clan join
     * 
     * @return void
     */
    function new_member(){
        $user_id = $this->input->post('user_id');
        $action = $this->input->post('join');
        return $this->clan_model->new_member($user_id, $action);
    }
}	
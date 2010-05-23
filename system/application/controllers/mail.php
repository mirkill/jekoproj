<?php

class Mail extends Controller
{
    function Mail()
    {
        parent::Controller();
        $this->load->model('login_model');
        $this->load->model('profile_model');
    }
    
    function confirm($mail_hash = '0')
    {
        //print_r($mail_hash);
       $confirm = $this->login_model->mail_confirm('confirm', $mail_hash);
       if($confirm){
           $this->session->sess_destroy();
       redirect('/message/success/mail', 'refresh');
       }
       else{
       echo 'Sorry. Try again later';
       //redirect('/login/form/', 'refresh');
       }
    }
    
    function validate(){
        if(!$this->session->userdata('username')){
		$params['view'] = array('view_path' => '/', 'view_name' => 'no_acces');
        $this->load->view('index', $params);
		    return;
		}
		$params['mail'] = $this->login_model->mail_confirm('send', $this->session->userdata('email'), $this->session->userdata('id'));
		$params['view'] = array('view_path' => '/', 'view_name' => 'validate');
        $this->load->view('index', $params);
    }
    
function reset_confirm($mail_hash = '0')
    {
       $confirm = $this->profile_model->reset_password('confirm', $mail_hash);
       if($confirm){
          return true;
       }
       else{
       echo 'Sorry. Try again later';
       }
    }

}
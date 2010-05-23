<?php

class Message extends Controller
{
    function Message()
    {
        parent::Controller();
        //$this->load->model('login_model');
    //$this->load->model('profile_model');
    }
    
    /**
     * Show all success message's page 
     * @param $case for text
     * @return void
     * @author MirkiLL
     */
    function success($case)
    {
        switch ($case) {
            case 'reset':
                $text = 'Your password was changed. Check you e-mail.';
                break;
            case 'mail':
                $text = 'Your mail was confirmed succes. Please login again';
                break;
            case 'dejoin':
                $text = "Your request for join was cancel";
                break;
            default:
                $text = 'Yehooooo! =)';
        
        }
        $params['text'] = $text;
        $params['view'] = array('view_path' => '/', 'view_name' => 'success');
        $this->load->view('index', $params);
    }
    
    /**
     * Show all success message's page 
     * @param $case for text
     * @return void
     * @author MirkiLL
     */
    function error($case)
    {
        switch ($case) {
            case 'reset':
                $text = 'Your password was changed. Check you e-mail.';
                break;
            case 'mail':
                $text = 'Your mail was confirmed succes. Please login again';
                break;
            case 'access_cl':
                $text = "Sorry, this page only for Clan Leaders!";
                break;
            default:
                $text = 'Sorry, try later';
        
        }
        $params['text'] = $text;
        $params['view'] = array('view_path' => '/', 'view_name' => 'error');
        $this->load->view('index', $params);
    }

}    
<?php

class Usercontrol extends Controller
{
    function Usercontrol()
    {
        parent::Controller();
        $this->load->model('login_model');
        $this->load->model('mail_model');
        $this->load->model('profile_model');
        //$this->load->library('JSON');
    }
    
    function register($action)
    {
        $account_exists = $this->account_exists();
        
        switch ($action) {
            case 'check':
                if ($account_exists) {
                    echo "{result:true}";
                } else {
                    echo "{result:false}";
                }
                break;
            
            case 'register':
                if (! $account_exists) {
                    parse_str($this->input->post('values'), $register_values);
                    
                    foreach ($register_values as $key => $value) {
                        if (empty($value)) {
                            
                            echo "{result:false}";
                            exit();
                        }
                    }
                    
                    if ($register_values['pwd'] == $register_values['pwd2']) {
                        $new_user['email'] = $register_values['email'];
                        $new_user['username'] = $register_values['login'];
                        $new_user['password'] = md5($register_values['pwd']);
                        
                        $user_id = $this->login_model->add_user($new_user);
                        
                        if (! $this->login_model->mail_confirm('send', $new_user['email'], $user_id)) {
                            echo 'send mail confirm error';
                        }
                        $login = $register_values['login'];
                        $pwd = $register_values['pwd'];
                        $msg = "Thenks for register in our site <br />
                        login: $login
                        password: $pwd  <br />";
                        $this->mail_model->send_mail($new_user['email'], 'Welcome', $msg);
                        $this->mail_model->new_user_to_admin($new_user['username']);
                        $this->notification_model->add_notification($user_id, 'Welcome', 'Your was register in our site');
                        
                        $user = $this->login_model->login($login, $new_user['password']);
                        
                        // if exist - set session data
                        if ($user) {
                            // convert ot array so we can save to session 
                            $user = (array) $user;
                            unset($user['password']);
                            //$user['online'] = 1;
                            $this->session->set_userdata($user);
                        } else {
                            echo 'cant set session data';
                        }
                        echo "{result:true}";
                        return true;
                    }
                    
                    // register success
                    echo "{result:true}";
                } else {
                    // failed
                    echo "{result:false}";
                }
                break;
            default:
                echo "{result:false}";
                break;
        }
    }
    
    function account_exists($action = 'all')
    {
        parse_str($this->input->post('values'), $login_values);
        
        $email = $login_values['email'];
        $login = $login_values['login'];
        
        switch ($action) {
            case 'all':
                $email_exist = $this->login_model->user_email_exists($email);
                $login_exist = $this->login_model->user_login_exists($login);
                if ($email_exist || $login_exist) {
                    return true;
                } else {
                    return false;
                }
                break;
            case 'email':
                $email_exist = $this->login_model->user_email_exists($email);
                if ($email_exist) {
                    echo "{result:true}";
                    return true;
                } else {
                    echo "{result:false}";
                    return false;
                }
                break;
            case 'login':
                $login_exist = $this->login_model->user_login_exists($login);
                if ($login_exist) {
                    echo "{result:true}";
                    return true;
                } else {
                    echo "{result:false}";
                    return false;
                }
                
                break;
        }
    
    }
    
    /**
     * Login method (call from ajax request)
     * 
     * @return json
     * @author MegBeg
     */
    function login()
    {
        // get  login/pw data
        $login = $this->input->post('login');
        $password = $this->input->post('password');
        
        // md5 pass
        $password = md5($password);
        
        // get user by hash
        $user = $this->login_model->login($login, $password);
        
        // if exist - set session data
        if ($user) {
            
            // convert ot array so we can save to session 
            $user = (array) $user;
            
            unset($user['password']);
            
            $user['online'] = 1;
            
            $this->session->set_userdata($user);
            //$session_id = $this->session->userdata('user_role');
            return $this->echo_json(array('result' => 'true'));
        } else {
            return $this->echo_json(array('result' => 'false'));
        }
    }
    /**
     * Echo json encoded data 
     * 
     * @param $result - any data
     * @return json
     */
    public function echo_json($result)
    {
        if (! function_exists('json_encode')) {
            $this->load->library('JSON');
            $json = new CI_JSON();
            echo $json->encode($result);
        } else
            echo json_encode($result);
    }
    /**
     * Makes user logout and redirect him to the home page
     * 
     * return void
     */
    function logout()
    {
        if ($this->session->userdata('email')) {
            $this->session->sess_destroy();
        }
        redirect('', 'refresh');
    
    }
    function update()
    {
        $this->profile_model->update();
    }
    /**
     * Reset password
     * 
     * Check email in our table, if exist create hash and send email
     * @return json 1 or 0
     * @author MirkiLL
     */
    function reset_pwd()
    {
        $email = $this->input->post('email');
        $user_id = $this->login_model->user_email_exists($email);
        if (! $user_id) {
            return $this->echo_json(array('result' => 'false'));
        } else {
            if ($this->profile_model->reset_password('send', $email, $user_id)) {
                return $this->echo_json(array('result' => 'true'));
            }
        }
    }
    
    function change_pwd()
    {
        $pw1 = $this->input->post('pw1');
        $pw2 = $this->input->post('pw2');
        if ($this->profile_model->update_pwd($pw1, $pw2)) {
            return $this->echo_json(array('result' => 'true'));
        }
        else return false;
    }
}
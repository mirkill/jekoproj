<?php

/**
 * Login model Class
 * 
 * login and register functions
 *
 *@author ES
 */
class Login_model extends Model
{
    function Login_model()
    {
        parent::Model();
        $this->user_table = 'users';
        $this->mail_confirm_table = 'mail_confirm';
        
        $this->load->model('mail_model');
    }
    
    /**
     * Add new user to site
     * 
     * @param $data login, password etc.
     * 
     * @return int user id
     */
    function add_user($data)
    {
        $this->db->insert($this->user_table, $data);
        return $this->db->insert_id();
    }
    
    /**
     * Check email for register
     * 
     * @param $email
     * @return true if exist
     */
    function user_email_exists($email)
    {
        $this->db->select('id');
        $this->db->where('email', $email);
        $result = $this->db->get($this->user_table)->result_array();
        if ($result) {
            return $result[0]['id'];
        } else {
            return false;
        }
    }
    
    /**
     * Check login for register
     * 
     * @param $login
     * @return true if exist
     */
    function user_login_exists($login)
    {
        $this->db->select('id');
        $this->db->where('username', $login);
        $result = $this->db->get($this->user_table)->result_array();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Create and check email for confirm user email
     * @param $action
     * @param $user_id
     * @param $user_email
     * @return unknown_type
     */
    function mail_confirm($action, $user_email, $user_id = '0')
    {
        switch ($action) {
            case 'send':
                $day = date('d');
                $hash = $user_email . $day;
                $hash = md5($hash);
                $this->db->where('user_id', $user_id);
                $this->db->delete($this->mail_confirm_table); 
                
                $data = array('user_id' => $user_id, 'mail_hash' => $hash, 'day' => $day);
                $url = base_url();
                $subj = 'Mail Confirm';
                $msg = "Your was register in site $url<br />
                For confirm email use link: $url"."mail/confirm/$hash
                ";
                if (! $this->mail_model->send_mail($user_email, $subj, $msg)) {
                    return false;
                } elseif ($this->db->insert($this->mail_confirm_table, $data)) {
                    return true;
                } else {
                    return false;
                }
                break;
            case 'confirm':
                $this->db->select('user_id');
                $this->db->where('mail_hash', $user_email);
                $result = $this->db->get($this->mail_confirm_table)->result_array();
                if ($result) {
                    $id = $result['0']['user_id'];
                    $data = array('user_role' => 'user');
                    $this->db->where('id', $id);
                    if ($this->db->update($this->user_table, $data)) {
                        //delete temp data
                        $this->db->delete($this->mail_confirm_table, array(
                            'mail_hash' => $user_email));
                         $this->notification_model->add_notification($id, 'Mail Confirm', 'Yor mail was validated');
                    }
                    return true;
                } else {
                    return false;
                }
                break;
        }
    }
    
    function login($login, $pwd)
    {
        $this->db->select('*');
        $this->db->where('username', $login);
        $this->db->where('password', $pwd);
        $result = $this->db->get($this->user_table)->result_array();
        if ($result) {
            return $result['0'];
        } else {
            return false;
        }
    }
}    
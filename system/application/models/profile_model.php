<?php

class Profile_model extends Model
{
    function Profile_model()
    {
        parent::Model();
        $this->user_table = 'users';
        $this->clans_table = 'clans';
        $this->mail_confirm_table = 'mail_confirm';
    }
    
    function update()
    {
        // get  login/pw data
        $first = $this->input->post('first');
        $last = $this->input->post('last');
        $data = array('first_name' => $first, 'last_name' => $last);
        $this->db->where('id', $this->session->userdata('id'));
        if ($this->db->update($this->user_table, $data)) {
            $this->notification_model->add_notification($this->session->userdata('id'), 'Profile', 'Yor profile was updated');
            $this->session->set_userdata($data);
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
     * Function send mail for confirm password reset
     * 
     * @param $action send or check
     * @param $user_email email
     * @param $user_id user id for send
     * @return true or false
     * @author MirkiLL
     */
    function reset_password($action, $user_email, $user_id = '0')
    {
        switch ($action) {
            case 'send':
                $day = date('d');
                $hash = $user_email . $day;
                $hash = md5($hash);
                $this->db->where('user_id', $user_id);
                $this->db->delete($this->mail_confirm_table);
                
                $data = array('user_id' => $user_id, 'mail_hash' => $hash, 'day' => $day);
                $subj = 'Password Reset Confirm';
                $url = base_url();
                $msg = "If your try reset your password use link: $url" . "mail/reset_confirm/$hash
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
                    //generate new password using char from hesh
                    $new_pwd = $user_email[2] . $user_email[0] . $user_email[1] . $user_email[9] . $user_email[8] . $user_email[7];
                    
                    $data = array('password' => md5($new_pwd));
                    $this->db->where('id', $id);
                    if ($this->db->update($this->user_table, $data)) {
                        //delete temp data
                        $this->db->delete($this->mail_confirm_table, array(
                            'mail_hash' => $user_email));
                        $this->notification_model->add_notification($id, 'Password reset', 'Yor password was reseted');
                        
                        $this->db->select('email, username');
                        $this->db->where('id', $id);
                        $user = $this->db->get($this->user_table)->result_array();
                        if ($user) {
                            $login = $user[0]['username'];
                            $user_email = $user[0]['email'];
                            $subj = 'Password Reset Succes';
                            $url = base_url();
                            $msg = "
                            Your password in site $url was changed <br />
                            login: $login <br />
                        	password: $new_pwd";
                            $this->mail_model->send_mail($user_email, $subj, $msg);
                            redirect('/message/success/reset', 'refresh');
                        } else
                            echo "New password: $new_pwd";
                    }
                    return true;
                } else {
                    return false;
                }
                break;
        }
    }
    
    function update_pwd($pw1, $pw2)
    {
        if ($pw1 == $pw2) {
            $password = md5($pw1);
            $id = $this->session->userdata('id');
            $array = array('password' => $password);
            $this->db->where('id', $id);
            if (! $this->db->update($this->user_table, $array)) {
                return false;
            } else {
                return true;
                $this->notification_model->add_notification($id, 'Password update', 'Yor password was updated');
            }
        
        } else {
            return false;
        }
    }
    
    function get_mail_by_id($user_id)
    {
        $this->db->select('email');
        $this->db->where('id', $user_id);
        $result = $this->db->get($this->user_table)->result_array();
        if ($result) {
            return $result[0]['email'];
        } else {
            return false;
        }
    }
    function get_name_by_id($user_id)
    {
        $this->db->select('username');
        $this->db->where('id', $user_id);
        $result = $this->db->get($this->user_table)->result_array();
        if ($result) {
            return $result[0]['username'];
        } else {
            return false;
        }
    }

}
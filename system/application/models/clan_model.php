<?php

class Clan_model extends Model
{
    function Clan_model()
    {
        parent::Model();
        $this->user_table = 'users';
        $this->clans_table = 'clans';
        $this->request_table = 'request';
        $this->load->model('mail_model');
        $this->load->model('profile_model');
        //$this->mail_confirm_table = 'mail_confirm';
    }
    
    function get_clan_info($clan_id)
    {
        $this->db->select('*');
        $this->db->where('id', $clan_id);
        $result = $this->db->get($this->clans_table)->result_array();
        if ($result) {
            $this->db->where('clan_id', $clan_id);
            $this->db->from($this->user_table);
            $count = $this->db->count_all_results();
            
            $this->db->select('username');
            $this->db->where('id', $result[0]['cl_id']);
            $name = $this->db->get($this->user_table)->result_array();
            
            $result[0]['cl_name'] = $name[0]['username'];
            $result[0]['members'] = $count;
            return $result[0];
        } else {
            return false;
        }
    
    }
    
    function create_clan($name, $lvl, $server)
    {
        $this->db->select('*');
        $this->db->where('name', $name);
        $this->db->where('server', $server);
        $result = $this->db->get($this->clans_table)->result_array();
        if ($result) {
            return $this->echo_json(array('result' => 'false'));
        } else {
            $id = $this->session->userdata('id');
            $array = array('name' => $name, 'clan_lvl' => $lvl, 'cl_id' => $id, 'server' => $server);
            $result = $this->db->insert($this->clans_table, $array);
            if ($result) {
                $insert_id = $this->db->insert_id();
                $data = array('clan_id' => $insert_id, 'user_role' => 'clan_master');
                $this->db->where('id', $id);
                $result = $this->db->update($this->user_table, $data);
                if ($result) {
                    //$this->session->userdata('user_role'); 
                    $data = array('clan_id' => $insert_id, 'user_role' => 'clan_master');
                    $this->session->set_userdata($data);
                    //redirect('/profile/', 'refresh');
                    $date = date('d-m-Y');
                    $this->notification_model->add_notification($this->session->userdata('id'), 'Clan created', "Yor successful created clan - $name");
                    $this->notification_model->add_notification($insert_id, 'Clan was created', "Clan $name was created ($date)", "clan");
                    return $this->echo_json(array('result' => 'true'));
                }
            } else {
                return $this->echo_json(array('result' => 'db error'));
            }
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
    
    function get_clan_names()
    {
        $this->db->select('*');
        $this->db->order_by('server desc, name asc');
        $result = $this->db->get($this->clans_table)->result_array();
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }
    
    /**
     * Reqest for join clan if your member of this clan
     * @param $clan_id
     * @return unknown_type
     */
    function join_request($clan_id)
    {
        if ($this->check_join_request($this->session->userdata('id'))) {
            return $this->echo_json(array('result' => 'false'));
        }
        //for security
        $clan_id = (int) $clan_id;
        
        $array = array('clan_id' => $clan_id, 'user_id' => $this->session->userdata('id'));
        $result = $this->db->insert($this->request_table, $array);
        if ($result) {
            $cl = $this->get_cl_from_clan($clan_id);
            $this->notification_model->add_notification($this->session->userdata('id'), 'Clan join request', "Yor request to join clan");
            
            $subj = 'New clan member request';
            $user = $this->session->userdata('username');
            $clan = $cl['name'];
            $url = site_url('requests/');
            $msg = "
            Hi, your resive this message couse user: $user think what he member of clan: $clan. <br />
            Please make your decision. <br />
            <a href='$url'>$url</a>
            ";
            $this->mail_model->send_mail($cl['email'], $subj, $msg);
            return $this->echo_json(array('result' => 'true'));
        } else {
            return $this->echo_json(array('result' => 'false'));
        }
    }
    
    /**
     * Get CL info from clan by clan id
     * 
     * @param $clan_id int clan_id
     * @return array
     */
    function get_cl_from_clan($clan_id)
    {
        $this->db->select('*');
        $this->db->from($this->user_table);
        $this->db->join($this->clans_table, 'clans.cl_id = users.id');
        $this->db->where('clan_id', $clan_id);
        $result = $this->db->get()->result_array();
        if ($result) {
            return $result[0];
        } else {
            return false;
        }
    }
    /**
     * Check does the user left request for join
     * 
     * if left return true
     * @param $case
     * @param $id
     * @return if left return true
     */
    function check_join_request($id, $case = 'user')
    {
        switch ($case) {
            case 'user':
                //$this->db->select('*');
                $this->db->where('user_id', $id);
                $this->db->from($this->request_table);
                $result = $this->db->count_all_results();
                if ($result > 0) {
                    return true;
                } else {
                    return false;
                }
                break;
            case 'clan':
                $this->db->select('users.id,
                users.username,
                users.first_name,
                users.last_name');
                $this->db->from($this->user_table);
                $this->db->join($this->request_table, 'request.user_id = users.id');
                $this->db->where('request.clan_id', $id);
                $this->db->order_by('request.date desc');
                $result = $this->db->get()->result_array();
                if ($result) {
                    return $result;
                } else {
                    return false;
                }
                break;
        }
    }
    
    function cancel_join($id)
    {
        $result = $this->db->delete($this->request_table, array('user_id' => $id));
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Accept or dismiss request for clan join
     * 
     * @return void
     */
    function new_member($user_id, $action)
    {
        if ($action == 'dismiss') {
            $result = $this->db->delete($this->request_table, array('user_id' => $user_id));
            if ($result) {
                $this->notification_model->add_notification($user_id, 'Clan joined', "Yor request dismissed");
                return $this->echo_json(array('result' => 'dismiss'));
            } else {
                return $this->echo_json(array('result' => 'false'));
            }
        } elseif ($action == 'accept') {
            
            $clan_id = $this->session->userdata('clan_id');
            $data = array('user_role' => 'clan_member', 'clan_id' => $clan_id);
            $this->db->where('id', $user_id);
            $result = $this->db->update($this->user_table, $data);
            if ($result) {
                //delete from request table
                $this->db->delete($this->request_table, array('user_id' => $user_id));
                $url = base_url();
                $mail = $this->profile_model->get_mail_by_id($user_id);
                $name = $this->profile_model->get_name_by_id($user_id);
                $subj = 'Answer about clan join';
                $msg = "Congradilation, $name, now your clan member. <br>
                Please relogin in site $url
                ";
                $this->mail_model->send_mail($mail, $subj, $msg);
                
                $this->notification_model->add_notification($user_id, 'Clan joined', "Yor successful join to clan");
                $this->notification_model->add_notification($this->session->userdata('id'), 'Member joined', "Yor successful join $name to clan");
                $this->notification_model->add_notification($clan_id, 'New member', "$name now in our clan", "clan");
                
                
                return $this->echo_json(array('result' => 'accept'));
            } else {
                return $this->echo_json(array('result' => 'false'));
            }
        }
    }

}
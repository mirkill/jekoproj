<?php

class Notification_model extends Model
{
    function Notification_model()
    {
        parent::Model();
        $this->user_table = 'users';
        $this->notification_table = 'notifications';
    }
    
    function add_notification($user_id, $name, $describe, $clan = 'no')
    {
        if ($clan == 'no') {
            $data = array('user_id' => $user_id, 'name' => $name, 'describe' => $describe);
        } else {
            $data = array('clan_id' => $user_id, 'name' => $name, 'describe' => $describe);
        }
        
        if ($this->db->insert($this->notification_table, $data)) {
            return true;
        } else {
            return false;
        }
    }
    
    function get_notification($count, $page = 1, $clan = 'no')
    {
        if ($clan == 'no') {
            $this->db->select('*');
            $id = $this->session->userdata('id');
            $this->db->where('user_id', $id);
            $this->db->limit($count);
            $this->db->order_by('date desc');
            $result = $this->db->get($this->notification_table)->result_array();
            if($result){
                return $result;
            }else{
            return false;
            }
            
        } else {
        $this->db->select('*');
            $id = $this->session->userdata('clan_id');
            $this->db->where('clan_id', $id);
            $this->db->limit($count);
            $this->db->order_by('date desc');
            $result = $this->db->get($this->notification_table)->result_array();
            if($result){
                return $result;
            }else{
            return false;
            }
        }
    
    }

}
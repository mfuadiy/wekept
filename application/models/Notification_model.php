<?php

/**
 * 
 */
class Notification_model extends CI_Model
{

    public function get_latest_notifications($email)
    {
        $this->db->select('*');
        $this->db->from('notifications');
        $this->db->where('email', $email);
        $this->db->order_by('date_created', 'DESC');
        // $this->db->limit(5); // Fetch latest 5 notifications

        $query = $this->db->get();
        return $query->result_array();
    }

    public function mark_as_read($notification_id)
    {
        $set = array(
            "is_read" => True
        );
        $this->db->where('id', $notification_id);
        return $this->db->update('notifications', $set);
    }
}

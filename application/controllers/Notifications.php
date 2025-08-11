<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';



class Notifications extends CI_Controller
{
    public function get_notifications()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $email = $data['user']['email'];

        // Load model if not already loaded
        $this->load->model('Notification_model');

        // Fetch notifications
        $notifications = $this->Notification_model->get_latest_notifications($email);

        // Return notifications as JSON
        echo json_encode($notifications);
    }

    public function mark_as_read($notification_id)
    {
        // Load model if not already loaded
        $this->load->model('Notification_model');

        // Update notification status to read
        $result = $this->Notification_model->mark_as_read($notification_id);

        if ($result) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }
}

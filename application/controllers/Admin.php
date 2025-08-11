<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Admin_model', 'admin');
    }

    public function index()
    {
        $data['title']     = 'Dashboard';
        $data['judul']    = 'Admin';
        $data['user']     = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['numAktif']    = $this->admin->getNumAktif();
        $data['numPasif']    = $this->admin->getNumPasif();
        $data['numDatul']    = $this->admin->getDatul();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function role()
    {
        $data['title']     = 'Role';
        $data['judul']    = 'Admin';
        $data['user']     = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role']     = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }

    public function roleAccess($role_id)
    {
        $data['title']     = 'Role Access';
        $data['judul']    = 'Admin';
        $data['user']     = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role']     = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu']    = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function changeaccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Akses telah diubah! </div>');
    }

    public function getUser($id)
    {
        // Memanggil model untuk mengambil data user berdasarkan ID
        $user = $this->admin->get_user_by_id($id);

        if ($user) {
            // Mengembalikan data dalam format JSON
            echo json_encode($user);
        } else {
            // Jika data user tidak ditemukan
            echo json_encode(['message' => 'User not found']);
        }
    }

    public function user()
    {
        $data['title']     = 'Daftar User';
        $data['judul']    = 'Admin';
        $data['user']     = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['list_user'] = $this->db->get('user')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/user', $data);
        $this->load->view('templates/footer');
    }

    public function edituser()
    {
        $data['title']     = 'Edit User';
        $data['judul']    = 'Admin';
        $data['user']     = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['list_user'] = $this->db->get('user')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/edituser', $data);
        $this->load->view('templates/footer');
    }
}

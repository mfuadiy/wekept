<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}

	public function index()
	{
		$data['title'] = 'Menu Management';
		$data['judul'] = 'Menu';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['menu'] = $this->db->order_by('no_urut', 'ASC')->get('user_menu')->result_array();

		$this->form_validation->set_rules('menu', 'Menu', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('menu/index', $data);
			$this->load->view('templates/footer');
		} else {
			$this->db->insert('user_menu', ['menu' => $this->input->post('menu'), 'controller' => $this->input->post('ctrl')]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
  			Menu baru berhasil ditambahkan.
			</div>');
			redirect('menu');
		}
	}

	public function edit_menu()
	{
		$id = $this->input->post('id');
		$data = [
			'menu' => $this->input->post('menu'),
			'controller' => $this->input->post('controller'),
			'no_urut' => $this->input->post('no_urut')
		];

		$this->db->where('id', $id);
		$this->db->update('user_menu', $data);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu berhasil diupdate!</div>');
		redirect('menu');
	}

	public function delete_menu($menu_id)
	{
		$this->db->where('id', $menu_id);
		$this->db->delete('user_menu');
		redirect('menu');
	}

	public function submenu()
	{
		$data['title'] = 'Sub Menu Management';
		$data['judul'] = 'Menu';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->model('Menu_model', 'menu');
		$data['subMenu'] = $this->menu->getSubMenu();
		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('menu_id', 'Menu', 'required');
		$this->form_validation->set_rules('url', 'URL', 'required');
		$this->form_validation->set_rules('icon', 'Icon', 'required');


		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('menu/submenu', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'title' => $this->input->post('title'),
				'menu_id' => $this->input->post('menu_id'),
				'url' => $this->input->post('url'),
				'icon' => $this->input->post('icon'),
				'is_active' => $this->input->post('is_active'),
			];
			$this->db->insert('user_sub_menu', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
  			Sub Menu baru berhasil ditambahkan.
			</div>');
			redirect('menu/submenu');
		}
	}

	public function update_submenu()
	{
		$data['title'] = 'Sub Menu Management';
		$data['judul'] = 'Menu';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->model('Menu_model', 'menu');
		$data['subMenu'] = $this->menu->getSubMenu();
		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('menu_id', 'Menu', 'required');
		$this->form_validation->set_rules('url', 'URL', 'required');
		$this->form_validation->set_rules('icon', 'Icon', 'required');



		$data1 = [
			'title' => $this->input->post('title'),
			'menu_id' => $this->input->post('menu_id'),
			'url' => $this->input->post('url'),
			'icon' => $this->input->post('icon'),
			'is_active' => $this->input->post('is_active'),
		];
		$where = array(
			'id' => $this->input->post('id')
		);

		$this->db->where($where);
		$this->db->update('user_sub_menu', $data1);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
  			Sub Menu ' . $data1['title'] . ' berhasil diupdate.
			</div>');
		redirect('menu/submenu');
	}
}

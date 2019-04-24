<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Admin_model', 'admin');
        $this->load->model('Menu_model', 'menu');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user']  = $this->admin->getUser();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function role()
    {
        $data['title'] = 'Role';
        $data['user']  = $this->admin->getUser();
        $data['role']  = $this->admin->getRole();

        $rules = $this->admin->rules;
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        } else {
            $this->admin->insertRole();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New role added!</div>');
            redirect('admin/role');
        }
    }

    public function edit()
    {
        $data['title'] = 'Role';
        $data['user']  = $this->admin->getUser();
        $data['role']  = $this->admin->getRole();

        $rules = $this->admin->rules;
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        } else {
            $id = $this->input->post('id');
            $data = [
                'role' => $this->input->post('role')
            ];

            $this->admin->updateRole($id, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Update role success!</div>');
            redirect('admin/role');
        }
    }

    public function delete($id = '')
    {
        $this->admin->deleteRole($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Delete role success!</div>');
        redirect('admin/role');
    }

    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user']  = $this->admin->getUser();
        $data['role']  = $this->admin->getRoleRow($role_id);
        $data['menu'] = $this->menu->getMenu();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function changeAccess()
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

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Change!</div>');
    }
}

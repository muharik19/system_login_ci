<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Menu_model', 'menu');
    }

    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['user']  = $this->menu->getUser();
        $data['menu']  = $this->menu->getMenu();

        $rules = $this->menu->rules;
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->menu->insertMenu();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New menu added!</div>');
            redirect('menu');
        }
    }

    public function edit()
    {
        $data['title'] = 'Menu Management';
        $data['user']  = $this->menu->getUser();
        $data['menu']  = $this->menu->getMenu();

        $rules = $this->menu->rules;
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $id = $this->input->post('id');
            $data = [
                'menu' => $this->input->post('menu')
            ];

            $this->menu->updateMenu($id, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Update menu success!</div>');
            redirect('menu');
        }
    }

    public function delete($id = '')
    {
        $this->menu->deleteMenu($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Delete menu success!</div>');
        redirect('menu');
    }

    public function submenu()
    {
        $data['title']   = 'Submenu Management';
        $data['user']    = $this->menu->getUser();
        $data['submenu'] = $this->menu->getSubMenu();
        $data['menu']    = $this->menu->getMenu();

        $rules_submenu = $this->menu->rules_submenu;
        $this->form_validation->set_rules($rules_submenu);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $this->menu->insertSubmenu();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New submenu added!</div>');
            redirect('menu/submenu');
        }
    }

    public function editSubmenu()
    {
        $data['title']   = 'Edit Submenu Management';
        $data['user']    = $this->menu->getUser();
        $data['submenu'] = $this->menu->getSubMenu();
        $data['menu']    = $this->menu->getMenu();

        $rules_submenu = $this->menu->rules_submenu;
        $this->form_validation->set_rules($rules_submenu);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $id = $this->input->post('id');
            $data = [
                'title'     => $this->input->post('title'),
                'menu_id'   => $this->input->post('menu_id'),
                'url'       => $this->input->post('url'),
                'icon'      => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->menu->updateSubmenu($id, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Update submenu success!</div>');
            redirect('menu/submenu');
        }
    }

    public function trashSubmenu($id = '')
    {
        $this->menu->deleteSubmenu($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Delete Submenu success!</div>');
        redirect('menu/submenu');
    }
}

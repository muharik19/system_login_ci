<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public $rules = [
        'menu' => [
            'field' => 'menu',
            'label' => 'Menu',
            'rules' => 'trim|required|is_unique[user_menu.menu]'
        ]
    ];

    public $rules_submenu = [
        'title' => [
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'trim|required'
        ],
        'menu_id' => [
            'field' => 'menu_id',
            'label' => 'Menu',
            'rules' => 'trim|required'
        ],
        'url' => [
            'field' => 'url',
            'label' => 'URL',
            'rules' => 'trim|required'
        ],
        'icon' => [
            'field' => 'icon',
            'label' => 'Icon',
            'rules' => 'trim|required'
        ],
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function getUser()
    {
        $result = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        return $result;
    }

    public function getMenu()
    {
        $result = $this->db->get('user_menu')->result_array();
        return $result;
    }

    public function insertMenu()
    {
        $data = [
            'menu' => $this->input->post('menu')
        ];

        $result = $this->db->insert('user_menu', $data);
        return $result;
    }

    public function updateMenu($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('user_menu', $data);
        // print_r($this->db->last_query());
        // exit;
    }

    public function deleteMenu($id = '')
    {
        $this->db->where('id', $id);
        return $this->db->delete('user_menu');
    }

    public function getSubMenu()
    {
        $query = "SELECT user_sub_menu.*, user_menu.menu
                    FROM user_sub_menu JOIN user_menu
                        ON user_sub_menu.menu_id = user_menu.id
        ";
        return $this->db->query($query)->result_array();

        // $query = $this->db->select('user_sub_menu.*, user_menu.menu')
        //     ->from('user_sub_menu')
        //     ->join('user_menu', 'user_sub_menu.menu_id = user_menu.id');

        // return $this->db->query($query)->result_array();
        // print_r($this->db->last_query($query));
        // exit;
    }

    public function insertSubmenu()
    {
        $data = [
            'title'     => $this->input->post('title'),
            'menu_id'   => $this->input->post('menu_id'),
            'url'       => $this->input->post('url'),
            'icon'      => $this->input->post('icon'),
            'is_active' => $this->input->post('is_active')
        ];
        $this->db->insert('user_sub_menu', $data);
    }

    public function updateSubmenu($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('user_sub_menu', $data);
    }

    public function deleteSubmenu($id = '')
    {
        $this->db->where('id', $id);
        return $this->db->delete('user_sub_menu');
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public $rules = [
        'role' => [
            'field' => 'role',
            'label' => 'Role',
            'rules' => 'trim|required|is_unique[user_role.role]'
        ]
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

    public function getRole()
    {
        $result = $this->db->get('user_role')->result_array();
        return $result;
    }

    public function getRoleRow($role_id)
    {
        $role_id = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
        $this->db->where('id !=', 1);
        return $role_id;
    }

    public function insertRole()
    {
        $data = [
            'role' => $this->input->post('role')
        ];

        $result = $this->db->insert('user_role', $data);
        return $result;
    }

    public function updateRole($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('user_role', $data);
    }

    public function deleteRole($id = '')
    {
        $this->db->where('id', $id);
        return $this->db->delete('user_role');
    }
}

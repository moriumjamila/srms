<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $id = $this->session->userdata('user_id');
        if ($id == null) {
            redirect('index');
        }
    }

    function index() {
        $data = [
            'title' => 'Manage Departments',
            'get_departments' => $this->db->get('departments')->result(),
        ];
        $data['maincontent'] = $this->load->view('settings/department/index', $data, true);
        $this->load->view('mainpage', $data);
    }

    function save() {
        $data = [
            'name' => $this->input->post('department_name'),
        ];
        $this->db->insert('departments', $data);
        $this->session->set_flashdata('success', 'New Department Added Successfully');
        return redirect('manage_departments');
    }

    function update() {
        $id = $this->input->post('data_id');
        $data = [
            'name' => $this->input->post('department_name'),
        ];
        $this->db->where('dep_id', $id)->update('departments', $data);
        $this->session->set_flashdata('success', 'Department Updated Successfully');
        return redirect('manage_departments');
    }

    public function delete($id) {
        $this->db->where('dep_id', $id)->delete('departments');
        $this->session->set_flashdata('success', 'Department Deleted Successfully');
        return redirect('manage_departments');
    }

}

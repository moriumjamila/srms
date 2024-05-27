<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Semester extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $id = $this->session->userdata('user_id');
        if ($id == null) {
            redirect('index');
        }
    }

    function index() {
        $data = [
            'title' => 'Manage Semesters',
            'get_semesters' => $this->db->get('semesters')->result(),
        ];
        $data['maincontent'] = $this->load->view('settings/semester/index', $data, true);
        $this->load->view('mainpage', $data);
    }

    function save() {
        $data = [
            'name' => $this->input->post('semester_name'),
        ];
        $this->db->insert('semesters', $data);
        $this->session->set_flashdata('success', 'New Semester Added Successfully');
        return redirect('manage_semesters');
    }

    function update() {
        $id = $this->input->post('data_id');
        $data = [
            'name' => $this->input->post('semester_name'),
        ];
        $this->db->where('sem_id', $id)->update('semesters', $data);
        $this->session->set_flashdata('success', 'Semester Updated Successfully');
        return redirect('manage_semesters');
    }

    public function delete($id) {
        $this->db->where('sem_id', $id)->delete('semesters');
        $this->session->set_flashdata('success', 'Semester Deleted Successfully');
        return redirect('manage_semesters');
    }

}

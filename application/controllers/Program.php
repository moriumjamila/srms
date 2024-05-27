<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Program extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $id = $this->session->userdata('user_id');
        if ($id == null) {
            redirect('index');
        }
    }

    function index() {
        $data = [
            'title' => 'Manage Programs',
            'get_programs' => $this->db->get('programs')->result(),
        ];
        $data['maincontent'] = $this->load->view('settings/program/index', $data, true);
        $this->load->view('mainpage', $data);
    }

    function save() {
        $data = [
            'name' => $this->input->post('program_name'),
        ];
        $this->db->insert('programs', $data);
        $this->session->set_flashdata('success', 'New Program Added Successfully');
        return redirect('manage_programs');
    }

    function update() {
        $id = $this->input->post('data_id');
        $data = [
            'name' => $this->input->post('program_name'),
        ];
        $this->db->where('pg_id', $id)->update('programs', $data);
        $this->session->set_flashdata('success', 'Program Updated Successfully');
        return redirect('manage_programs');
    }

    public function delete($id) {
        $this->db->where('pg_id', $id)->delete('programs');
        $this->session->set_flashdata('success', 'Program Deleted Successfully');
        return redirect('manage_programs');
    }

}

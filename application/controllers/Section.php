<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Section extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $id = $this->session->userdata('user_id');
        if ($id == null) {
            redirect('index');
        }
    }

    function index() {
        $data = [
            'title' => 'Manage Sections',
            'get_sections' => $this->db->get('sections')->result(),
        ];
        $data['maincontent'] = $this->load->view('settings/section/index', $data, true);
        $this->load->view('mainpage', $data);
    }

    function save() {
        $data = [
            'name' => $this->input->post('section_name'),
        ];
        $this->db->insert('sections', $data);
        $this->session->set_flashdata('success', 'New Section Added Successfully');
        return redirect('manage_sections');
    }

    function update() {
        $id = $this->input->post('data_id');
        $data = [
            'name' => $this->input->post('section_name'),
        ];
        $this->db->where('sec_id', $id)->update('sections', $data);
        $this->session->set_flashdata('success', 'Section Updated Successfully');
        return redirect('manage_sections');
    }

    public function delete($id) {
        $this->db->where('sec_id', $id)->delete('sections');
        $this->session->set_flashdata('success', 'Section Deleted Successfully');
        return redirect('manage_sections');
    }

}

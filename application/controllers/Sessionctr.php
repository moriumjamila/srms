<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sessionctr extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $id = $this->session->userdata('user_id');
        if ($id == null) {
            redirect('index');
        }
    }

    function index() {
        $data = [
            'title' => 'Manage Sessions',
            'get_sessions' => $this->db->get('sessions')->result(),
        ];
        $data['maincontent'] = $this->load->view('settings/session/index', $data, true);
        $this->load->view('mainpage', $data);
    }

    function save() {
        $data = [
            'name' => $this->input->post('session_name'),
        ];
        $this->db->insert('sessions', $data);
        $this->session->set_flashdata('success', 'New Session Added Successfully');
        return redirect('manage_sessions');
    }

    function update() {
        $id = $this->input->post('data_id');
        $data = [
            'name' => $this->input->post('session_name'),
        ];
        $this->db->where('sec_id', $id)->update('sessions', $data);
        $this->session->set_flashdata('success', 'Session Updated Successfully');
        return redirect('manage_sessions');
    }

    public function delete($id) {
        $this->db->where('sec_id', $id)->delete('sessions');
        $this->session->set_flashdata('success', 'Session Deleted Successfully');
        return redirect('manage_sessions');
    }

}

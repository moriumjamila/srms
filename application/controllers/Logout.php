<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

    //Load Login Index File...............
    function index() {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('get_type');
        $this->session->set_flashdata('message', '<div style="color:#fff;background:#009688;padding:10px;border:5px solid #000;border-radius: 20px 0px;text-align: center"><b>You Are Successfully Logged Out</b></div>');
        redirect('index');
    }

}

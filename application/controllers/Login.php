<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $user_id = $this->session->userdata('user_id');
        $role = $this->session->userdata('role');
        if ($user_id != null) {
            if ($role == 1) {
                redirect('dashboard');
            } elseif ($role == 2) {
                redirect('teacher_profile');
            } else {
                redirect('student_profile');
            }
            redirect('dashboard.php');
        }
    }

    function index() {
        $this->load->view('login');
    }

    function login_page() {
        $this->load->view('login');
    }

    function authenticateuser() {
        $username = $this->input->post('username', true);
        $password = sha1($this->input->post('password', true));
        $captcha_response = trim($this->input->post('g-recaptcha-response'));
        if ($captcha_response != '') {
            //Local Host
            $keySecret = '6LeNcsYpAAAAAD64qc4k0vRSssebkj_dzWGozkS8';
            //Live Host
            //$keySecret = '6LfNc8YpAAAAAPAxb0NninkInRuampUPIxrEzA_v';

            $check = array(
                'secret' => $keySecret,
                'response' => $this->input->post('g-recaptcha-response')
            );
            $startProcess = curl_init();
            curl_setopt($startProcess, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
            curl_setopt($startProcess, CURLOPT_POST, true);
            curl_setopt($startProcess, CURLOPT_POSTFIELDS, http_build_query($check));
            curl_setopt($startProcess, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($startProcess, CURLOPT_RETURNTRANSFER, true);
            $receiveData = curl_exec($startProcess);
            $finalResponse = json_decode($receiveData, true);
            if ($finalResponse['success']) {
                
            } else {
                $this->session->set_flashdata('message', '<div style="color:#fff;background:red;padding:10px;border:5px solid #000;border-radius: 20px 0px;text-align: center;font-size:18px"><b>reCaptcha Validation Fail Try Again !</div>');
                redirect('/login');
            }
        } else {
            $this->session->set_flashdata('message', '<div style="color:#fff;background:red;padding:10px;border:5px solid #000;border-radius: 20px 0px;text-align: center;font-size:18px"><b>reCaptcha Validation Fail Try Again !</div>');
            redirect('/login');
        }

        $result = $this->db->where('id_no', $username)->get('teacher_students')->row();
        if ($result->id_no != $username) {
            $this->session->set_flashdata('message', '<div style="color:#fff;background:red;padding:10px;border:5px solid #000;border-radius: 20px 0px;text-align: center; font-size:18px"><b>Username Does Not Exist!</div>');
            redirect('/');
        }
        if ($result->password != $password) {
            $this->session->set_flashdata('message', '<div style="color:#fff;background:red;padding:10px;border:5px solid #000;border-radius: 20px 0px;text-align: center;font-size:18px"><b>Password Does Not match!</div>');
            redirect('/');
        }

        if ($result->status != 1) {
            $this->session->set_flashdata('message', '<div style="color:#fff;background:red;padding:10px;border:5px solid #000;border-radius: 20px 0px;text-align: center;font-size:18px"><b>Invalid User Access !</div>');
            redirect('/');
        }

        $data = array(
            'user_id' => $result->ts_id,
            'role' => $result->role,
            'username' => $result->id_no,
        );
        $this->session->set_userdata($data);
        if ($data['role'] == 1) {
            redirect('dashboard');
        } elseif ($data['role'] == 2) {
            redirect('teacher_profile');
        } else {
            redirect('student_profile');
        }
    }

}

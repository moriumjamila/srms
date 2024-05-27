<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Controller {

    public $id, $role, $profile_info;

    public function __construct() {
        parent::__construct();
        $this->id = $this->session->userdata('user_id');
        $this->role = $this->session->userdata('role');
        if ($this->id == null) {
            redirect('index');
        }
    }

    function teacher_profile() {
        $data = [
            'title' => 'Teacher Profile',
            'myprofile' => $this->db->where('ts_id', $this->id)->get('teacher_students')->row(),
        ];
        $data['maincontent'] = $this->load->view('profile/teacher/index', $data, true);
        $this->load->view('mainpage', $data);
    }

    function student_profile() {
        $data = [
            'title' => 'Student Profile',
            'myprofile' => $this->db->where('ts_id', $this->id)->get('teacher_students')->row(),
            'get_student_acads' => $this->db->where('ts_id', $this->id)->get('teacher_student_acads')->result(),
        ];
        $data['maincontent'] = $this->load->view('profile/student/index', $data, true);
        $this->load->view('mainpage', $data);
    }

    function edit_profile_information() {
        $myprofile = $this->db->where('ts_id', $this->id)->get('teacher_students')->row();

        $data = [
            'title' => 'Edit Profile',
            'myprofile' => $myprofile,
            'myprofile_acads' => $this->db->where('ts_id', $this->id)->get('teacher_student_acads')->row(),
        ];
        $data['maincontent'] = $this->load->view('profile/' . $myprofile->type . '/edit', $data, true);
        $this->load->view('mainpage', $data);
    }

    function data_update() {
        $task_type = $this->input->post('task_type');
        $data = [
            'name' => $this->input->post('name'),
            'contact' => $this->input->post('contact'),
            'email' => $this->input->post('email'),
            'father' => $this->input->post('father'),
            'address' => $this->input->post('address'),
            'department' => $this->input->post('department'),
            'program' => $this->input->post('program'),
        ];
        $this->db->where('ts_id', $this->id)->update('teacher_students', $data);
        if ($task_type == 'student') {
            $acddata = [
                'session' => $this->input->post('session'),
                'semester' => $this->input->post('semester'),
                'section' => $this->input->post('section'),
            ];
            $this->db->where('tsacd_id', $this->id)->update('teacher_student_acads', $acddata);
        }
        $this->session->set_flashdata('success', 'Profile Info Updated Successfully');
        return redirect('edit_profile_information');
    }

    function photo_update() {
        $task_type = $this->input->post('task_type');
        $old_image_data = $this->input->post('old_image_data');
        //Image Upload
        $imageFiles = $_FILES;
        $get_filetypes = $imageFiles['data_photo']['type'];
        $getfiletype = explode('image/', $get_filetypes);
        $_FILES['data_photo']['name'] = date('jns') . substr(md5(rand()), 0, 15) . '.' . $getfiletype[1];
        $_FILES['data_photo']['type'] = $imageFiles['data_photo']['type'];
        $_FILES['data_photo']['tmp_name'] = $imageFiles['data_photo']['tmp_name'];
        $_FILES['data_photo']['error'] = $imageFiles['data_photo']['error'];
        $_FILES['data_photo']['size'] = $imageFiles['data_photo']['size'];
        $target_path = './public/' . $task_type . '/';
        $config = array(
            'upload_path' => $target_path,
            'allowed_types' => 'jpg|jpeg|png|webp',
            'max_size' => '10000',
        );
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->do_upload('data_photo');
        $filedata = array('upload_data' => $this->upload->data());
        $config_manip = array(
            'image_library' => 'gd2',
            'source_image' => $filedata['upload_data']['full_path'],
            'new_image' => $target_path,
            'maintain_ratio' => false,
            'width' => 200,
            'height' => 200
        );
        $this->load->library('image_lib', $config_manip);
        $this->image_lib->initialize($config_manip);
        $this->image_lib->resize();
        $fileName = $_FILES['data_photo']['name'];
        $data = [
            'photo' => $target_path . $fileName,
        ];

        $urllink = 'public/teacher/' . $old_image_data;
        if ($old_image_data && file_exists($urllink)) {
            unlink($urllink);
        }

        $this->db->where('ts_id', $this->id)->update('teacher_students', $data);
        $this->session->set_flashdata('success', 'Photo Updated Successfully');
        return redirect('edit_profile_information');
    }

    function password_update() {
        $password = $this->input->post('password');
        $c_password = $this->input->post('c_password');

        if ($password != $c_password) {
            $this->session->set_flashdata('error', 'Password Dose Not Match');
            return redirect('edit_profile_information');
        }
        $this->db->where('ts_id', $this->id)->update('teacher_students', [
            'password' => sha1($password)
        ]);
        $this->session->set_flashdata('success', 'Password Updated Successfully');
        return redirect('edit_profile_information');
    }

}

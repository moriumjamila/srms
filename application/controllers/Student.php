<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

    public $id;

    public function __construct() {
        parent::__construct();
        $this->id = $this->session->userdata('user_id');
        if ($this->id == null) {
            redirect('index');
        }
    }

    function index() {
        $data = [
            'title' => 'Student List',
            'get_students' => $this->db->order_by('ts_id', 'asc')->where('type', 'student')->get('teacher_students')->result(),
        ];
        $data['maincontent'] = $this->load->view('student/index', $data, true);
        $this->load->view('mainpage', $data);
    }

    function add() {
        $data = [
            'title' => 'Add Student',
        ];
        $data['maincontent'] = $this->load->view('student/add', $data, true);
        $this->load->view('mainpage', $data);
    }

    function save() {
        $lastidnumber = $this->db->select('id_no')->order_by('ts_id', 'desc')->get('teacher_students')->row();
        if (empty(@$lastidnumber->id_no)) {
            $getresresult = "NUBS01";
        } else {
            $resresult = explode('NUBS0', @$lastidnumber->id_no);
            $number_res = $resresult[1] + 1;
            $getresresult = 'NUBS0' . $number_res;
        }
        $uniq_id = uniqid();
        $data = [
            'id_no' => $getresresult,
            'uniq_id' => $uniq_id,
            'name' => $this->input->post('name'),
            'contact' => $this->input->post('contact'),
            'email' => $this->input->post('email'),
            'father' => $this->input->post('father'),
            'address' => $this->input->post('address'),
            'department' => $this->input->post('department'),
            'program' => $this->input->post('program'),
            'first_reg_date' => date('Y-m-d'),
            'type' => 'student',
            'password' => sha1($getresresult),
            'role' => 3,
            'status' => 1,
        ];
        $this->db->insert('teacher_students', $data);
        $last_id = $this->db->insert_id();
        $acddata = [
            'ts_id' => $last_id,
            'id_no' => $getresresult,
            'uniq_id' => $uniq_id,
            'session' => $this->input->post('session'),
            'year' => date('Y'),
            'semester' => $this->input->post('semester'),
            'section' => $this->input->post('section'),
            'reg_date' => date('Y-m-d'),
            'status' => 1,
        ];
        $this->db->insert('teacher_student_acads', $acddata);

        $this->session->set_flashdata('success', 'New Student Registration Created Successfully');
        return redirect('student_list');
    }

    function view($id) {
        $data = [
            'title' => 'View Student Information',
            'user_avatar' => get_user_avatar_byid($id),
            'get_student' => $this->db->where('ts_id', $id)->get('teacher_students')->row(),
            'get_student_acads' => $this->db->where('ts_id', $id)->where('status', 1)->get('teacher_student_acads')->result(),
        ];
        $data['maincontent'] = $this->load->view('student/view', $data, true);
        $this->load->view('mainpage', $data);
    }

    function edit($id) {
        $data = [
            'title' => 'Edit Student Information',
            'get_student' => $this->db->where('ts_id', $id)->get('teacher_students')->row(),
            'get_student_acads' => $this->db->where('ts_id', $id)->where('status', 1)->get('teacher_student_acads')->row(),
        ];
        $data['maincontent'] = $this->load->view('student/edit', $data, true);
        $this->load->view('mainpage', $data);
    }

    function update() {
        $data_id = $this->input->post('data_id');
        $data = [
            'name' => $this->input->post('name'),
            'contact' => $this->input->post('contact'),
            'email' => $this->input->post('email'),
            'father' => $this->input->post('father'),
            'address' => $this->input->post('address'),
            'department' => $this->input->post('department'),
            'program' => $this->input->post('program'),
        ];
        $this->db->where('ts_id', $data_id)->update('teacher_students', $data);
        $acddata = [
            'session' => $this->input->post('session'),
            'semester' => $this->input->post('semester'),
            'section' => $this->input->post('section'),
        ];
        $this->db->where('tsacd_id', $data_id)->update('teacher_student_acads', $acddata);
        $this->session->set_flashdata('success', "Student Info Updated Successfully");
        return redirect('student_list');
    }

    function user_access_update() {
        $data_id = $this->input->post('data_id');
        $status = $this->input->post('status');
        $message = $status == 1 ? 'Activated' : 'Inactivated';
        $this->db->where('ts_id', $data_id)->update('teacher_students', [
            'status' => $status,
        ]);
        $this->session->set_flashdata('success', "Student Access $message Successfully");
        return redirect('student_list');
    }

    function user_password_update() {
        $data_id = $this->input->post('data_id');
        $password = $this->input->post('password');
        $c_password = $this->input->post('c_password');

        if ($password != $c_password) {
            $this->session->set_flashdata('error', 'Password Dose Not Match');
            return redirect('edit_student_profile/' . $data_id);
        }

        $this->db->where('ts_id', $data_id)->update('teacher_students', [
            'password' => sha1($password)
        ]);
        $this->session->set_flashdata('success', 'Password Updated Successfully');
        return redirect('student_list');
    }

    public function delete($id) {
        $result = $this->db->select(['photo', 'id_no'])->where('ts_id', $id)->get('teacher_students')->row();
        $urllink = 'public/student/' . $result->photo;
        if (file_exists($urllink)) {
            unlink($urllink);
        }
        $this->db->where('ts_id', $id)->delete('teacher_students');
        $this->db->where('ts_id', $id)->delete('teacher_student_acads');
        $this->session->set_flashdata('success', 'Student Profile Deleted Successfully');
        return redirect('student_list');
    }

    /*     * **************************** Semester Registration  ************************************ */

    function student_semester_registration() {
        $student_info = $this->db->where('ts_id', $this->id)->get('teacher_students')->row();
        $session = $sid = $this->input->get('session');
        $semester = $sid = $this->input->get('semester');
        $section = $sid = $this->input->get('section');
        $department = $student_info->department;
        $program = $student_info->program;
        if (!empty($session)) {
            $semester_subjects = $this->Universal_model->search_semester_wise_subjects($department, $program, $session, $semester, $section);
        } else {
            $semester_subjects = [];
        }

        $data = [
            'title' => 'Show Semester Registration',
            'student_info' => $student_info,
            'session' => $session,
            'semester' => $semester,
            'section' => $section,
            'semester_subjects' => $semester_subjects,
            'last_semreg_info' => $this->db->where('student_id', $this->id)->order_by('sem_reg_info_id', 'desc')->get('semester_reg_info')->row(),
            'get_semester_session' => $this->db->select('session')->order_by('sem_sub_id', 'asc')->get('semester_subjects')->result(),
            'semester_reg_info' => $this->db->where('student_id', $this->id)->get('semester_reg_info')->result(),
            'get_subjects' => $this->db->get('subjects')->result(),
        ];
        $data['maincontent'] = $this->load->view('profile/student/semester', $data, true);
        $this->load->view('mainpage', $data);
    }

    function save_semester_registration() {
        $department = $this->input->post('department');
        $session = $this->input->post('session');
        $program = $this->input->post('program');
        $semester_no = $this->input->post('semester');
        $tsacd_id = $this->input->post('tsacd_id');

        $total_credit = $this->input->post('total_credit_taken');
        $result = $this->db->where('student_id', $this->id)->where('session', $session)->get('semester_reg_info')->num_rows();
        $attempt = $this->db->select(['is_approve', 'student_id'])->where('student_id', $this->id)->get('semester_reg_info')->row();
        if (count((array) $this->input->post('subject_id')) == 0) {
            $this->session->set_flashdata('error', 'Must be selected check box');
            return redirect('student_semester_registration');
        }

        if ($result > 0) {
            $this->session->set_flashdata('error', 'Already Exsist This Session');
            return redirect('student_semester_registration');
        }

        if ($attempt->is_approve == 0 && $attempt->student_id == $this->id) {
            $this->session->set_flashdata('error', 'Your New Registration is Pending For Approval');
            return redirect('student_semester_registration');
        }

        if ($attempt->is_approve == 1 && $attempt->is_complete == 0) {
            $this->session->set_flashdata('error', 'Can Not Make New Registration Until Finished Your Running Session');
            return redirect('student_semester_registration');
        }


        $data = [
            'student_id' => $this->id,
            'session' => $session,
            'semester_no' => $semester_no,
            'total_credit' => $total_credit,
            'reg_date' => date('Y-m-d'),
            'reg_month' => date('F-Y'),
        ];
        $this->db->insert('semester_reg_info', $data);
        $last_id = $this->db->insert_id();

        foreach ((array) $this->input->post('subject_id') as $key => $value) {
            $regdata = [
                'student_id' => $this->id,
                'reg_info_id' => $last_id,
                'subject_id' => $this->input->post('subject_id')[$key],
                'tsacd_id' => $tsacd_id,
                'department' => $department,
                'session' => $session,
                'program' => $program,
                'semester' => $semester_no,
                'section' => $this->input->post('section'),
            ];
            $this->db->insert('semester_registrations', $regdata);
        }
        $this->session->set_flashdata('success', 'Semester Registration Created Successfully. Keep waiting for approval');
        return redirect('student_semester_registration');
    }

    function student_result_information() {
        $session = $this->input->post('session');
        $type = $this->input->post('type');
        if ($session) {
            $session_name = $session;
            $session_value = $this->db->where('session', $session)->where('student_id', $this->id)->get('results')->num_rows();
            $session_wise_result = $this->Universal_model->get_student_result_information_bydata($session, $type, $this->id);
        } else {
            $session_value = 0;
            $session_name = '';
            $session_wise_result = [];
        }
        $data = [
            'title' => 'Result Information',
            'session_name' => $session_name,
            'type' => $type,
            'session_value' => $session_value,
            'session_wise_result' => $session_wise_result,
            'academic_ranscripts' => $this->db->select('session')->distinct()->get('semester_registrations')->result(),
        ];
        $data['maincontent'] = $this->load->view('profile/student/result', $data, true);
        $this->load->view('mainpage', $data);
    }

}

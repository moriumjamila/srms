<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $id = $this->session->userdata('user_id');
        if ($id == null) {
            redirect('index');
        }
    }

    function index() {
        $data = [
            'title' => 'Dashboard',
        ];
        $data['maincontent'] = $this->load->view('dashboard', $data, true);
        $this->load->view('mainpage', $data);
    }

    function admin_user() {
        $data = [
            'title' => 'Admin Information',
            'get_authorities' => $this->db->order_by('ts_id', 'asc')->where('type', 'admin')->get('teacher_students')->result(),
        ];
        $data['maincontent'] = $this->load->view('settings/access/index', $data, true);
        $this->load->view('mainpage', $data);
    }

    function create_user() {
        $data = [
            'title' => 'Create Admin User',
            'actNav' => 'teacher',
        ];
        $data['maincontent'] = $this->load->view('settings/access/add', $data, true);
        $this->load->view('mainpage', $data);
    }

    function save() {
        $lastidnumber = $this->db->select('id_no')->order_by('ts_id', 'desc')->where('type', 'admin')->get('teacher_students')->row();
        $resresult = explode('NUBA0', @$lastidnumber->id_no);
        if (empty(@$lastidnumber->id_no)) {
            $getresresult = "NUBA01";
        } else {
            $number_res = $resresult[1] + 1;
            $getresresult = 'NUBA0' . $number_res;
        }
        $data = [
            'id_no' => $getresresult,
            'name' => $this->input->post('name'),
            'contact' => $this->input->post('contact'),
            'email' => $this->input->post('email'),
            'department' => $this->input->post('department'),
            'first_reg_date' => date('Y-m-d'),
            'type' => 'admin',
            'password' => sha1($getresresult),
            'role' => 1,
            'status' => 1,
            'is_delete' => 1,
        ];
        $this->db->insert('teacher_students', $data);
        $this->session->set_flashdata('success', 'New Admin User Created Successfully');
        return redirect('admin_user');
    }

    public function manage_user_access($id, $value) {
        $message = $value == 1 ? 'Activated' : 'Deactivated';
        $this->db->where('ts_id', $id)->update('teacher_students', ['status' => $value]);
        $this->session->set_flashdata('success', "Login Status $message Successfully");
        return redirect('admin_user');
    }

    function edit_user_profile($id) {
        $data = [
            'title' => 'Edit User Information',
            'get_user' => $this->db->where('ts_id', $id)->get('teacher_students')->row(),
        ];
        $data['maincontent'] = $this->load->view('settings/access/edit', $data, true);
        $this->load->view('mainpage', $data);
    }

    function update() {
        $data_id = $this->input->post('data_id');
        $data = [
            'name' => $this->input->post('name'),
            'contact' => $this->input->post('contact'),
            'email' => $this->input->post('email'),
            'department' => $this->input->post('department'),
        ];
        $this->db->where('ts_id', $data_id)->update('teacher_students', $data);
        $this->session->set_flashdata('success', "User Info Updated Successfully");
        return redirect('admin_user');
    }

    function user_password_update() {
        $data_id = $this->input->post('data_id');
        $password = $this->input->post('password');
        $c_password = $this->input->post('c_password');

        if ($password != $c_password) {
            $this->session->set_flashdata('error', 'Password Dose Not Match');
            return redirect('edit_user_profile/' . $data_id);
        }
        $this->db->where('ts_id', $data_id)->update('teacher_students', [
            'password' => sha1($password)
        ]);
        $this->session->set_flashdata('success', 'Password Updated Successfully');
        return redirect('admin_user');
    }

    public function delete($id) {
        $result = $this->db->select(['photo', 'id_no'])->where('ts_id', $id)->get('teacher_students')->row();
        $urllink = 'public/user/' . $result->photo;
        if (file_exists($urllink)) {
            unlink($urllink);
        }
        $this->db->where('ts_id', $id)->delete('teacher_students');
        $this->session->set_flashdata('success', 'User Profile Deleted Successfully');
        return redirect('admin_user');
    }

    function settings() {
        $data = [
            'title' => 'System Settings',
        ];
        $data['maincontent'] = $this->load->view('settings/index', $data, true);
        $this->load->view('mainpage', $data);
    }

    function view_grades() {
        $data = [
            'title' => 'View Grades',
            'get_grades' => $this->db->get('grades')->result(),
        ];
        $data['maincontent'] = $this->load->view('settings/grades', $data, true);
        $this->load->view('mainpage', $data);
    }

    /*
     * ******************** Notification***********************
     */

    public function get_reg_notification() {
        $result = $this->db->where('is_approve', 0)->get('semester_reg_info')->num_rows();
        if ($result > 0) {
            echo $result;
        } else {
            echo '';
        }
    }

    public function get_result_notification() {
        $result = $this->db->where('approved_status', 0)->get('results')->num_rows();
        if ($result > 0) {
            echo $result;
        } else {
            echo '';
        }
    }

    function semesterregistrations() {
        $id = $sid = $this->input->get('id');
        $student_info = $this->db->where('ts_id', $id)->get('teacher_students')->row();
        $data = [
            'title' => 'Semester Registration of ' . $student_info->department . ' in ' . $student_info->program . ' Program By ' . $student_info->name . '(' . $student_info->id_no . ')',
            'student_id' => $id,
            'get_semester_session' => $this->db->select('session')->order_by('sem_sub_id', 'asc')->get('semester_subjects')->result(),
            'last_semreg_info' => $this->db->where('student_id', $id)->order_by('sem_reg_info_id', 'desc')->get('semester_reg_info')->row(),
            'semester_reg_info' => $this->db->where('student_id', $id)->get('semester_reg_info')->result(),
            'get_subjects' => $this->db->get('subjects')->result(),
        ];
        $data['maincontent'] = $this->load->view('student/semester', $data, true);
        $this->load->view('mainpage', $data);
    }

    function new_semester_registration() {
        $id = $sid = $this->input->get('id');
        $session = $sid = $this->input->get('session');
        $semester = $sid = $this->input->get('semester');
        $section = $sid = $this->input->get('section');
        $student_info = $this->db->where('ts_id', $id)->get('teacher_students')->row();
        $department = $student_info->department;
        $program = $student_info->program;
        $semester_subjects = $this->Universal_model->search_semester_wise_subjects($department, $program, $session, $semester, $section);
        if (count((array) $semester_subjects) == 0) {
            $this->session->set_flashdata('error', 'Results Not Found');
            return redirect('semester_registrations');
        }
        $data = [
            'title' => 'Semester Registration of ' . $student_info->department . ' in ' . $student_info->program . ' Program By ' . $student_info->name . '(' . $student_info->id_no . ')',
            'student_id' => $id,
            'student_info' => $student_info,
            'session' => $session,
            'semester' => $semester,
            'section' => $section,
            'semester_subjects' => $semester_subjects,
        ];
        $data['maincontent'] = $this->load->view('student/semester_reg', $data, true);
        $this->load->view('mainpage', $data);
    }

    function save_semester_registration() {
        $sid = $this->input->post('student_id');
        $department = $this->input->post('department');
        $session = $this->input->post('session');
        $program = $this->input->post('program');
        $semester_no = $this->input->post('semester');
        $section = $this->input->post('section');
        $tsacd_id = $this->input->post('tsacd_id');
        $total_credit = $this->input->post('total_credit_taken');

        if (count((array) $this->input->post('subject_id')) == 0) {
            $this->session->set_flashdata('error', 'Must be selected check box');
            return redirect("new_semester_registration?id=$sid&session=$session&semester=$semester_no&section=$section");
        }
        $semtresult = $this->db->where('student_id', $sid)->where('session', $session)->where('semester_no', $semester_no)->where('is_complete', 0)->get('semester_reg_info')->num_rows();
        if ($semtresult == 0) {
            $data = [
                'student_id' => $sid,
                'session' => $session,
                'semester_no' => $semester_no,
                'total_credit' => $total_credit,
                'reg_date' => date('Y-m-d'),
                'reg_month' => date('F-Y'),
                'is_approve' => 1,
                'approved_date' => date('Y-m-d'),
                'adviser_id' => $this->input->post('adviser_id'),
            ];
            $this->db->insert('semester_reg_info', $data);
            $last_id = $this->db->insert_id();
        } else {
            $last_dataid = $this->db->select('sem_reg_info_id')->where('student_id', $sid)->where('session', $session)->where('semester_no', $semester_no)->where('is_complete', 0)->get('semester_reg_info')->row();
            $last_id = $last_dataid->sem_reg_info_id;
        }

        foreach ((array) $this->input->post('subject_id') as $key => $value) {
            $subject_id = $this->input->post('subject_id')[$key];
            if (!empty($subject_id)) {
                $sbresult = $this->db
                        ->where('reg_info_id', $last_id)
                        ->where('student_id', $sid)
                        ->where('subject_id', $subject_id)
                        ->get('semester_registrations')
                        ->num_rows();
                if ($sbresult == 0) {
                    $regdata = [
                        'reg_info_id' => $last_id,
                        'student_id' => $sid,
                        'subject_id' => $subject_id,
                        'tsacd_id' => $tsacd_id,
                        'department' => $department,
                        'session' => $session,
                        'program' => $program,
                        'semester' => $semester_no,
                        'section' => $section,
                    ];
                    $this->db->insert('semester_registrations', $regdata);
                } else {
                    $this->session->set_flashdata('error', 'Same Duplicate Subject Not Supported In The Same Semester Registration!');
                    return redirect("new_semester_registration?id=$sid&session=$session&semester=$semester_no&section=$section");
                }
            }
        }
        $this->session->set_flashdata('success', 'Semester Registration Created Successfully');
        return redirect('semester_registrations');
    }

    function semester_registrations() {
        $data = [
            'title' => 'Semester Registration List',
            'semester_reg_info' => $this->Universal_model->get_semester_registration_students(),
            'get_students' => $this->db->where('type', 'student')->get('teacher_students')->result(),
        ];
        $data['maincontent'] = $this->load->view('admin/semester', $data, true);
        $this->load->view('mainpage', $data);
    }

    function view_semester_registration($id) {
        $data = [
            'title' => 'Approve Semester Registration',
            'semester_reg_info' => $this->Universal_model->get_semester_registration_byid($id),
            'registration_subjects' => $this->Universal_model->get_semester_registration_subject($id),
        ];
        $data['maincontent'] = $this->load->view('admin/approval', $data, true);
        $this->load->view('mainpage', $data);
    }

    function approved_semester_registration() {
        $sem_reg_info_id = $this->input->post('sem_reg_info_id');
        $data = [
            'is_approve' => $this->input->post('is_approve'),
            'approved_by' => $this->input->post('approved_by'),
            'approved_date' => date('Y-m-d'),
        ];
        $this->db->where('sem_reg_info_id', $sem_reg_info_id)->update('semester_reg_info', $data);

        foreach ((array) $this->input->post('sem_reg_id') as $key => $value) {
            $regdata = [
                'section' => $this->input->post('section')[$key],
            ];
            $this->db->where('sem_reg_id', $this->input->post('sem_reg_id')[$key])->update('semester_registrations', $regdata);
        }
        $this->session->set_flashdata('success', 'Semester Registration Approved Successfully');
        return redirect('semester_registrations');
    }

    function semester_result_information() {
        $data = [
            'title' => 'Semester Result Information',
            'result_information' => $this->Universal_model->get_semester_result_information(),
        ];
        $data['maincontent'] = $this->load->view('result/all_results', $data, true);
        $this->load->view('mainpage', $data);
    }

    function view_semester_result_information($id) {
        $data = [
            'title' => 'Semester Result Information',
            'ranscript' => $this->Universal_model->get_semester_result_information_byid($id),
        ];
        $data['maincontent'] = $this->load->view('result/approval_result', $data, true);
        $this->load->view('mainpage', $data);
    }

    function approved_semester_result_information() {
        $result_id = $this->input->post('result_id');
        $this->db->where('result_id', $result_id)->update('results', [
            'approved_status' => 1,
            'approved_by' => $this->session->userdata('user_id'),
        ]);
        $this->session->set_flashdata('success', 'Semester Result Approved Successfully');
        return redirect('semester_result_information');
    }

    function clear_specific_data() {
        $this->db->truncate('attendances');
        $this->db->truncate('results');
        $this->db->truncate('semester_registrations');
        $this->db->truncate('semester_reg_info');
        $this->db->truncate('semester_subjects');
        $this->db->truncate('semester_subject_list');
        $this->db->truncate('student_results');
        $this->db->truncate('subject_teachers');
        $this->db->truncate('teacher_student_acads');
        $this->db->where('ts_id !=', 10)->delete('teacher_students');

        $this->session->set_flashdata('success', 'Specific Data Cleared Successfully');
        return redirect('dashboard');
    }

}

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher extends CI_Controller {

    public $uid;

    public function __construct() {
        parent::__construct();
        $this->uid = $this->session->userdata('user_id');
        if ($this->uid == null) {
            redirect('index');
        }
    }

    function index() {
        $data = [
            'title' => 'Teacher List',
            'get_teachers' => $this->db->order_by('ts_id', 'asc')->where('type', 'teacher')->get('teacher_students')->result(),
        ];
        $data['maincontent'] = $this->load->view('teacher/index', $data, true);
        $this->load->view('mainpage', $data);
    }

    function add() {
        $data = [
            'title' => 'Add Teacher List',
            'actNav' => 'teacher',
        ];
        $data['maincontent'] = $this->load->view('teacher/add', $data, true);
        $this->load->view('mainpage', $data);
    }

    function save() {
        $lastidnumber = $this->db->select('id_no')->order_by('ts_id', 'desc')->where('type', 'teacher')->get('teacher_students')->row();

        if (empty(@$lastidnumber->id_no)) {
            $getresresult = "NUBT01";
        } else {
            $resresult = explode('NUBT0', @$lastidnumber->id_no);
            $number_res = $resresult[1] + 1;
            $getresresult = 'NUBT0' . $number_res;
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
            'type' => 'teacher',
            'password' => sha1($getresresult),
            'role' => 2,
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
        $this->session->set_flashdata('success', 'New Teacher Profile Created Successfully');
        return redirect('teacher_list');
    }

    function view($id) {
        $data = [
            'title' => 'View Teacher List',
            'user_avatar' => get_user_avatar_byid($id),
            'get_teacher' => $this->db->where('ts_id', $id)->get('teacher_students')->row(),
        ];
        $data['maincontent'] = $this->load->view('teacher/view', $data, true);
        $this->load->view('mainpage', $data);
    }

    function edit($id) {
        $data = [
            'title' => 'Edit Teacher List',
            'get_teacher' => $this->db->where('ts_id', $id)->get('teacher_students')->row(),
        ];
        $data['maincontent'] = $this->load->view('teacher/edit', $data, true);
        $this->load->view('mainpage', $data);
    }

    function update() {
        $data_id = $this->input->post('data_id');
        $uniq_id = $this->input->post('uniq_id');
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
        $this->db->where('uniq_id', $uniq_id)->update('teacher_student_acads', $acddata);
        $this->session->set_flashdata('success', "Teacher Info Updated Successfully");
        return redirect('teacher_list');
    }

    function user_access_update() {
        $data_id = $this->input->post('data_id');
        $status = $this->input->post('status');
        $message = $status == 1 ? 'Activated' : 'Inactivated';
        $this->db->where('ts_id', $data_id)->update('teacher_students', [
            'status' => $status,
        ]);
        $this->session->set_flashdata('success', "Teacher Access $message Successfully");
        return redirect('teacher_list');
    }

    function user_password_update() {
        $data_id = $this->input->post('data_id');
        $password = $this->input->post('password');
        $c_password = $this->input->post('c_password');

        if ($password != $c_password) {
            $this->session->set_flashdata('error', 'Password Dose Not Match');
            return redirect('edit_teacher_profile/' . $data_id);
        }

        $this->db->where('ts_id', $data_id)->update('teacher_students', [
            'password' => sha1($password)
        ]);
        $this->session->set_flashdata('success', 'Password Updated Successfully');
        return redirect('teacher_list');
    }

    public function delete($id) {
        $result = $this->db->select(['photo', 'id_no'])->where('ts_id', $id)->get('teacher_students')->row();
        $urllink = 'public/teacher/' . $result->photo;
        if (file_exists($urllink)) {
            unlink($urllink);
        }
        $this->db->where('ts_id', $id)->delete('teacher_students');
        $this->db->where('ts_id', $id)->delete('teacher_student_acads');
        $this->session->set_flashdata('success', 'Teacher Profile Deleted Successfully');
        return redirect('teacher_list');
    }

    function view_subject_students($id) {
        $subject_info = $this->db->join('subjects', 'subjects.sub_id = subject_teachers.subject_id')->where('subt_id', $id)->get('subject_teachers')->row();
        $data = [
            'title' => 'Subject Wise Student List',
            'subject_info' => $subject_info,
            'student_list' => $this->Universal_model->get_semester_registration_student($subject_info->subject_id),
        ];
        $data['maincontent'] = $this->load->view('teacher/student/view', $data, true);
        $this->load->view('mainpage', $data);
    }

    function upgrade_teacher_info() {
        $uniq_id = uniqid();
        $data_id = $this->input->post('data_id');
        $old_uniq_id = $this->input->post('old_uniq_id');

        $result = $this->db->select('result_published')->where('uniq_id', $old_uniq_id)->get('teacher_student_acads')->num_rows();
        if ($result->result_published == 0) {
            $this->session->set_flashdata('error', "The Semester Final Result Did Not published");
            return redirect('edit_teacher_profile/' . $data_id);
        }

        $this->db->where('ts_id', $data_id)->update('teacher_students', [
            'uniq_id' => $uniq_id,
        ]);

        $acddata = [
            'ts_id' => $data_id,
            'id_no' => $this->input->post('id_no'),
            'uniq_id' => $uniq_id,
            'session' => $this->input->post('session'),
            'year' => date('Y'),
            'semester' => $this->input->post('semester'),
            'section' => $this->input->post('section'),
            'reg_date' => date('Y-m-d'),
            'status' => 1,
        ];
        $this->db->insert('teacher_student_acads', $acddata);
        $this->session->set_flashdata('success', "Teacher Info Updated Successfully");
        return redirect('teacher_list');
    }

    /*     * ********************** Students  *********************** */

    public function advised_students() {
        $data = [
            'title' => 'Advising Students',
            'advised_registers' => $this->Universal_model->get_advised_register_students($this->uid),
        ];
        $data['maincontent'] = $this->load->view('teacher/advise/index', $data, true);
        $this->load->view('mainpage', $data);
    }

    function view_advising_students($id) {
        $data = [
            'title' => 'Advised Student',
            'semester_reg_info' => $this->Universal_model->get_semester_registration_byid($id),
            'registration_subjects' => $this->Universal_model->get_semester_registration_subject($id),
        ];
        $data['maincontent'] = $this->load->view('teacher/advise/advisefor', $data, true);
        $this->load->view('mainpage', $data);
    }

    public function subject_students() {
        $subject_students = $this->Universal_model->get_subject_wise_teachers($this->uid);
        $data = [
            'title' => 'Subject Wise Students',
            'subject_students' => $subject_students
        ];
        $data['maincontent'] = $this->load->view('teacher/student/index', $data, true);
        $this->load->view('mainpage', $data);
    }

    public function student_attendance() {
        $data = [
            'title' => 'Subject Wise Student Attendance',
            'get_subjects' => $this->Universal_model->get_subject_student_information($this->uid),
        ];
        $data['maincontent'] = $this->load->view('teacher/attend/index', $data, true);
        $this->load->view('mainpage', $data);
    }

    function get_student_attendance() {
        $id = $this->input->get('sub_id');
        $type = $this->input->get('type');
        $task = $this->input->get('task');
        $subject_teacher = $this->Universal_model->get_subject_information($id);

//        $result = $this->db
//                ->where('department', $subject_teacher->department)
//                ->where('session', $subject_teacher->session)
//                ->where('program', $subject_teacher->program)
//                ->where('semester', $subject_teacher->semester)
//                ->where('section', $subject_teacher->section)
//                ->where('result_type', $type)
//                ->get('results')
//                ->num_rows();
//
//        if ($result > 0) {
//            $this->session->set_flashdata('error', "Already Generated $type Result For This Subject");
//            return redirect('subject_result');
//        }

        $data = [
            'title' => 'Get Student Attendence of ' . $type,
            'subt_id' => $id,
            'type' => $type,
            'subject_teacher' => $subject_teacher,
        ];
        if ($task == 'add') {
            $data['maincontent'] = $this->load->view('teacher/attend/midfinal', $data, true);
        } else if ($task == 'edit') {
            $data['maincontent'] = $this->load->view('teacher/attend/edit_midfinal', $data, true);
        } else {
            $data['maincontent'] = $this->load->view('teacher/attend/view_midfinal', $data, true);
        }
        $this->load->view('mainpage', $data);
    }

    function make_student_attendance() {
        $subject_id = $this->input->post('subject_id');
        $section = $this->input->post('section');
        $result_type = $this->input->post('type');
        $sem_reg_id = $this->input->post('sem_reg_id');
        $present_date = $this->input->post('present_date');

        foreach ((array) $sem_reg_id as $key => $value) {
            $student_id = $this->input->post('student_id')[$key];
            $get_present = $this->input->post('get_present')[$key];
            $result_data = [
                'sem_reg_id' => $sem_reg_id[$key],
                'student_id' => $student_id,
                'teacher_id' => $this->uid,
                'subject_id' => $subject_id,
                'section' => $section,
                'present' => $get_present,
                'attend_type' => $result_type,
                'attend_date' => date('Y-m-d', strtotime($present_date)),
                'attend_month' => date('F-Y', strtotime($present_date)),
            ];
            $this->db->insert('attendances', $result_data);
        }
        $this->session->set_flashdata('success', "$result_type Semester Attendence Taken Successfully");
        return redirect('student_attendance');
    }

    function update_student_attendance() {
        $result_type = $this->input->post('type');
        $attend_id = $this->input->post('attend_id');
        foreach ((array) $attend_id as $key => $value) {
            $get_present = $this->input->post('get_present')[$key];
            $this->db->where('attend_id', $attend_id[$key])->update('attendances', [
                'present' => $get_present,
            ]);
        }
        $this->session->set_flashdata('success', "$result_type Semester Attendence Update Successfully");
        return redirect('student_attendance');
    }

    public function subject_result() {
        $data = [
            'title' => 'Make Subject Wise Student Result',
            'get_subjects' => $this->Universal_model->get_subject_student_information($this->uid),
        ];
        $data['maincontent'] = $this->load->view('teacher/subject/index', $data, true);
        $this->load->view('mainpage', $data);
    }

    function make_subject_result() {
        $id = $this->input->get('sub_id');
        $type = $this->input->get('type');
        $subject_teacher = $this->Universal_model->get_subject_information($id);

//        $result = $this->db
//                ->where('department', $subject_teacher->department)
//                ->where('session', $subject_teacher->session)
//                ->where('program', $subject_teacher->program)
//                ->where('semester', $subject_teacher->semester)
//                ->where('section', $subject_teacher->section)
//                ->where('result_type', $type)
//                ->get('results')
//                ->num_rows();
//
//        if ($result > 0) {
//            $this->session->set_flashdata('error', "Already Generated $type Result For This Subject");
//            return redirect('subject_result');
//        }

        $data = [
            'title' => 'Make Result Information of ' . $type,
            'subt_id' => $id,
            'type' => $type,
            'subject_teacher' => $subject_teacher,
        ];
        if ($type == 'Mid') {
            $data['maincontent'] = $this->load->view('teacher/result/midpage', $data, true);
        } else {
            $data['maincontent'] = $this->load->view('teacher/result/finalpage', $data, true);
        }
        $this->load->view('mainpage', $data);
    }

    function make_midfinal_semester_result() {
        $subject_id = $this->input->post('subject_id');
        $credit_hour = $this->input->post('credit_hour');
        $department = $this->input->post('department');
        $session = $this->input->post('session');
        $program = $this->input->post('program');
        $semester = $this->input->post('semester');
        $section = $this->input->post('section');
        $result_type = $this->input->post('type');
        $sem_reg_id = $this->input->post('sem_reg_id');

        foreach ((array) $sem_reg_id as $key => $value) {
            $sem_reg_id = $this->input->post('reg_info_id')[$key];
            $student_id = $this->input->post('student_id')[$key];
            $total_marks = $this->input->post('total_marks')[$key];
            $grand_total_mark = $this->input->post('grand_total_mark')[$key];
            $grade_info = get_grade_info($grand_total_mark);
            $ct = $this->input->post('ct')[$key];
            $mcq = $this->input->post('mcq')[$key];
            $cq = $this->input->post('cq')[$key];
            $attend = $this->input->post('attend')[$key];
            $letter = $grade_info['letter'];
            $point = $grade_info['point'];
            $cgpa = $credit_hour * $grade_info['point'];

            $result_data = [
                'sem_reg_id' => $sem_reg_id,
                'student_id' => $student_id,
                'department' => $department,
                'session' => $session,
                'program' => $program,
                'semester' => $semester,
                'section' => $section,
                'subject_id' => $subject_id,
                'ct' => $ct,
                'mcq' => $mcq,
                'cq' => $cq,
                'total' => $total_marks,
                'letter' => $letter,
                'point' => $point,
                'cgpa' => $cgpa,
                'result_type' => $result_type,
                'result_date' => date('Y-m-d'),
                'result_month' => date('F-Y'),
                'published_by' => $this->uid,
            ];
            $this->db->insert('results', $result_data);
            if ($result_type == 'Mid') {
                $sresdata = [
                    'sem_reg_id' => $sem_reg_id,
                    'student_id' => $student_id,
                    'department' => $department,
                    'session' => $session,
                    'program' => $program,
                    'semester' => $semester,
                    'section' => $section,
                    'subject_id' => $subject_id,
                ];
                $sresdata['mid_ct'] = $ct;
                $sresdata['mid_mcq'] = $mcq;
                $sresdata['mid_cq'] = $cq;
                $sresdata['mid_total'] = $total_marks;
                $sresdata['mid_letter'] = $letter;
                $sresdata['mid_point'] = $point;
                $sresdata['mid_cgpa'] = $cgpa;
                $sresdata['mid_date'] = date('Y-m-d');
                $sresdata['mid_month'] = date('F-Y');
                $sresdata['published_by'] = $this->uid;
                $this->db->insert('student_results', $sresdata);
                $this->db->where('sem_reg_info_id', $sem_reg_id)->update('semester_reg_info', [
                    'is_midd' => 1
                ]);
            } else {
                $finaldata['final_ct'] = $ct;
                $finaldata['final_mcq'] = $mcq;
                $finaldata['final_cq'] = $cq;
                $finaldata['final_attend'] = $attend;
                $finaldata['final_total'] = $total_marks;
                $finaldata['final_letter'] = $letter;
                $finaldata['final_point'] = $point;
                $finaldata['final_cgpa'] = $cgpa;
                $finaldata['grand_total_mark'] = $grand_total_mark;
                $finaldata['final_date'] = date('Y-m-d');
                $finaldata['final_month'] = date('F-Y');
                $finaldata['result_type'] = 'All';
                $this->db->where('sem_reg_id', $sem_reg_id)->update('student_results', $finaldata);
                $this->db->where('sem_reg_info_id', $sem_reg_id)->update('semester_reg_info', [
                    'is_final' => 1,
                ]);
            }
        }

        $this->session->set_flashdata('success', "$result_type Semester Result Published Successfully");
        return redirect('subject_result');
    }

    public function view_result() {
        $data = [
            'title' => 'View Results',
            'get_subjects' => $this->Universal_model->get_subject_student_information($this->uid),
        ];
        $data['maincontent'] = $this->load->view('teacher/result/view', $data, true);
        $this->load->view('mainpage', $data);
    }

    function search_student_result() {
        $department = $this->input->get('department');
        $program = $this->input->get('program');
        $session = $this->input->get('session');
        $semester = $this->input->get('semester');
        $section = $this->input->get('section');
        $type = $this->input->get('type');

        $data = [
            'title' => 'View Result',
            'department' => $department,
            'program' => $program,
            'session' => $session,
            'semester' => $semester,
            'section' => $section,
            'type' => $type,
        ];

        if ($type == 'All') {
            $data['results'] = $this->Universal_model->get_all_student_results($department, $program, $session, $semester, $section, $this->uid);
            $data['maincontent'] = $this->load->view('teacher/result/all_result', $data, true);
        } else {
            $data['results'] = $this->Universal_model->get_student_result_bytype($department, $program, $session, $semester, $section, $type, $this->uid);
            $data['maincontent'] = $this->load->view('teacher/result/midfinal_result', $data, true);
        }
        $this->load->view('mainpage', $data);
    }

}

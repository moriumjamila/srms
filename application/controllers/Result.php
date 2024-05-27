<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Result extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $id = $this->session->userdata('user_id');
        if ($id == null) {
            redirect('index');
        }
    }

    function index() {
        $results = $this->Universal_model->all_student_result_info();
        $data = [
            'title' => 'Result Information',
            'results' => $results
        ];
        $data['maincontent'] = $this->load->view('result/index', $data, true);
        $this->load->view('mainpage', $data);
    }

    function make_semester_result() {
        if ($this->input->get('submit')) {
            $department = $this->input->get('department');
            $program = $this->input->get('program');
            $session = $this->input->get('session');
            $semester = $this->input->get('semester');
            $type = $this->input->get('type');
            $results = $this->Universal_model->get_register_students($department, $program, $session, $semester);

            $sdata = array(
                'get_department' => $department,
                'get_program' => $program,
                'get_session' => $session,
                'get_semester' => $semester,
                'get_type' => $type,
            );
            $this->session->set_userdata($sdata);
        } else {
            $department = '';
            $program = '';
            $session = '';
            $semester = '';
            $type = '';
            $results = [];
        }

        $data = [
            'title' => 'Make Result',
            'results' => $results,
        ];
        $data['maincontent'] = $this->load->view('result/add', $data, true);
        $this->load->view('mainpage', $data);
    }

    function make_student_result($id) {
        $semester_reg_info = $this->Universal_model->get_semester_registration_byid($id);
        $get_subjects = $this->Universal_model->get_semester_registration_subject($id);
        $get_type = $this->session->userdata('get_type');
        $data = [
            'title' => 'Make Result Information of ' . $get_type,
            'semester_reg_info' => $semester_reg_info,
            'get_subjects' => $get_subjects,
        ];
        $data['maincontent'] = $this->load->view('result/' . $get_type, $data, true);
        $this->load->view('mainpage', $data);
    }

    function make_mid_semester_result() {
        $sem_reg_info_id = $this->input->post('sem_reg_info_id');
        $student_id = $this->input->post('student_id');
        $avg_marks = $this->input->post('avg_marks');
        $session_name = $this->input->post('session_name');
        $avg_grade_info = get_grade_info($avg_marks);

        $datainfo = [
            'sem_reg_id' => $sem_reg_info_id,
            'student_id' => $student_id,
            'session_name' => $session_name,
            'midavg_score' => $avg_marks,
            'midletter' => $avg_grade_info['letter'],
            'midpoint' => $avg_grade_info['point'],
        ];
        $this->db->insert('student_result_info', $datainfo);
        $last_id = $this->db->insert_id();

        $sem_reg_id = $this->input->post('sem_reg_id');

        foreach ((array) $sem_reg_id as $key => $value) {
            $credit_hour = $this->input->post('credit_hour')[$key];
            $total_mid_marks = $this->input->post('total_mid_marks')[$key];
            $grade_info = get_grade_info($total_mid_marks);

            $result_data = [
                'result_id' => $last_id,
                'sem_reg_id' => $sem_reg_info_id,
                'student_id' => $student_id,
                'subject_id' => $this->input->post('subject_id')[$key],
                'mid_ct' => $this->input->post('mid_ct')[$key],
                'mid_mcq' => $this->input->post('mid_mcq')[$key],
                'mid_cq' => $this->input->post('mid_cq')[$key],
                'mid_attend' => $this->input->post('mid_attend')[$key],
                'mid_total' => $total_mid_marks,
                'mid_letter' => $grade_info['letter'],
                'mid_point' => $grade_info['point'],
            ];
            $this->db->insert('student_results', $result_data);
            $this->db->where('sem_reg_id', $sem_reg_id[$key])->update('semester_registrations', [
                'sessionname' => $session_name,
                'letter_grade' => $grade_info['letter'],
                'grade_point' => $grade_info['point'],
                'tgp' => $credit_hour * $grade_info['point'],
                'result_for' => 'Mid',
            ]);
        }
        $this->db->where('sem_reg_info_id', $sem_reg_info_id)->update('semester_reg_info', [
            'is_midd' => 1
        ]);
        $this->session->unset_userdata('get_department');
        $this->session->unset_userdata('get_program');
        $this->session->unset_userdata('get_session');
        $this->session->unset_userdata('get_semester');
        $this->session->unset_userdata('get_type');

        $this->session->set_flashdata('success', "Mid Semester Result Published Successfully");
        return redirect('result_information');
    }

    function make_final_semester_result() {
        $sem_reg_info_id = $this->input->post('sem_reg_info_id');
        $student_id = $this->input->post('student_id');
        $avg_marks = $this->input->post('avg_marks');
        $avg_grade_info = get_grade_info($avg_marks);
        $this->db->where('sem_reg_id', $sem_reg_info_id)->update('student_result_info', [
            'finalavg_score' => $avg_marks,
            'finalletter' => $avg_grade_info['letter'],
            'finalpoint' => $avg_grade_info['point'],
        ]);

        $sem_reg_id = $this->input->post('sem_reg_id');

        foreach ((array) $sem_reg_id as $key => $value) {
            $credit_hour = $this->input->post('credit_hour')[$key];
            $total_final_marks = $this->input->post('total_final_marks')[$key];
            $grade_info = get_grade_info($total_final_marks);

            $this->db->where('sem_reg_id', $sem_reg_info_id)->update('student_results', [
                'subject_id' => $this->input->post('subject_id')[$key],
                'final_ct' => $this->input->post('final_ct')[$key],
                'final_mcq' => $this->input->post('final_mcq')[$key],
                'final_cq' => $this->input->post('final_cq')[$key],
                'final_attend' => $this->input->post('final_attend')[$key],
                'final_total' => $total_final_marks,
                'final_letter' => $grade_info['letter'],
                'final_point' => $grade_info['point'],
            ]);
            $this->db->where('sem_reg_id', $sem_reg_id[$key])->update('semester_registrations', [
                'letter_grade' => $grade_info['letter'],
                'grade_point' => $grade_info['point'],
                'tgp' => $credit_hour * $grade_info['point'],
                'result_for' => 'Final',
            ]);
        }
        $this->db->where('sem_reg_info_id', $sem_reg_info_id)->update('semester_reg_info', [
            'is_final' => 1,
            'is_complete' => 1
        ]);
        $this->session->unset_userdata('get_department');
        $this->session->unset_userdata('get_program');
        $this->session->unset_userdata('get_session');
        $this->session->unset_userdata('get_semester');
        $this->session->unset_userdata('get_type');

        $this->session->set_flashdata('success', "Final Semester Result Published Successfully");
        return redirect('result_information');
    }

    function view_result_status_information($id, $sid) {
        $session = $this->input->post('session');
        if ($session) {
            $session_name = $session;
            $session_value = $this->db->where('session_name', $session)->where('student_id', $sid)->get('student_result_info')->num_rows();
            $session_wise_result = $this->db->select('*')
                    ->join('subjects', 'subjects.sub_id = semester_registrations.subject_id')
                    ->where('student_id', $this->id)
                    ->where('sessionname', $session)
                    ->get('semester_registrations')
                    ->result();
        } else {
            $session_value = 0;
            $session_name = '';
            $session_wise_result = [];
        }
        $data = [
            'title' => 'Result Information',
            'session_name' => $session_name,
            'session_value' => $session_value,
            'session_wise_result' => $session_wise_result,
            'academic_ranscripts' => $this->db->join('subjects', 'subjects.sub_id = semester_registrations.subject_id')->where('student_id', $sid)->get('semester_registrations')->result(),
            'student_result_info' => $this->db->select(['session_name', 'student_id'])->where('student_id', $sid)->order_by('stu_result_id', 'desc')->get('student_result_info')->result(),
        ];
        $data['maincontent'] = $this->load->view('result/marksheet', $data, true);
        $this->load->view('mainpage', $data);
    }

}

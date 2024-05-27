<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Subjct extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $id = $this->session->userdata('user_id');
        if ($id == null) {
            redirect('index');
        }
    }

    function index() {
        $data = [
            'title' => 'Manage Subjects',
            'get_subjects' => $this->db->get('subjects')->result(),
        ];
        $data['maincontent'] = $this->load->view('settings/subject/index', $data, true);
        $this->load->view('mainpage', $data);
    }

    function save() {
        $data = [
            'course_code' => $this->input->post('course_code'),
            'course_title' => $this->input->post('course_title'),
            'credit_hour' => $this->input->post('credit_hour'),
        ];
        $this->db->insert('subjects', $data);
        $this->session->set_flashdata('success', 'New Subejct Added Successfully');
        return redirect('manage_subjcts');
    }

    function update() {
        $id = $this->input->post('data_id');
        $data = [
            'course_code' => $this->input->post('course_code'),
            'course_title' => $this->input->post('course_title'),
            'credit_hour' => $this->input->post('credit_hour'),
        ];
        $this->db->where('sub_id', $id)->update('subjects', $data);
        $this->session->set_flashdata('success', 'Subejct Updated Successfully');
        return redirect('manage_subjcts');
    }

    public function delete($id) {
        $result = $this->db->where('subject_id', $id)->get('semester_registrations')->num_rows();
        if ($result > 0) {
            $this->session->set_flashdata('error', 'Already Assigned This Subject, Can Not Delete!');
            return redirect('manage_subjcts');
        }
        $this->db->where('sub_id', $id)->delete('subjects');
        $this->session->set_flashdata('success', 'Subejct Deleted Successfully');
        return redirect('manage_subjcts');
    }

    /*     * ******************** Subject Teachers ************************** */

    function semester_subjects() {
        $data = [
            'title' => 'Manage Semester Wise Subjects',
            'get_semester_subjects' => $this->db->order_by('sem_sub_id', 'asc')->get('semester_subjects')->result(),
        ];
        $data['maincontent'] = $this->load->view('subject/index', $data, true);
        $this->load->view('mainpage', $data);
    }

    function add_semester_subjects() {
        $data = [
            'title' => 'Add Semester Wise Subjects',
            'get_subjects' => $this->db->get('subjects')->result(),
        ];
        $data['maincontent'] = $this->load->view('subject/add', $data, true);
        $this->load->view('mainpage', $data);
    }

    function save_semester_subjects() {
        $department = $this->input->post('department');
        $program = $this->input->post('program');
        $session = $this->input->post('session');
        $semester = $this->input->post('semester');

        $result = $this->db->select('sem_sub_id')
                ->where('department', $department)
                ->where('program', $program)
                ->where('session', $session)
                ->where('semester', $semester)
                ->get('semester_subjects')
                ->row();

        if (count((array) $result->sem_sub_id) > 0) {
            $last_id = $result->sem_sub_id;
        } else {
            $data = [
                'department' => $department,
                'program' => $program,
                'session' => $session,
                'semester' => $semester,
            ];
            $this->db->insert('semester_subjects', $data);
            $last_id = $this->db->insert_id();
        }

        foreach ($this->input->post('subject_id') as $key => $value) {
            $subject_id = $this->input->post('subject_id')[$key];
            $section = $this->input->post('section')[$key];
            if (!empty($subject_id)) {
                $result = $this->db->where('subject_id', $subject_id)->where('section', $section)->get('semester_subject_list')->num_rows();
                if ($result > 0) {
                    $this->session->set_flashdata('error', 'Same Duplicate Subject Not Supported In The Same Section!');
                    return redirect('semester_subjects');
                }
                $data = [
                    'sem_sbject_id' => $last_id,
                    'sub_department' => $department,
                    'sub_program' => $program,
                    'sub_session' => $session,
                    'sub_semester' => $semester,
                    'subject_id' => $subject_id,
                    'section' => $section,
                ];
                $this->db->insert('semester_subject_list', $data);
            }
        }
        $this->session->set_flashdata('success', 'Semester Wise Subejct Saved Successfully');
        return redirect('semester_subjects');
    }

    function view_semester_subjects($id) {
        $data = [
            'title' => 'Semester Wise Subjects',
            'get_semester' => $this->db->where('sem_sub_id', $id)->get('semester_subjects')->row(),
        ];
        $data['maincontent'] = $this->load->view('subject/view', $data, true);
        $this->load->view('mainpage', $data);
    }

    function edit_semester_subjects($id) {
        $data = [
            'title' => 'Edit Semester Subjects',
            'get_subjects' => $this->db->get('subjects')->result(),
            'get_semester' => $this->db->where('sem_sub_id', $id)->get('semester_subjects')->row(),
            'semester_subjects' => $this->db->join('subjects', 'subjects.sub_id = semester_subject_list.subject_id')->where('sem_sbject_id', $id)->get('semester_subject_list')->result(),
        ];
        $data['maincontent'] = $this->load->view('subject/edit', $data, true);
        $this->load->view('mainpage', $data);
    }

    function update_semester_subjects() {
        $sem_sub_id = $this->input->post('sem_sub_id');
        $this->db->where('sem_sbject_id', $sem_sub_id)->delete('semester_subject_list');

        foreach ($this->input->post('subject_id') as $key => $value) {
            $data = [
                'sem_sbject_id' => $sem_sub_id,
                'subject_id' => $this->input->post('subject_id')[$key],
                'section' => $this->input->post('section')[$key],
            ];
            $this->db->insert('semester_subject_list', $data);
        }
        $this->session->set_flashdata('success', 'Semester Wise Subejct Updated Successfully');
        return redirect('semester_subjects');
    }

    /*     * ******************** Subject Teachers ************************** */

    function subject_teachers() {
        $data = [
            'title' => 'Assign Subject Wise Teacher',
            'get_semesters' => $this->db->order_by('sem_sub_id', 'asc')->get('semester_subjects')->result(),
        ];
        $data['maincontent'] = $this->load->view('subject/assign_teacher', $data, true);
        $this->load->view('mainpage', $data);
    }

    function assign_subject_wise_teacher($id) {
        $data = [
            'title' => 'Semester Wise Subjects',
            'get_semester' => $this->db->where('sem_sub_id', $id)->get('semester_subjects')->row(),
        ];
        $data['maincontent'] = $this->load->view('subject/assign_subjects', $data, true);
        $this->load->view('mainpage', $data);
    }

    function subject_teacher() {
        foreach ($this->input->post('teacher_id') as $key => $value) {
            $subject_id = $this->input->post('subject_id')[$key];
            $teacher_id = $this->input->post('teacher_id')[$key];
            if (!empty($teacher_id)) {
                $result = $this->db->where('subject_id', $subject_id)->where('teacher_id', $teacher_id)->get('subject_teachers')->num_rows();
                if ($result > 0) {
                    $this->session->set_flashdata('error', 'Same Duplicate Teacher Not Supported In The Same Subject!');
                    return redirect('subject_teachers');
                }
                $data = [
                    'subject_id' => $subject_id,
                    'teacher_id' => $teacher_id,
                    'department' => $this->input->post('department'),
                    'session' => $this->input->post('session'),
                    'program' => $this->input->post('program'),
                    'semester' => $this->input->post('semester'),
                    'section' => $this->input->post('section')[$key],
                    'assign_from' => $this->input->post('assign_from'),
                ];
                $this->db->insert('subject_teachers', $data);
            }
        }
        $this->session->set_flashdata('success', 'New Teacher Assigned Successfully');
        return redirect('subject_teachers');
    }

    function view_subject_wise_teachers($id) {
        $data = [
            'title' => "Semester Wise Subject's Teacher",
            'get_semester' => $this->db->where('sem_sub_id', $id)->get('semester_subjects')->row(),
        ];
        $data['maincontent'] = $this->load->view('subject/view_teachers', $data, true);
        $this->load->view('mainpage', $data);
    }

    function edit_subject_wise_teachers($id) {

        $data = [
            'title' => "Edit Semester Wise Subject's Teacher",
            'data_id' => $id,
            'get_semester' => $this->db->where('sem_sub_id', $id)->get('semester_subjects')->row(),
            'subject_teachers' => $this->Universal_model->get_semester_subject_wise_teachers($id)
        ];
        $data['maincontent'] = $this->load->view('subject/edit_teachers', $data, true);
        $this->load->view('mainpage', $data);
    }

    function delete_subject_teacher($id, $redid) {
        $this->db->where('subt_id', $id)->delete('subject_teachers');
        $this->session->set_flashdata('success', 'Subject Wise Teacher Deleted Successfully');
        return redirect('view_subject_wise_teachers/' . $redid);
    }

}

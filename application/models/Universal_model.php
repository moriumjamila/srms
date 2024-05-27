<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Universal_model extends CI_Model {

    public function get_teacher_profile_byid($id) {
        $this->db->select("*");
        $this->db->from("teachers");
        $this->db->where("id", $id);
        return $this->db->get()->row();
    }

    public function get_semester_registration_students() {
        $result = $this->db->select("*")
                        ->join('teacher_students', 'teacher_students.ts_id = semester_reg_info.student_id')
                        ->from("semester_reg_info")
                        ->order_by('ts_id', 'desc')
                        ->get()->result();
        return $result;
    }

    public function get_semester_registration_byid($id) {
        $result = $this->db->select("*")
                        ->join('teacher_students', 'teacher_students.ts_id = semester_reg_info.student_id')
                        ->from("semester_reg_info")
                        ->where('sem_reg_info_id', $id)
                        ->get()->row();
        return $result;
    }

    public function get_semester_registration_subject($id) {
        $result = $this->db->select("*")
                        ->join('subjects', 'subjects.sub_id = semester_registrations.subject_id')
                        ->from("semester_registrations")
                        ->where('reg_info_id', $id)
                        ->get()->result();
        return $result;
    }

    public function semester_registration_subject() {
        $result = $this->db->select("*")
                        ->join('subjects', 'subjects.sub_id = semester_registrations.subject_id')
                        ->from("semester_registrations")
                        ->get()->result();
        return $result;
    }

    public function get_semester_registration_student($id) {
        $result = $this->db->select("*")
                        ->join('teacher_students', 'teacher_students.ts_id = semester_registrations.student_id')
                        ->from("semester_registrations")
                        ->where('semester_registrations.subject_id', $id)
                        ->get()->result();
        return $result;
    }

    public function get_subject_wise_teachers($id) {
        $result = $this->db->select("*")
                        ->join('subjects', 'subjects.sub_id = subject_teachers.subject_id')
                        ->from("subject_teachers")
                        ->where('teacher_id', $id)
                        ->get()->result();
        return $result;
    }

    public function get_advisor_info($id) {
        $result = $this->db->select(['name', 'contact'])
                        ->join('teacher_students', 'teacher_students.ts_id = semester_reg_info.student_id')
                        ->from("semester_reg_info")
                        ->where('sem_reg_info_id', $id)
                        ->get()->row();
        return $result;
    }

    public function get_advised_register_students($id) {
        $result = $this->db->select("*")
                        ->join('teacher_students', 'teacher_students.ts_id = semester_reg_info.student_id')
                        ->from("semester_reg_info")
                        ->order_by('ts_id', 'desc')
                        ->where('adviser_id', $id)
                        ->get()->result();
        return $result;
    }

    public function get_register_students($department, $program, $session, $semester) {
        $result = $this->db->select("*")
                        ->join('teacher_students', 'teacher_students.ts_id = semester_reg_info.student_id')
                        ->from("semester_reg_info")
                        ->where('department', $department)
                        ->where('program', $program)
                        ->where('session', $session)
                        ->where('semester_no', $semester)
                        ->get()->result();
        return $result;
    }

    public function all_student_result_info() {
        $result = $this->db->select("*")
                        ->join('semester_reg_info', 'semester_reg_info.sem_reg_info_id = student_result_info.sem_reg_id')
                        ->join('teacher_students', 'teacher_students.ts_id = student_result_info.student_id')
                        ->from("student_result_info")
                        ->get()->result();
        return $result;
    }

    public function all_student_result_info_byid($id) {
        $result = $this->db->select("*")
                        ->join('semester_reg_info', 'semester_reg_info.sem_reg_info_id = student_result_info.sem_reg_id')
                        ->join('teacher_students', 'teacher_students.ts_id = student_result_info.student_id')
                        ->from("student_result_info")
                        ->where('stu_result_id', $id)
                        ->get()->row();
        return $result;
    }

    public function get_student_result_information($id) {
        $result = $this->db->select("*")
                        ->join('semester_reg_info', 'semester_reg_info.sem_reg_info_id = student_result_info.sem_reg_id')
                        ->join('teacher_students', 'teacher_students.ts_id = student_result_info.student_id')
                        ->from("student_result_info")
                        ->where('result_id', $id)
                        ->get()->result();
        return $result;
    }

    public function get_subject_student_information($id) {
        $result = $this->db->select("*")
                        ->join('subjects', 'subjects.sub_id = subject_teachers.subject_id')
                        ->from("subject_teachers")
                        ->where('teacher_id', $id)
                        ->get()->result();
        return $result;
    }

    public function get_subject_information($id) {
        $result = $this->db->select("*")
                        ->join('subjects', 'subjects.sub_id = subject_teachers.subject_id')
                        ->from("subject_teachers")
                        ->where('subt_id', $id)
                        ->get()->row();
        return $result;
    }

    public function get_student_result_bytype($department, $program, $session, $semester, $section, $type, $byid) {
        $results = $this->db->select('r.*, 
                              ts.id_no as student_no, 
                              ts.name as student_name, 
                              s.course_code as subject_code, 
                              s.course_title as subject_title, 
                              s.credit_hour as subject_credit')
                ->from('results as r')
                ->join('teacher_students as ts', 'ts.ts_id = r.student_id')
                ->join('subjects as s', 's.sub_id = r.subject_id')
                ->where('r.department', $department)
                ->where('r.program', $program)
                ->where('r.session', $session)
                ->where('r.semester', $semester)
                ->where('r.section', $section)
                ->where('r.result_type', $type)
                ->where('r.published_by', $byid)
                ->get()
                ->result();

        return $results;
    }

    public function get_all_student_results($department, $program, $session, $semester, $section, $byid) {
        $results = $this->db->select('r.*, 
                              ts.id_no as student_no, 
                              ts.name as student_name, 
                              s.course_code as subject_code, 
                              s.course_title as subject_title, 
                              s.credit_hour as subject_credit')
                ->from('results as r')
                ->join('teacher_students as ts', 'ts.ts_id = r.student_id')
                ->join('subjects as s', 's.sub_id = r.subject_id')
                ->where('r.department', $department)
                ->where('r.program', $program)
                ->where('r.session', $session)
                ->where('r.semester', $semester)
                ->where('r.section', $section)
                ->where('r.published_by', $byid)
                ->get()
                ->result();

        return $results;
    }

    public function get_semester_result_information() {
        $results = $this->db->select('r.*, 
                              ts.id_no as student_no, 
                              ts.name as student_name, 
                              s.course_code as subject_code, 
                              s.course_title as subject_title, 
                              s.credit_hour as subject_credit')
                ->from('results as r')
                ->join('teacher_students as ts', 'ts.ts_id = r.student_id')
                ->join('subjects as s', 's.sub_id = r.subject_id')
                ->get()
                ->result();
        return $results;
    }

    public function get_semester_result_information_byid($id) {
        $results = $this->db->select('r.*, 
                              ts.id_no as student_no, 
                              ts.name as student_name, 
                              s.course_code as subject_code, 
                              s.course_title as subject_title, 
                              s.credit_hour as subject_credit')
                ->from('results as r')
                ->join('teacher_students as ts', 'ts.ts_id = r.student_id')
                ->join('subjects as s', 's.sub_id = r.subject_id')
                ->where('r.result_id', $id)
                ->get()
                ->row();
        return $results;
    }

    public function get_student_result_information_bydata($session, $type, $byid) {
        $results = $this->db->select('r.*, 
                              ts.id_no as student_no, 
                              ts.name as student_name, 
                              s.course_code as subject_code, 
                              s.course_title as subject_title, 
                              s.credit_hour as subject_credit')
                ->from('results as r')
                ->join('teacher_students as ts', 'ts.ts_id = r.student_id')
                ->join('subjects as s', 's.sub_id = r.subject_id')
                ->where('r.session', $session)
                ->where('r.result_type', $type)
                ->where('r.student_id', $byid)
                ->get()
                ->result();
        return $results;
    }

    public function get_semester_wise_subject($id, $section) {
        $result = $this->db->select("*")
                        ->join('subjects', 'subjects.sub_id = semester_subject_list.subject_id')
                        ->from("semester_subject_list")
                        ->where('sem_sbject_id', $id)
                        ->where('section', $section)
                        ->get()->result();
        return $result;
    }

    public function get_semester_wise_subject_and_teacher($sid, $did) {
        $result = $this->db->select('ts.name')
                ->distinct()
                ->from('subject_teachers as st')
                ->join('teacher_students as ts', 'ts.ts_id = st.teacher_id')
                ->where('st.subject_id', $sid)
                ->where('st.assign_from', $did)
                ->get()
                ->result();
        return $result;
    }

    public function get_semester_subject_wise_teachers($id) {
        $result = $this->db->select("*")
                        ->join('subjects', 'subjects.sub_id = subject_teachers.subject_id')
                        ->join('teacher_students', 'teacher_students.ts_id = subject_teachers.teacher_id')
                        ->from("subject_teachers")
                        ->where('assign_from', $id)
                        ->get()->result();
        return $result;
    }

    public function search_semester_wise_subjects($department, $program, $session, $semester, $section) {
        $results = $this->db->select('sst.*, 
                              s.course_code, 
                              s.course_title, 
                              s.credit_hour')
                ->from('semester_subject_list as sst')
                ->join('subjects as s', 's.sub_id = sst.subject_id')
                ->where('sst.sub_department', $department)
                ->where('sst.sub_program', $program)
                ->where('sst.sub_session', $session)
                ->where('sst.sub_semester', $semester)
                ->where('sst.section', $section)
                ->where('sst.status', 1)
                ->get()
                ->result();
        return $results;
    }

}

?>

<?php

defined('BASEPATH') or exit('No direct script access allowed');

function get_user_avatar() {
    $ci = & get_instance();
    $uid = $ci->session->userdata('user_id');
    $result = $ci->db->select('photo')->where('ts_id', $uid)->get('teacher_students')->row();
    if (empty($result->photo)) {
        $image = 'public/img/alter_user.png';
    } else {
        $image = $result->photo;
    }
    return $image;
}

function get_user_avatar_byid($uid) {
    $ci = & get_instance();
    $result = $ci->db->select('photo')->where('ts_id', $uid)->get('teacher_students')->row();
    if (empty($result->photo)) {
        $image = 'public/img/alter_user.png';
    } else {
        $image = $result->photo;
    }
    return $image;
}

function get_departments() {
    $ci = &get_instance();
    $results = $ci->db->get('departments')->result();
    return $results;
}

function get_programs() {
    $ci = &get_instance();
    $results = $ci->db->get('programs')->result();
    return $results;
}

function get_semesters() {
    $ci = &get_instance();
    $results = $ci->db->get('semesters')->result();
    return $results;
}

function get_sessions() {
    $ci = &get_instance();
    $results = $ci->db->get('sessions')->result();
    return $results;
}

function get_sections() {
    $ci = &get_instance();
    $results = $ci->db->get('sections')->result();
    return $results;
}

function get_grades() {
    $ci = &get_instance();
    $results = $ci->db->get('grades')->result();
    return $results;
}

function get_teachers() {
    $ci = &get_instance();
    $results = $ci->db->where('type', 'teacher')->get('teacher_students')->result();
    return $results;
}

function get_grade_info($score) {
    if ($score >= 80 && $score <= 100) {
        return ['letter' => 'A+', 'point' => 4.0];
    } else if ($score >= 75 && $score <= 79) {
        return ['letter' => 'A', 'point' => 4.0];
    } else if ($score >= 70 && $score <= 74) {
        return ['letter' => 'A-', 'point' => 3.7];
    } else if ($score >= 65 && $score <= 69) {
        return ['letter' => 'B+', 'point' => 3.3];
    } else if ($score >= 60 && $score <= 64) {
        return ['letter' => 'B', 'point' => 3.0];
    } else if ($score >= 55 && $score <= 59) {
        return ['letter' => 'B-', 'point' => 2.7];
    } else if ($score >= 50 && $score <= 54) {
        return ['letter' => 'C+', 'point' => 2.3];
    } else if ($score >= 45 && $score <= 49) {
        return ['letter' => 'C', 'point' => 2.0];
    } else if ($score >= 40 && $score <= 44) {
        return ['letter' => 'D', 'point' => 1.0];
    } else {
        return ['letter' => 'F', 'point' => 0.0];
    }
}

function dd($data) {
    echo '<pre>';
    print_r($data);
    die;
}

function ddp($data) {
    echo '<pre>';
    print_r($data);
}

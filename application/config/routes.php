<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Login';
$route['index'] = 'Login/login_page';
$route['authenticateuser'] = 'Login/authenticateuser';

//Admin Routes
$route['dashboard'] = 'Admin';
$route['admin_user'] = 'Admin/admin_user';
$route['create_admin_user'] = 'Admin/create_user';
$route['edit_user_profile/(:any)'] = 'Admin/edit_user_profile/$1';
$route['delete_user_profile/(:any)'] = 'Admin/delete/$1';
$route['semester_registration'] = 'Admin/semesterregistrations';
$route['new_semester_registration'] = 'Admin/new_semester_registration';
//Notification
$route['semester_registrations'] = 'Admin/semester_registrations';
$route['view_semester_registration/(:any)'] = 'Admin/view_semester_registration/$1';
$route['semester_result_information'] = 'Admin/semester_result_information';
$route['view_semester_result_information/(:any)'] = 'Admin/view_semester_result_information/$1';

//Settings Routes
$route['settings'] = 'Admin/settings';
$route['view_grades'] = 'Admin/view_grades';
//Departments Route
$route['manage_departments'] = 'Department';
//Programs Route
$route['manage_programs'] = 'Program';
//Sessions Route
$route['manage_sessions'] = 'Sessionctr';
//Subject Routes
$route['manage_subjcts'] = 'Subjct';
$route['subject_teachers'] = 'Subjct/subject_teachers';
$route['assign_subject_wise_teacher/(:any)'] = 'Subjct/assign_subject_wise_teacher/$1';
$route['view_subject_wise_teachers/(:any)'] = 'Subjct/view_subject_wise_teachers/$1';
$route['edit_assign_teacher/(:any)'] = 'Subjct/edit_assign_teacher/$1';
$route['edit_subject_wise_teachers/(:any)'] = 'Subjct/edit_subject_wise_teachers/$1';
$route['semester_subjects'] = 'Subjct/semester_subjects';
$route['add_semester_subjects'] = 'Subjct/add_semester_subjects';
$route['save_semester_subjects'] = 'Subjct/save_semester_subjects';
$route['view_semester_subjects/(:any)'] = 'Subjct/view_semester_subjects/$1';
$route['edit_semester_subjects/(:any)'] = 'Subjct/edit_semester_subjects/$1';
//Semester Routes
$route['manage_semesters'] = 'Semester';
//Section Routes
$route['manage_sections'] = 'Section';
//Teacher Routes
$route['teacher_list'] = 'Teacher/index';
$route['add_teacher_profile'] = 'Teacher/add';
$route['view_teacher_profile/(:any)'] = 'Teacher/view/$1';
$route['edit_teacher_profile/(:any)'] = 'Teacher/edit/$1';
$route['delete_teacher_profile/(:any)'] = 'Teacher/delete/$1';
$route['view_subject_students/(:any)'] = 'Teacher/view_subject_students/$1';
$route['view_advising_students/(:any)'] = 'Teacher/view_advising_students/$1';

//Advised Students
$route['advised_students'] = 'Teacher/advised_students';
$route['subject_students'] = 'Teacher/subject_students';
$route['student_attendance'] = 'Teacher/student_attendance';
$route['get_student_attendance'] = 'Teacher/get_student_attendance';
$route['subject_result'] = 'Teacher/subject_result';
$route['make_subject_result'] = 'Teacher/make_subject_result';
$route['view_result'] = 'Teacher/view_result';
$route['search_student_result'] = 'Teacher/search_student_result';

//Student Routes
$route['student_list'] = 'Student/index';
$route['add_student_list'] = 'Student/add';
$route['view_student_profile/(:any)'] = 'Student/view/$1';
$route['edit_student_profile/(:any)'] = 'Student/edit/$1';
$route['delete_student_profile/(:any)'] = 'Student/delete/$1';
//Student Semester Registration
$route['student_semester_registration'] = 'Student/student_semester_registration';
$route['student_result_information'] = 'Student/student_result_information';

//Common Routes
$route['teacher_profile'] = 'Common/teacher_profile';
$route['student_profile'] = 'Common/student_profile';
$route['edit_profile_information'] = 'Common/edit_profile_information';

//Result Information
$route['result_information'] = 'Result';
$route['make_semester_result'] = 'result/make_semester_result';
$route['make_student_result/(:any)'] = 'result/make_student_result/$1';
$route['view_result_status_information/(:any)/(:any)'] = 'result/view_result_status_information/$1/$2';
$route['view_semester_wise_result'] = 'result/view_semester_wise_result';

$route['clear_specific_data'] = 'Admin/clear_specific_data';

$route['logout'] = 'Logout';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

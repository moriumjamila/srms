<?php
$role = $this->session->userdata('role');
?>
<?php if ($role == 1) { ?>
    <li id="dashboard"><a href="<?= base_url('dashboard.php') ?>"><i class="fa fa-home"></i><span>Dashboard</span></a></li>
    <li id="teacher_list"><a href="<?= base_url('/') ?>teacher_list.php"><i class="fa fa-user-secret"></i>Teachers </a></li>
    <li id="student_list"><a href="<?= base_url('/') ?>student_list.php"><i class="fa fa-users"></i> Students</a></li>
    <li id="semester_subjects"><a href="<?= base_url('/') ?>semester_subjects.php"><i class="fa fa-book"></i> Semester's Subject</a></li>
    <li id="subject_teachers"><a href="<?= base_url('/') ?>subject_teachers.php"><i class="fa fa-cubes"></i> Subject's Teachers</a></li>
    <li id="semester_registrations"><a href="<?= base_url('/') ?>semester_registrations.php"><i class="fa fa-pencil"></i> Semester Registration</a></li>
    <!--<li id="student_attendance"><a href="<?= base_url('student_attendance.php') ?>"><i class="fa fa-table"></i><span>Student Attendance</span></a></li>-->
    <li id="result_information"><a href="<?= base_url('/') ?>semester_result_information.php"><i class="fa fa-certificate"></i> Result Information</a></li>
<!--    <li id="result_information"><a href="<?= base_url('/') ?>result_information.php"><i class="fa fa-certificate"></i> Result Information</a></li>-->
    <!--<li id="reports"><a href="<?= base_url('/') ?>reports.php"><i class="fa fa-line-chart"></i> Reports</a></li>-->
    <li id="settings"><a href="<?= base_url('/') ?>settings.php"><i class="fa fa-gears"></i>Settings</a></li>
<?php } ?>
<?php if ($role == 2) { ?>
    <li id="teacher_profile"><a href="<?= base_url('teacher_profile.php') ?>"><i class="fa fa-shield"></i><span>Profile</span></a></li>
    <li id="advised_students"><a href="<?= base_url('advised_students.php') ?>"><i class="fa fa-comments"></i><span>Advised Students</span></a></li>
    <li id="subject_students"><a href="<?= base_url('subject_students.php') ?>"><i class="fa fa-users"></i><span>Subject's Students</span></a></li>
    <li id="student_attendance"><a href="<?= base_url('student_attendance.php') ?>"><i class="fa fa-clock"></i><span>Student's Attendance</span></a></li>
    <li id="subject_result"><a href="<?= base_url('subject_result.php') ?>"><i class="fa fa-certificate"></i><span>Make Results</span></a></li>
    <li id="view_result"><a href="<?= base_url('view_result.php') ?>"><i class="fa fa-book-reader"></i><span>View Results</span></a></li>
<?php } ?>
<?php if ($role == 3) { ?>
    <li id="student_profile"><a href="<?= base_url('student_profile.php') ?>"><i class="fa fa-shield"></i><span>Profile</span></a></li>
    <li id="student_semester_registration"><a href="<?= base_url('/') ?>student_semester_registration.php"><i class="fa fa-pencil"></i> Semester Registration</a></li>
    <li id="student_result_information"><a href="<?= base_url('/') ?>student_result_information.php"><i class="fa fa-certificate"></i> Result Information</a></li>
<?php } ?>

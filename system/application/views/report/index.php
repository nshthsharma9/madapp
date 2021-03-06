<?php $this->load->view('layout/header', array('title'=>'Reports')); ?>

<div id="head" class="clear"><h1>Report</h1></div>
<br />

<h3>City Reports</h3>

<a href="<?php echo site_url('report/users_with_low_credits') ?>">Show volunteers with low credits</a><br />
<a href="<?php echo site_url('report/absent') ?>">Show volunteers who were absent without a substitute</a><br />
<a href="<?php echo site_url('analysis/kids_attendance') ?>">Attendance Of The Kids</a><br />

<!-- 
<a href="<?php echo site_url('report/volunteer_requirement') ?>">Show volunteer requirement in each center</a><br />
<a href="<?php echo site_url('report/get_volunteer_admin_credits') ?>">Admin Credits</a><br />
<a href="<?php echo site_url('analysis/class_progress_report') ?>">Class Progress Report</a><br />
<a href="<?php echo site_url('analysis/event_attendance') ?>">Attendance For Volunteer Events</a><br />
<a href="<?php echo site_url('analysis/exam_report_test') ?>">Exam Reports</a><br />
<a href="<?php echo site_url('analysis/monthly_review') ?>">Monthly Review</a><br />
-->

<h3>CSV Reports</h3>

<a href="http://makeadiff.in/apps/support/student_allocation_csv.php?city_id=<?php echo $_SESSION['city_id'] ?>">Student Allocation CSV</a><br />


<h3>Nation Reports</h3>
<a href="<?php echo site_url('report/volunteer_count') ?>">Volunteer Count</a><br />
<a href="<?php echo site_url('report/child_count') ?>">Child Count</a><br />

<?php $this->load->view('layout/footer'); ?>
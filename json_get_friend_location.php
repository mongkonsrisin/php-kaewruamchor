<?php
require("session.php");
@session_start();
require ("configuration.php");
require("check_login.php");
$facultyid = $_GET['facultyid'];
$majorid = $_GET['majorid'];
$levelid = $_GET['levelid'];
$catid = $_GET['catid'];
$sec = $_GET['sec'];
$year = $_GET['year'];
// json_get_friend_location.php?facultyid=2&majorid=2202&levelid=2&catid=1&sec=1&year=2558
$sql = "SELECT stu_id, stu_fname, stu_lname, stu_latitude, stu_longtitude, stu_photo FROM student WHERE stu_facultyid = ? AND stu_majorid = ? AND stu_levelid = ? AND stu_catid = ? AND stu_sec = ? AND stu_year = ? AND stu_latitude>0 and stu_longtitude>0 ";
$stmt = $con->prepare($sql);
$stmt->bind_param("ssssss", $facultyid, $majorid, $levelid, $catid, $sec, $year);
$stmt->execute();
$result = $stmt->get_result();
$data = array();
if($result->num_rows === 0) // ไม่พบข้อมูล Student
{}
else
{
	while($row = $result->fetch_assoc()) {
		$row['stu_photo'] = base64_encode($row['stu_photo']);
		$data[] = $row;
	}
}
echo json_encode($data);
?>

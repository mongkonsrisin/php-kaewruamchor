<?php
require_once('dbconfig.php');
$response = array();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['facultyid']) && isset($_POST['majorid']) && isset($_POST['levelid']) && isset($_POST['catid']) && isset($_POST['sec']) && isset($_POST['year'])) {
		$facultyid = mysqli_real_escape_string($con, trim($_POST['facultyid']));
        $majorid   = mysqli_real_escape_string($con, trim($_POST['majorid']));
        $levelid   = mysqli_real_escape_string($con, trim($_POST['levelid']));
        $catid     = mysqli_real_escape_string($con, trim($_POST['catid']));
        $sec       = mysqli_real_escape_string($con, trim($_POST['sec']));
        $year      = mysqli_real_escape_string($con, trim($_POST['year']));
		$sql    = "SELECT stu_id,stu_fname, stu_lname,stu_photo FROM student
        WHERE stu_facultyid = '$facultyid'
        AND stu_majorid = '$majorid'
		    AND stu_levelid = '$levelid'
        AND stu_catid = '$catid'
        AND stu_sec = '$sec'
        AND stu_year = '$year'
        AND stu_approved = 1";
        $result = mysqli_query($con, $sql);
        $rows   = array();
        while ($row = mysqli_fetch_assoc($result)) {
            if (!empty($row['stu_photo'])) {
                $row['stu_photo'] = base64_encode($row['stu_photo']);
                $rows[] = $row;
            }
        }
        $response['success'] = true;
        $response['msg']     = $rows;
    } else {
        $response['success'] = false;
        $response['msg']     = 'Parameters are missing';
    }
} else {
    $response['success'] = false;
    $response['msg']     = 'Access Denied';
}
mysqli_close($con);
echo json_encode($response);
?>

<?php
require_once('dbconfig.php');
$response = array();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['birthday'])) {
        $fname    = mysqli_real_escape_string($con, trim($_POST['fname']));
        $lname    = mysqli_real_escape_string($con, trim($_POST['lname']));
        $birthday = mysqli_real_escape_string($con, trim($_POST['birthday']));
        $str      = explode("/", $birthday);
        $stryear  = $str[2] - 543;
        $newdate  = "$stryear-$str[1]-$str[0]";
        $sql      = "SELECT * FROM student WHERE stu_fname='$fname' AND stu_lname='$lname' AND stu_birthday='$newdate' AND stu_approved=1 ORDER BY stu_id DESC LIMIT 1";
        $result   = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) > 0) {
            $rows = array();
            while ($r = mysqli_fetch_assoc($result)) {
                $rows = $r;
            }
            $response['success'] = true;
            $response['msg']     = $rows['stu_id'];
        } else {
            $response['success'] = false;
            $response['msg']     = 'User not found';
        }
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

<?php
require_once('dbconfig.php');
$response = array();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id'])) {
        $id = mysqli_real_escape_string($con, trim($_POST['id']));
        $sql = "SELECT stu2.stu_id , faculty.*, major.*,level.*  FROM student stu
 LEFT JOIN student stu2 ON (stu.stu_fname = stu2.stu_fname AND stu.stu_lname = stu2.stu_lname AND stu.stu_birthday = stu2.stu_birthday)
  LEFT JOIN faculty  ON stu2.stu_facultyid = faculty.fa_id
  LEFT JOIN major ON stu2.stu_majorid = major.ma_id
  LEFT JOIN level ON stu2.stu_levelid = level.level_id
  WHERE stu.stu_id='$id'";
        $result = mysqli_query($con, $sql);
		$rows = array();
		while($row = mysqli_fetch_assoc($result))  {
			$row['fa_logo'] = base64_encode($row['fa_logo']);
			$rows[] = $row;
         }
		
        $response['success'] = true;
        $response['msg'] = $rows;
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

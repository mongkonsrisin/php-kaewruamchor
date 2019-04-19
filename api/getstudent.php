<?php
function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth = date("n",strtotime($strDate));
		$strDay = date("j",strtotime($strDate));
		$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		$strMonthThai = $strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
	}
require_once('dbconfig.php');
$response = array();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id'])) {
        $id = mysqli_real_escape_string($con, trim($_POST['id']));
        $sql = "SELECT stu.*, faculty.fa_thainame, major.*, level.*, category.*, degree.* FROM student stu
		LEFT JOIN faculty  ON stu.stu_facultyid = faculty.fa_id
		LEFT JOIN major ON stu.stu_majorid = major.ma_id
		LEFT JOIN level ON stu.stu_levelid = level.level_id
		LEFT JOIN category ON stu.stu_catid = category.cat_id
		LEFT JOIN degree  ON (stu.stu_degreeid = degree.degree_id AND stu.stu_levelid = degree.degree_levelid)
		WHERE stu_id='$id'";
        $result = mysqli_query($con, $sql);
		$row = mysqli_fetch_assoc($result);		
						$statustext = '';
		        if ($row['stu_status'] == 0) {
		          $statustext = 'ถึงแก่กรรม';
		        } else if ($row['stu_status'] == 1) {
		          $statustext = 'มีชีวิต';
		        }
				    $row['stu_statustext'] = $statustext;
		        $row['stu_birthdaytext'] = DateThai($row['stu_birthday']);
		        $row['stu_photo'] = base64_encode($row['stu_photo']);


        $response['success'] = true;
        $response['msg'] = $row;
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

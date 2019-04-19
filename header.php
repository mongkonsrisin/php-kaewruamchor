<?php @session_start(); ?>
<?php
require("configuration.php");
if(isset($_POST["view"]) || isset($_GET["view"]))
{	
	if(isset($_POST["view"])) $view=trim($_POST["view"]);
	else $view=trim($_GET["view"]);
	if($view=="logout")
	{
		if(isset($_COOKIE[$config->cookie_name]))
		{
			@setcookie($config->cookie_name, null, time() - 3600, "/"); // ลบให้ Cookie หมดอายุไปเมื่อ 1 ชั่วโมงที่แล้ว
			unset($_COOKIE[$config->cookie_name]);
		}
		@session_destroy();
		echo "<head><meta http-equiv='refresh' content='0;url=index.php?view=home'></head>";
		exit();
	}
	else $_SESSION["view"]=$view;
}

if(isset($_SESSION["remember_me"])) {
	if(intval($_SESSION["remember_me"])==1)
		@setcookie($config->cookie_name, $_SESSION[$config->session_id_name], time() + (86400 *365*10), "/"); // 86400 = 1 day
}

if(isset($_SESSION[$config->session_id_name]))
{
	if(isset($_COOKIE[$config->cookie_name]))
	{
		if(trim($_SESSION[$config->session_id_name])!=trim($_COOKIE[$config->cookie_name]) && trim($_SESSION[$config->session_id_name])!="")
		{
			@setcookie($config->cookie_name, null, time() - 3600, "/"); // ลบให้ Cookie หมดอายุไปเมื่อ 1 ชั่วโมงที่แล้ว
			unset($_COOKIE[$config->cookie_name]);
			@setcookie($config->cookie_name, $_SESSION[$config->session_id_name], time() + (86400 *365*10), "/"); // 86400 = 1 day
		}
	}
}

if(isset($_COOKIE[$config->cookie_name])) {
	if(trim($_COOKIE[$config->cookie_name])!="")
		$_SESSION[$config->session_id_name]=$_COOKIE[$config->cookie_name];
}

if(isset($_SESSION[$config->session_id_name])) {
	$id=$_SESSION[$config->session_id_name];
	if(isset($_SESSION["view"]))
	{
		if($_SESSION["view"]=="profile_friend_popup")
		{
			if(isset($_GET["id"])) 	if(trim($_GET["id"])!="") $id=trim($_GET["id"]); 
		}
	}
	$sql = "SELECT * FROM student st LEFT JOIN major mj ON (st.stu_facultyid = mj.ma_faculty and st.stu_majorid = mj.ma_id) LEFT JOIN faculty fc ON (st.stu_facultyid = fc.fa_id) LEFT JOIN degree dg ON (st.stu_degreeid = dg.degree_id and st.stu_levelid = dg.degree_levelid) WHERE st.stu_id = ? ";
	$stmt = $con->prepare($sql);
	$stmt->bind_param("s", $id);
	$stmt->execute();
	$result = $stmt->get_result();
	$student = $result->fetch_assoc();
	$_SESSION[$config->session_id_username]=trim($student["stu_fname"])." ".trim($student["stu_lname"]);
	$_SESSION["session_id_fname"]=trim($student["stu_fname"]);
	$_SESSION["session_id_lname"]=trim($student["stu_lname"]);
	$stu_latitude = $student['stu_latitude'];
	$stu_longtitude = $student['stu_longtitude'];
	if(floatval($stu_latitude) == 0 || floatval($stu_longtitude) == 0) {
		$stu_latitude = $config->ssru_latitude;
		$stu_longtitude = $config->ssru_longtitude;
	}
	$image_profile='data:image/jpeg;base64,'.base64_encode($student['stu_photo']);
	$image_share_thumb=$student['stu_photo'];
	if($image_profile == "data:image/jpeg;base64,")
	{
		$image_profile=$image_share_thumb="img/profile.png";
	}
	$key_hash=md5(trim($config->secret).trim($id)); // สำหรับเอาไว้ตรวจสอบ ไม่ให้คนอื่นเปลี่ยนรหัสนักศึกษา (id) จาก Link ที่แชร์ผ่าน Facebook
}
?>
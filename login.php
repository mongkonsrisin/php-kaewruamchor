<!-- Login.php -->
<?php
if(isset($_COOKIE[$config->cookie_name])) {
	if(trim($_COOKIE[$config->cookie_name])!="")
	{
		echo "<head><meta http-equiv='refresh' content='0;url=index.php?view=profile'></head>";
		exit();
	}
}
$fname=$lname=$pass="";
if($_SERVER['REQUEST_METHOD'] === 'POST') {
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$pass=$_POST['pass'];
	$pass_staff=md5($_POST['pass']);

	$stmt = $con->prepare("SELECT stf_fullname FROM staff WHERE stf_username	 = ? AND stf_password = ?");
	$stmt->bind_param("ss", $_POST['fname'], $pass_staff);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows === 0) // ไม่พบข้อมูล Staff ให้ไปค้นหาใน Student
	{
		list($d,$m,$y)=explode("/",$pass);
		$passwd=trim(intval($y)-543)."-".$m."-".$d;
		$stmt = $con->prepare("SELECT * FROM student WHERE stu_fname = ? AND stu_lname = ? AND stu_birthday = ? ORDER BY stu_id DESC");
		$stmt->bind_param("sss", $_POST['fname'], $_POST['lname'], $passwd);
		$stmt->execute();
		$result = $stmt->get_result();
		if($result->num_rows === 0) // ไม่พบข้อมูล
		{
			echo '<script type="text/javascript">setTimeout(function () { swal("เข้าสู่ระบบไม่สำเร็จ", "ท่านระบุข้อมูลไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง", "error");}, 1);</script>';
		}
		else
		{
			$row = $result->fetch_assoc();
			if($row["stu_approved"]==0)
				echo '<script type="text/javascript">setTimeout(function () { swal("ยังไม่สามารถเข้าสู่ระบบได้", "ท่านสมัครสมาชิกแล้ว! โปรดรอเจ้าหน้าที่ตรวจสอบข้อมูลการสมัครสมาชิกของท่าน กรุณากลับมาใหม่ในวันทำการถัดไป และขออภัยในความไม่สะดวกมา ณ โอกาสนี้", "error");}, 1);</script>';
			else
			{
				// แสดงข้อมูล
				$_SESSION[$config->session_id_username]=trim($row["stu_fname"])." ".trim($row["stu_lname"]);
				$_SESSION["session_id_fname"]=trim($row["stu_fname"]);
				$_SESSION["session_id_lname"]=trim($row["stu_lname"]);
				$_SESSION[$config->session_id_name]=trim($row["stu_id"]);
				if(isset($_POST["remember_me"])) {
					if(intval($_POST["remember_me"])==1)
						$_SESSION["remember_me"]=intval($_POST["remember_me"]);
				}
				echo "<head><meta http-equiv='refresh' content='0;url=index.php?view=profile'></head>";
				exit();
			}
		}
	}
	else // เจอ Staff
	{
		$row = $result->fetch_assoc();
		$_SESSION["ssru80_stf_id"]=trim($row["stf_username"]);
		$_SESSION["ssru80_stf_fullname"]=trim($row["stf_fullname"]);
		echo "<head><meta http-equiv='refresh' content='0;url=index.php?view=admin'></head>";
		exit();
	}
	$stmt->close();
}
?>
<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="css/datepicker.css">

<form name="form_login" class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
<input type="hidden" name="action" value="login">
<a href="?view=home"><img src="img/logo-gold.png" class="form-signin-logo"></a>
<h2 class="form-signin-heading">แก้วรวมช่อ</h2>
<input type="text" id="fname" name="fname" class="form-control" placeholder="ชื่อ" oninvalid="this.setCustomValidity('กรุณาป้อนชื่อจริง (ไม่ต้องใส่คำนำหน้าชื่อ)');" oninput="setCustomValidity('');" maxlength="30" value="<?=$fname;?>" required autofocus>
<input type="text" id="lname" name="lname" class="form-control" placeholder="นามสกุล" oninvalid="this.setCustomValidity('กรุณาป้อนนามสกุล');" oninput="setCustomValidity('');" maxlength="30" value="<?=$lname;?>" required>
<input class="form-control" id="pass" name="pass" type="text" data-provide="datepicker" data-date-language="th-th" placeholder="วัน/เดือน/ปีเกิด" oninvalid="this.setCustomValidity('เข้าสู่ระบบครั้งแรก รหัสผ่านคือ วัน/เดือน/ปีเกิด เช่น 05/01/2527');" oninput="setCustomValidity('');" maxlength="30" value="<?=$pass;?>" required autocomplete="off">
<input type="checkbox" name="remember_me" value="1" > จำฉันเข้าสู่ระบบเสมอ
<p></p>
<button class="btn btn-lg btn-primary btn-block" type="submit" name="login">เข้าสู่ระบบ</button>
<button class="btn btn-lg btn-secondary btn-block" name="btnRegister" onClick="registerUser();">สมัครสมาชิก</button>
</form>
<script>
function registerUser()
{
	document.form_login.fname.value='';
	document.form_login.lname.value='';
	document.form_login.pass.value='';
	window.location='index.php?view=register';
}
</script>
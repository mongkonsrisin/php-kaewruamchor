<?php
if(!isset($config))
{
echo "<head><meta http-equiv='refresh' content='0;url=index.php?view=register'></head>";
exit();
}
else
{
if(isset($_POST['register'])) {
	$fname = trim($_POST['stu_fname']);
	$lname = trim($_POST['stu_lname']);
	$birthday = trim($_POST['pass']);
	list($d,$m,$y)=explode("/",$birthday);
	$birthday_mysql=trim(intval($y)-543)."-".$m."-".$d;
	$id = trim($_POST['stu_id']);
	$faculty = trim($_POST['stu_faculty']);
	$major = trim($_POST['stu_major']);
	$level = trim($_POST['stu_level']);
	$degree = trim($_POST['stu_degree']);
	$year = trim($_POST['stu_year']);
	$sec = trim($_POST['stu_sec']);
	$phonenumber = trim($_POST['stu_phonenumber']);
	$email = trim($_POST['stu_email']);
	$stu_gen = trim($_POST['stu_gen']);
	$stu_catid = trim($_POST['stu_catid']);
	$img  = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));

	if(!empty($fname)&&!empty($lname)&&!empty($birthday)&&!empty($id)&&!empty($faculty)&&!empty($major)&&!empty($level)&&!empty($degree)&&!empty($year)&&!empty($sec)&&!empty($_FILES["image"])) {
	//not empty fields
	$stmt = $con->prepare("SELECT stu_id, stu_birthday FROM student WHERE stu_fname = ? AND stu_lname = ? ORDER BY stu_id DESC LIMIT 1");
	$stmt->bind_param("ss", $fname, $lname);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows > 0) {
	//fname and lname matched
	$row = $result->fetch_assoc();
	if(trim($row['stu_birthday']) == trim($birthday_mysql)) {
	//birthday match
	echo '<script type="text/javascript">setTimeout(function () { swal("แจ้งเตือน", "มีข้อมูลในระบบแล้ว สามารถเข้าสู่ระบบได้เลย", "error");}, 1);</script>';
	} else {
	//birthday not matched
	$id2 = $row['stu_id'];
	$sql4 = "UPDATE student SET stu_approved = 2 , stu_evidence = '$img' , stu_password='$birthday' WHERE stu_id = '$id2'";
	$stmt4 = $con->prepare($sql4);
	$stmt4->execute();
	echo '<script type="text/javascript">setTimeout(function () { swal("แจ้งเตือน", "บันทึกข้อมูลแล้ว รอเจ้าหน้าที่ตรวจสอบในวันทำการถัดไป", "success");}, 1);</script>';
	}
	} else {
	//new member
	$stmt2 = $con->prepare("SELECT stu_id FROM student WHERE stu_id = ?");
	$stmt2->bind_param("s", $id);
	$stmt2->execute();
	$result = $stmt2->get_result();
	if($result->num_rows > 0) {
	//Already has this id
	echo '<script type="text/javascript">setTimeout(function () { swal("แจ้งเตือน", "รหัสนักศึกษาซ้ำ", "error");}, 1);</script>';
	} else {
	//everything ok , insert data
//	$sql3 = "INSERT INTO student(stu_id,stu_fname,stu_lname,stu_password,stu_facultyid,stu_majorid,stu_levelid,stu_degreeid,stu_year,stu_sec,stu_approved,stu_evidence,stu_phonenumber) 	VALUES ('$id','$fname','$lname','$birthday','$faculty','$major','$level','$degree','$year','$sec','0','$img','$phonenumber')";

	$sql3="INSERT INTO student (stu_id, stu_prefix, stu_fname, stu_lname, stu_password, stu_birthday, stu_facultyid, stu_majorid, stu_degreeid, stu_levelid, stu_catid, stu_gen, stu_sec, stu_year, stu_engfname, stu_englname, stu_job, stu_status, stu_housenumber, stu_moo, stu_alley, stu_street, stu_district, stu_amphur, stu_province, stu_zipcode, stu_phonenumber, stu_email, stu_facebook, stu_line, stu_latitude, stu_longtitude, stu_photo, stu_evidence, stu_approved) VALUES ('".$id."', '', '".$fname."', '".$lname."', '".$birthday."', '".$birthday_mysql."', '".$faculty."', '".$major."', '".$degree."', '".$level."', '".$stu_catid."', '".$stu_gen."', '".$sec."', '".$year."', '', '', '', '1', '', '', '', '', '', '', '', '', '$phonenumber', '$email', '', '', '', '', NULL, '$img', '0');";
	$stmt3 = $con->prepare($sql3);
	$stmt3->execute();
	echo '<script type="text/javascript">setTimeout(function () { swal("แจ้งเตือน", "บันทึกข้อมูลเรียบร้อยแล้ว รอเจ้าหน้าที่ตรวจสอบในวันทำการถัดไป", "success");}, 1);</script>';
	}
	}
	} else {
	// Empty feilds
	echo '<script type="text/javascript">setTimeout(function () { swal("แจ้งเตือน", "กรุณากรอกข้อมูลให้ครบ", "error");}, 1);</script>';
	}
} //End if isset post register
?>


<section class="intro-hero">
<div class="container">
<div class="row">
<div class="col-sm-12 text-center">
<h1 class="hero-title"><strong>สมัครสมาชิก</strong></h1>
<h2><strong>(เฉพาะศิษย์เก่าสวนสุนันทา ที่เข้าสู่ระบบไม่ได้เท่านั้น)</strong></h2>
</div>
</div>
</div>
</section>

<form method="post"  enctype="multipart/form-data" name="form" id="form">
<main class="content-wrap">
<section class="about-me" id="about">
<div class="container">
<div class="row">
<div class="col-lg-6 about-me-text pl-lg-5">
<h4><i class="fa fa-drivers-license-o"></i> ข้อมูลส่วนตัว</h4>
<div class="form-group">
<label>ชื่อ</label>
<input name="stu_fname" type="text" class="form-control" value="<?php if(isset($_POST['stu_fname'])) echo $_POST['stu_fname']; ?>"  required>
</div>

<div class="form-group">
<label>นามสกุล</label>
<input name="stu_lname" type="text" class="form-control"  value="<?php if(isset($_POST['stu_lname'])) echo $_POST['stu_lname']; ?>" required>
</div>

<div class="form-group">
<label for="dtp_input2" class="control-label"><i class="fa fa-birthday-cake" style="color:#f777ad;"></i> วัน/เดือน/ปีเกิด</label>
<input class="form-control" id="pass" name="pass" type="text" data-provide="datepicker" data-date-language="th-th" placeholder="เช่น 05/01/2527" maxlength="10" oninvalid="this.setCustomValidity('ใช้สำหรับเป็นรหัสผ่านเข้าสู่ระบบ');" oninput="setCustomValidity('');" value="<?php if(isset($_POST['pass'])) echo $_POST['pass']; ?>" required autocomplete="off">
</div>

<div class="form-group">
<label><i class="fa fa-phone" style="color:#339933;"></i> เบอร์โทรศัพท์</label>
<input name="stu_phonenumber" type="text" maxlength="10" class="form-control" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}" value="<?php if(isset($_POST['stu_phonenumber'])) echo $_POST['stu_phonenumber']; ?>" required>
</div>

<div class="form-group">
<label><i class="fa fa-envelope-o" style="color:#339933;"></i> อีเมล์</label>
<input name="stu_email" type="text" maxlength="50" class="form-control"  value="<?php if(isset($_POST['stu_email'])) echo $_POST['stu_email']; ?>" required>
</div>

<br><h4><i class="fa fa-book"></i> ข้อมูลการศึกษา</h4>

<div class="form-group">
<label>รหัสนักศึกษา</label>
<input name="stu_id" type="text" class="form-control" maxlength="11"  required  value="<?php if(isset($_POST['stu_id'])) echo $_POST['stu_id']; ?>" onBlur="updateYear(this.value);" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}">
</div>

<div class="form-group">
<label>ปีที่เข้าศึกษา (พ.ศ.)</label>
<input id="stu_year" name="stu_year" type="text" class="form-control"  maxlength="4" required  value="<?php if(isset($_POST['stu_year'])) echo $_POST['stu_year']; ?>" onBlur="updateGen(this.value);" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}">
</div>

<div class="form-group">
<label>รุ่น (ภาคพิเศษ ให้ระบุรุ่นของนักศึกษา)</label>
<input id="stu_gen" name="stu_gen" type="text" class="form-control"  maxlength="2" required  value="<?php if(isset($_POST['stu_gen'])) echo $_POST['stu_gen']; ?>" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}">
</div>

<div class="form-group">
<label>หมู่เรียน (กรณีไม่ทราบให้เลือก 01)</label>
<select name="stu_sec" class="form-control" required>
<option value="1"> 01 </option>
<option value="2"> 02 </option>
<option value="3"> 03 </option>
<option value="4"> 04 </option>
<option value="5"> 05 </option>
</select>
</div>
</div>

<div class="col-lg-6 about-me-text pl-lg-5">

<div class="form-group">
<label>ประเภทนักศึกษา</label>
<select class="form-control custom-select select-small" id="stu_catid" name="stu_catid" required>
<option selected disabled>กรุณาเลือก...</option>
<?php
$sql = 'SELECT * FROM category ORDER BY CONVERT (cat_name USING tis620) ASC, cat_id ASC';
$result = mysqli_query($con,$sql);
$rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
foreach ($rows as $row) {
?>
<option value="<?php echo $row['cat_id'] ?>"><?php echo $row['cat_name'] ?></option>
<?php } ?>
</select>
</div>

<div class="form-group">
<label>คณะ/วิทยาลัย</label>
<select class="form-control custom-select select-small" id="faculty" name="stu_faculty" required>
<option selected disabled>กรุณาระบุปีที่เข้าศึกษาก่อน...</option>
<?php
$sql = 'SELECT * FROM faculty ORDER BY CONVERT (fa_thainame USING tis620) ASC';
$result = mysqli_query($con,$sql);
$faculties = mysqli_fetch_all($result,MYSQLI_ASSOC);
foreach ($faculties as $faculty) {
?>
<option value="<?php echo $faculty['fa_id'] ?>"><?php echo $faculty['fa_thainame'] ?></option>
<?php } ?>
</select>
</div>

<div class="form-group">
<label>สาขาวิชา/โปรแกรมวิชา</label>
<select class="form-control custom-select select-small" id="major" name="stu_major" required>
<option selected disabled>กรุณาเลือกคณะก่อน...</option>
</select>
</div>

<div class="form-group">
<label>ระดับการศึกษา</label>
<select  class="form-control" id="level" name="stu_level" required>
<option selected disabled>กรุณาเลือก...</option>
<?php
$cat = "SELECT * FROM level order by CONVERT (level_name USING tis620) ASC";
$cat2 = mysqli_query($con,$cat) or die (mysqli_error($con));
while ($a=mysqli_fetch_array($cat2)) {
?>
<option value="<?=$a['level_id']?>"> <?=$a['level_name']?> </option> <?php }?>
</select>
</div>

<div class="form-group">
<label>หลักสูตร</label>
<select  class="form-control" id="degree" name="stu_degree" required>
<option selected disabled>กรุณาเลือกระดับการศึกษาก่อน...</option>
</select>
</div>

<h4><i class="fa fa-image"></i> หลักฐานการเป็นนักศึกษา</h4>

<div class="col-lg-12">
<style>
#image { display:none; }
</style>
<input type="hidden" name="register">
<input type="file" name="image" id="image" accept="image/*" onchange="loadFile(event)"/>
<a href="#image" onclick="javascript:document.form.image.click();" role="button" class="btn btn-danger btn-lg"><i class="fa fa-cloud-upload"></i> อัพโหลดไฟล์หลักฐาน</a>
<div align="center"><img id="previewPic" src="" width="300"></div>
<script>
var loadFile = function(event) {
var output = document.getElementById('previewPic');
output.src = URL.createObjectURL(event.target.files[0]);
};
function updateYear(stu_id)
{
	document.form.stu_year.value='25'+(stu_id.substring(0,2));
	document.form.stu_gen.value=stu_id.substring(0,2);
}
function updateGen(stu_year)
{
	document.form.stu_gen.value=stu_year.substring(2,4);
}
</script>
</div>

</div>

<div class="col-lg-12 about-me-text pl-lg-5">
<p class="lead my-4">
<section>
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 text-center">
<a href="index.php?view=profile" role="button" class="btn btn-secondary btn-lg"><i class="fa fa-close"></i> ย้อนกลับ</a>
<a href="javascript:document.form.submit();" role="button" class="btn btn-success btn-lg"><i class="fa fa-save"></i> บันทึกข้อมูล</a>
</div>
</div>
</div>
</section>
</p>
</div>

</main> <!-- END content-wrap-->
</form>

<script src="js/jquery.min.js"></script>
<script>
$(function(){
var defaultOption = '<option selected disabled>กรุณาเลือก...</option>';
$('#faculty').change(function() {
$("#major").html(defaultOption);
document.getElementById('major').removeAttribute('disabled');
$.ajax({
url: "json_get_major.php",
data: ({ id: $('#faculty').val() , year: $('#stu_year').val() }),
dataType: "json",
success: function(json){
$.each(json, function(index, value) {
$("#major").append('<option value="' + value.ma_id +
'">' + value.ma_thainame  + ' (' + value.ma_id + ') ' + '</option>');
});
}
});
});

$('#level').change(function() {
$("#degree").html(defaultOption);
document.getElementById('degree').removeAttribute('disabled');
$.ajax({
url: "json_get_degree.php",
data: ({ id: $('#level').val() }),
dataType: "json",
success: function(json){
$.each(json, function(index, value) {
$("#degree").append('<option value="' + value.degree_id +
'">' +    value.degree_name  + '</option>');
});
}
});
});
})
</script>
<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="css/datepicker.css">
<?php
}
?>
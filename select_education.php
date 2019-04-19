<!-- select_education.php -->
<?php require("check_login.php"); ?>
<?php
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
	if(isset($_POST["stu_id"]))
	{
		$_SESSION[$config->session_id_name]=trim($_POST["stu_id"]);
		echo "<head><meta http-equiv='refresh' content='0;url=index.php?view=profile'></head>";
		exit();
	}
}
?>
<?php require("profile_header.php");?>
<script>
function selectDegree(stu_id)
{
	document.form.stu_id.value=stu_id;
	document.form.submit();
}
</script>
<form name="form" id="form" action="index.php" method="post">
<input type="hidden" name="stu_id" value="<?=$_SESSION[$config->session_id_name];?>">
<main class="content-wrap">
<section class="about-me" id="about">
	<div class="container">
<?php
	$sql="SELECT * FROM student st LEFT JOIN major mj ON (st.stu_facultyid = mj.ma_faculty and st.stu_majorid = mj.ma_id) LEFT JOIN faculty fc ON (st.stu_facultyid = fc.fa_id) LEFT JOIN degree dg ON (st.stu_degreeid = dg.degree_id and st.stu_levelid = dg.degree_levelid) WHERE st.stu_fname='".trim($_SESSION["session_id_fname"])."' and st.stu_lname='".trim($_SESSION["session_id_lname"])."' order by st.stu_id asc ";
	$stmt = $con->prepare($sql);
	$stmt->execute();
	$result = $stmt->get_result();
	$max_column=3;
	$current_column=0;
	while($student = $result->fetch_assoc()) {
		if($current_column==0){ echo '<div class="row">'; }
		$current_column++;
		echo '<div class="col-lg-4 about-me-text pl-lg-5"><p class="lead my-4"><h4><i class="fa fa-book"></i> ข้อมูลการศึกษา #'.$current_column.'</h4>';
?>
	<ul class="list-inline">
		<li><img src="data:image/jpeg;base64,<?=base64_encode($student['fa_logo']);?>" height="100"></li>
		<li><b>คณะ/วิทยาลัย : </b><?=$student['fa_thainame'];?></li>
		<li><b>สาขา : </b><span style="color:#1e6cee"><?=$student['ma_thainame'];?></span></li>
		<li><b>หลักสูตร : </b><?=$student['degree_name'];?></li>
		<li><b>ระดับการศึกษา : </b><span style="color:#1e6cee"><?=$student['degree_level_name'];?><span></li>
		<li><b>ปีที่เข้าศึกษา : </b><?=$student['stu_year'];?></li>
		<li><b>หมู่เรียน : </b><?=str_pad($student['stu_sec'],2,'0',STR_PAD_LEFT);?></li>
	</ul>
	<button name="choose" class="btn btn-success btn-lg" type="button" style="font-size:1em;" onClick="selectDegree('<?=$student["stu_id"];?>');"><i class="fa fa-check-circle"></i> เลือก</button>
<?php
		echo '</p></div>';
		if($current_column>=$max_column){ echo '</div>'; $current_column=0; }
	}
?>
	</div> <!-- END container-->
</section> <!-- END about-me-->

<section>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 button-group">
				<a href="index.php?view=profile" role="button" class="btn btn-secondary btn-lg"><i class="fa fa-close"></i> ย้อนกลับ</a>
			</div>
		</div>
	</div>
</section>
</main>
</form>
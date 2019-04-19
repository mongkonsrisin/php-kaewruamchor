<ul class="list-inline">
	<li><b>คณะ/วิทยาลัย : </b><?=$student['fa_thainame'];?></li>
	<li><b>สาขา : </b><?=$student['ma_thainame'];?></li>
	<li><b>หลักสูตร : </b><?=$student['degree_name'];?></li>
	<li><b>ระดับการศึกษา : </b><?=$student['degree_level_name'];?></li>
	<li><b>ปีที่เข้าศึกษา : </b><?=$student['stu_year'];?></li>
	<li><b>หมู่เรียน : </b><?=str_pad($student['stu_sec'],2,'0',STR_PAD_LEFT);?></li>
<?php 
	if($_SESSION["view"]=="profile")
	{
		// ตรวจสอบว่าจบมากกว่า 1 วุฒิการศึกษาหรือไม่
		$sql="SELECT count(stu_id) as total FROM student WHERE stu_fname='".trim($_SESSION["session_id_fname"])."' and stu_lname='".trim($_SESSION["session_id_lname"])."' ";
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();
		if($row["total"]>1)
		{
			echo '<li><br><a href="?view=select_education" role="button" class="btn btn-info btn-lg" id="btn_edit" style="font-size:1em;"><i class="fa fa-random"></i> เปลี่ยนข้อมูลการศึกษา</a></li>';
		}
	}
?>
</ul>
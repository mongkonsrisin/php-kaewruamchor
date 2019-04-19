<!-- admin.php -->
<?php
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
	if(isset($_POST["process"]))
	{
		if($_POST["process"]=="transfer")
		{
			$stmt = $con->prepare("select si.*, st.stu_id as student_id from student_import si left join student st on (si.stu_id=st.stu_id) where flag_insert=0");
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows === 0) // ไม่พบข้อมูล
			{
				echo '<script type="text/javascript">setTimeout(function () { swal("ไม่พบข้อมูล กรุณาลองใหม่อีกครั้ง", "", "error");}, 1);</script>';
			}
			else
			{
				$count=0;
				while($row = $result->fetch_assoc()) {
					if(trim($row["student_id"])=="")
					{
						list($y,$m,$d)=explode("-",$row["stu_birthday"]);
//						$stu_password=trim($d)."/".trim($m)."/".trim(intval($y)+543);
						$stu_password='';
						$lname=str_replace("'","''",$row['stu_lname']);
						$sql="INSERT INTO student (stu_id, stu_prefix, stu_fname, stu_lname, stu_password, stu_birthday, stu_facultyid, stu_majorid, stu_degreeid, stu_levelid, stu_catid, stu_gen, stu_sec, stu_year, stu_engfname, stu_englname, stu_job, stu_status, stu_housenumber, stu_moo, stu_alley, stu_street, stu_district, stu_amphur, stu_province, stu_zipcode, stu_phonenumber, stu_email, stu_facebook, stu_line, stu_latitude, stu_longtitude, stu_photo, stu_evidence, stu_approved) VALUES ('".$row['stu_id']."', '".$row['stu_prefix']."', '".$row['stu_fname']."', '".$lname."', '$stu_password', '".$row['stu_birthday']."', '".$row['stu_facultyid']."', '".$row['stu_majorid']."', '".$row['stu_degreeid']."', '".$row['stu_levelid']."', '".$row['stu_catid']."', '".$row['stu_gen']."', '".$row['stu_sec']."', '".$row['stu_year']."', '', '', '', '1', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '1');";
						$stmt2 = $con->prepare($sql);
						$stmt2->execute();
						$count++;
					}
					$stmt2 = $con->prepare("UPDATE student_import SET flag_insert=1 WHERE stu_id='".$row['stu_id']."'");
					$stmt2->execute();
				}
				echo '<script type="text/javascript">setTimeout(function () { swal("ดำเนินการเรียบร้อยแล้ว '.$count.' รายการ", "คลิก OK เพื่อปิด", "success");}, 1);</script>';
			}
		}
	}
}
?>
<section class="intro-hero">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 text-center">
				<h1 class="hero-title"><b><?=$_SESSION["ssru80_stf_fullname"];?></b></h1>
			</div> <!-- END col-sm-12-->
		</div> <!-- END row-->
	</div> <!-- END container-->
</section> <!-- END intro-hero-->

<main class="content-wrap">
<section class="about-me" id="about">
	<div class="container">
		<div class="row">
			<h2 class="map-heading"><i class="fa fa-cloud-upload"></i> นำเข้าข้อมูลศิษย์เก่า</h2>
		</div> <!-- END row -->
	</div> <!-- END container-->
</section> <!-- END about-me-->

<section>
<div class="container">
<div class="row">
<div class="col-lg-12 button-group">
<script type="text/javascript">
function importTransfer()
{
	document.formImport.process.value="transfer";
	document.formImport.submit();
}
</script>
<form name="formImport" id="formImport" action="index.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="process">
<?php
$stmt = $con->prepare("select count(stu_id) as total_remain from student_import where flag_insert=0");
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
if($row["total_remain"]>0)
	echo "<h3>พบข้อมูลผู้สำเร็จการศึกษาที่รอประมวลผล จำนวน &nbsp;<font color='#ff0000'>".number_format($row["total_remain"])."</font>&nbsp; ราย</h3>";	
else
	echo "<h3>ไม่มีข้อมูลให้ประมวล !!! <br>กรุณานำเข้าข้อมูลศิษย์เก่าไปไว้ที่ตาราง<br><font color='#ff0000'>STUDENT_IMPORT</font> ให้เรียบร้อยก่อน<br>โดยกำหนดค่า flag_insert=0</h3>";
?>
</form>
</div>
</div>
</div>
</section>

<section>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 button-group">
				<a href="index.php?view=admin" role="button" class="btn btn-secondary btn-lg"><i class="fa fa-reply"></i> ย้อนกลับ</a>
<?php
				if($row["total_remain"]>0)
					echo '<button name="edit" class="btn btn-success btn-lg" type="button" onClick="importTransfer();"><i class="fa fa-save"></i> ประมวลผล</button>';
?>
			</div>
		</div>
	</div>
</section>
</main>
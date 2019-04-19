<html>
<head>
<meta charset="UTF-8">
</head>
<body>
<?php
echo "<br>===== Prepare to Generate User from Oracle to MySQL =====<br>";
require_once("api/dbconfig.php");

function rg_utf8($txt)
{
	if(trim($txt)!='')
		return trim(iconv('TIS-620', 'UTF-8', $txt));
	else
		return $txt;
}

function rg_intOracle2date($ora_int_date)
{	// convert Oracle Integer Date as Number to Date Format
		list($day,$month, $year) = explode('/', date('d/m/Y', (($ora_int_date-719163)*86400)));
		$year=(int)$year+543;
		return  $day.'/'.$month.'/'.$year;
}

$runno=0;
$runno_created=0;
if(isset($_GET["year_in"]))
{
	$year_in=$_GET["year_in"];
	$stu_from=$_GET["stu_from"];
	$stu_to=$_GET["stu_to"];
	echo "<br> ===== Create Student Year in ".$year_in." stu_from=$stu_from -> stu_to=$stu_to=====<br>";

	$conn = oci_pconnect('register', 'register', 'register');

	$sql = "select STUDENT_CODE as STU_ID,PF.DETAIL_THAI as STU_PREFIX, FIRSTNAME as STU_FNAME, LASTNAME as STU_LNAME, DATE_OF_BIRTH as STU_BIRTHDAY, FACULTY as STU_FACULTYID, DEPARTMENT as STU_DEGREEID, PROGRAM as STU_MAJOR, LEVELS as STU_LEVELID, STUDENT_TYPE as STU_CATID, STUDENT_CLASS as STU_GEN, STUDENT_GROUP as STU_SEC, YEAR_IN as STU_YEAR from HISSTUD HS left join PREFIX PF on (HS.PREFIX=PF.PREFIX) where YEAR_IN=:year_in and STUDENT_CODE between :stu_from and :stu_to  order by STUDENT_CODE";
	$result = oci_parse($conn, $sql);
	oci_bind_by_name($result, ":year_in", $year_in);
	oci_bind_by_name($result, ":stu_from", $stu_from);
	oci_bind_by_name($result, ":stu_to", $stu_to);
/*
	$sql = "select STUDENT_CODE as STU_ID,PF.DETAIL_THAI as STU_PREFIX, FIRSTNAME as STU_FNAME, LASTNAME as STU_LNAME, DATE_OF_BIRTH as STU_BIRTHDAY, FACULTY as STU_FACULTYID, DEPARTMENT as STU_DEGREEID, PROGRAM as STU_MAJOR, LEVELS as STU_LEVELID, STUDENT_TYPE as STU_CATID, STUDENT_CLASS as STU_GEN, STUDENT_GROUP as STU_SEC, YEAR_IN as STU_YEAR from HISSTUD HS left join PREFIX PF on (HS.PREFIX=PF.PREFIX) where YEAR_IN=:year_in order by STUDENT_CODE";
	$result = oci_parse($conn, $sql);
	oci_bind_by_name($result, ":year_in", $year_in);
*/
	oci_execute($result);
	while($row = oci_fetch_array($result, OCI_ASSOC))
	{
		$runno++;
		$stu_id = trim($row["STU_ID"]);
		$stu_fname = rg_utf8(trim($row["STU_FNAME"]));
		$stu_lname = rg_utf8(trim($row["STU_LNAME"]));
		$birthday = rg_intOracle2date($row["STU_BIRTHDAY"]);
		list($d,$m,$y)=explode("/",$birthday);
		$birthday_mysql=trim(intval($y)-543)."-".$m."-".$d;
		if($birthday=='07/06/2449')
		{
			$birthday='';
			$birthday_mysql='1901-01-01';
		}
		$stu_facultyid = trim($row["STU_FACULTYID"]);
		$stu_majorid = trim($row["STU_MAJOR"]);
		$stu_degreeid = trim($row["STU_DEGREEID"]);
		$stu_levelid = trim($row["STU_LEVELID"]);
		$stu_catid = trim($row["STU_CATID"]);
		$stu_gen = trim($row["STU_GEN"]);
		$stu_sec = trim($row["STU_SEC"]);
		$stu_year = trim($row["STU_YEAR"]);
		echo '<br>'.$runno.') ID : '.$row["STU_ID"].' - '.$stu_fname.' '.$stu_lname.' - '.$birthday." ($birthday_mysql)";

		// ทำการตรวจสอบว่ามีข้อมูลแล้วหรือไม่
		$sql2="SELECT stu_id, stu_birthday FROM student WHERE stu_fname='$stu_fname' AND stu_lname='$stu_lname' ORDER BY stu_id DESC LIMIT 1";
		$stmt = $con->prepare($sql2);
		$stmt->execute();
		$result_mysql = $stmt->get_result();

		if($result_mysql->num_rows > 0) {
			echo " -->> ซ้ำ  (skip)";
		// ข้อมูลซ้ำ
		} else {
			echo " -- ไม่ซ้ำ --";
			$sql3="INSERT INTO student (stu_id, stu_prefix, stu_fname, stu_lname, stu_password, stu_birthday, stu_facultyid, stu_majorid, stu_degreeid, stu_levelid, stu_catid, stu_gen, stu_sec, stu_year, stu_engfname, stu_englname, stu_job, stu_status, stu_housenumber, stu_moo, stu_alley, stu_street, stu_district, stu_amphur, stu_province, stu_zipcode, stu_phonenumber, stu_email, stu_facebook, stu_line, stu_latitude, stu_longtitude, stu_photo, stu_evidence, stu_approved) VALUES ('".$stu_id."', '', '".$stu_fname."', '".$stu_lname."', '".$birthday."', '".$birthday_mysql."', '".$stu_facultyid."', '".$stu_majorid."', '".$stu_degreeid."', '".$stu_levelid."', '".$stu_catid."', '".$stu_gen."', '".$stu_sec."', '".$stu_year."', '', '', '', '1', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '1');";
			$stmt3 = $con->prepare($sql3);
			$stmt3->execute();
			if($stmt3)
			{
				$runno_created++;
				echo "-->> Created ($runno_created)";
			}
			else echo "-->> Error (can not create this record)";
		}
	}
}
echo "<br><br><br><br><br>==============  End of Process ============<br><br><br><br><br>";
?>
</body>
</html>
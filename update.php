<!-- update.php -->
<?php
$stmt = $con->prepare("SELECT stu_id, stu_birthday FROM student WHERE length(trim(stu_password))=0");
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows === 0) // ไม่พบข้อมูล
{
	echo '<script type="text/javascript">setTimeout(function () { swal("ไม่พบข้อมูล กรุณาลองใหม่อีกครั้ง", "", "error");}, 1);</script>';
}
else
{
	while($row = $result->fetch_assoc()) {
		list($y,$m,$d)=explode("-",$row["stu_birthday"]);
		$stu_password=trim($d)."/".trim($m)."/".trim(intval($y)+543);
		$sql2= "UPDATE student SET stu_password='$stu_password' WHERE stu_id='".$row['stu_id']."' ";
		$stmt2 = $con->prepare($sql2);
		$stmt2->execute();
	}
	echo '<script type="text/javascript">setTimeout(function () { swal("ปรับปรุงข้อมูลเรียบร้อยแล้ว", "", "success");}, 1);</script>';
}
?>
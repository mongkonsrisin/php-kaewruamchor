<?php
require ("configuration.php");
$id = $_GET['id'];
$y = $_GET['year'];
if(intval($y)>0 && intval($y)<2548)
	$sql = "SELECT * FROM major WHERE ma_faculty=$id and length(ma_id)=3 order by CONVERT (ma_thainame USING tis620) asc, ma_id asc";
else
	$sql = "SELECT * FROM major WHERE ma_faculty=$id and length(ma_id)=4 order by CONVERT (ma_thainame USING tis620) asc, ma_id asc";
$result = mysqli_query($con,$sql);
$data = array();
while($row = mysqli_fetch_assoc($result)) {
	$data[] = $row;
}
echo json_encode($data);
?>

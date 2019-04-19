<?php

require ("configuration.php");

$id = $_GET['id'];


$sql = "SELECT * FROM degree WHERE degree_levelid=$id order by CONVERT (degree_name USING tis620) asc";
$result = mysqli_query($con,$sql);
$data = array();
while($row = mysqli_fetch_assoc($result)) {
	$data[] = $row;
}

echo json_encode($data);
?>

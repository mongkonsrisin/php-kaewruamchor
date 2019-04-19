<?php
require("session.php");
@session_start();
require("configuration.php");
require("check_login.php");
$sql="UPDATE student SET stu_latitude='".$_POST["lat"]."' , stu_longtitude='".$_POST["lng"]."' WHERE stu_id=? ";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $_POST["id"]);
$stmt->execute();
echo "success";
?>
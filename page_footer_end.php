<?php
	if($_SESSION["view"]!="friends")
	{
?>
<div class="footer">
&copy; <?=(date('Y')+543);?> แก้วรวมช่อ 80 ปี มหาวิทยาลัยราชภัฏสวนสุนันทา
</div>
<?php } ?>

<?php
/* Open Debug Mode */
	$stmt = $con->prepare("SELECT open_debug FROM sys_config WHERE config_id=1");
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
	if($row["open_debug"]==1)
	{
		echo "<br>Server=".$config->web_server_name;
		echo "<br>POST[view]=".$_POST["view"];
		echo "<br>GET[view]=".$_GET["view"];
		echo "<br>SESSION[view]=".$_SESSION["view"];
		echo "<br>GET[id]=".$_GET["id"];
		echo "<br>Facebook Share Facebook=".$config->website."facebooksharefriends.php/".$id."/".$key_hash;
		echo "<br>SESSION[config->session_id_name]=".$_SESSION[$config->session_id_name];
		echo "<br>COOKIE[config->cookie_name]=".$_COOKIE[$config->cookie_name];
	}
?>

</body>
</html>
<?php
include("analyticstracking.php");
?>
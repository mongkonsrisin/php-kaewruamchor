<?php require("session.php"); ?>
<?php require("header.php"); ?>
<?php
if(isset($_SESSION["view"]))
{
	if($_SESSION["view"]!="home" && trim($_SESSION["view"])!="")
	{
		require("page_header.php");
		require("page_header_end.php");
		if($_SESSION["view"]=="login")
			echo '<div class="wrapper"><div class="container">';
		include($_SESSION["view"].".php");
		if($_SESSION["view"]=="login")
			echo '</div><br><br><br></div>';
		require("page_footer.php");
		require("page_footer_end.php");
	}
	else include($view.".php");
}
else include("home.php");

/* Clear SQL Values and Connection */
$config=null; unset($config);
$result=null; unset($result);
$result2=null; unset($result2);
$stmt=null; unset($stmt);
$stmt2=null; unset($stmt2);
$con->close();
$con=null; unset($con);
?>

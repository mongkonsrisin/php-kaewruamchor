<?php
@session_start();
if(!isset($config))
{
	echo "<head><meta http-equiv='refresh' content='0;url=index.php?view=login'></head>";
	exit();
}
if(!isset($_COOKIE[$config->cookie_name]) && !isset($_SESSION[$config->session_id_name])) {
	echo "<head><meta http-equiv='refresh' content='0;url=index.php?view=login'></head>";
	exit();
}
?>
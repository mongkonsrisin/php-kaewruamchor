<!-- map_friends.php -->
<?php require("check_login.php"); ?>
<?php
/*
// อ่านค่าความกว้างหน้าจอ แล้ว return กลับมาทาง url
if(!isset($_GET['screen']))
{ echo "<script language=\"JavaScript\">var w=window.innerWidth; var h=window.innerHeight; document.location=\"$PHP_SELF?view=friends&screen=1&width=\"+w+\"&Height=\"+h; </script>"; }
else { if(isset($_GET['width']) && isset($_GET['Height'])) { $browser_width=$_GET['width']; $browser_height=$_GET['Height']; } }
//echo $browser_width." x ".$browser_height;
*/
?>
<link href="css/hover.css" rel="stylesheet" media="all">
<link rel="stylesheet" type="text/css" href="css/animate.css">
<link rel="stylesheet" type="text/css" href="css/cir.css">
<div valign="top" align="center" style="width:100%; height:100%;">
<table width="100%" height="100%" align="center" valign="top" cellpadding="0" cellspacing="0" border="0">
<tr><td height="50" valign="top" style="background-image:url('img/cover.jpg');background-repeat: no-repeat;
    background-size: cover;"><h2 class="map-heading" style="color:#ffffff;"><i class="fa fa-users"></i> เพื่อนร่วมรุ่น<br><span style="font-size: 0.7em;"><?=$_SESSION[$config->session_id_username];?></span></h2></td></tr>
<tr><td height="20">&nbsp;</td></tr>
<tr><td class="bubble">
<?php
$thisstudent = $student;
$random_order=(intval(date('s')))%10;
if($random_order==1) $order_by=" order by stu_lname asc";
else if($random_order==2) $order_by=" order by stu_lname desc";
else if($random_order==3) $order_by=" order by stu_fname desc";
else if($random_order==4) $order_by=" order by stu_fname asc";
else if($random_order==5) $order_by=" order by stu_birthday asc";
else if($random_order==6) $order_by=" order by stu_birthday desc";
else if($random_order==8) $order_by=" order by stu_phonenumber asc , stu_engfname asc, stu_id asc";
else if($random_order==9) $order_by=" order by stu_phonenumber desc , stu_engfname desc, stu_id desc";
else $order_by=" order by stu_phonenumber desc , stu_engfname asc, stu_id asc";
$sql = "SELECT * FROM student  LEFT JOIN major ON student.stu_majorid = major.ma_id LEFT JOIN faculty ON student.stu_facultyid = faculty.fa_id LEFT JOIN degree d on (student.stu_degreeid=d.degree_id and student.stu_levelid=d.degree_levelid) WHERE stu_gen = $thisstudent[stu_gen] AND stu_sec = $thisstudent[stu_sec] AND stu_facultyid = $thisstudent[stu_facultyid] AND stu_majorid = $thisstudent[stu_majorid] and stu_photo is not null $order_by";
$stmt = $con->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$max_bubble=8;
$fadeInDirection="fadeInUp";
while($student=mysqli_fetch_array($result))
{
	$image_file='data:image/jpeg;base64,'.base64_encode($student['stu_photo']);
	$left=rand();
	$left = rand(1,50);
	switch($left)
	{
		case ($left <= 20): $left = "5"; break;
		case ($left <= 30): $left = "10"; break;
		case ($left <= 40): $left = "15"; break;
		case ($left <= 50): $left = "20"; break;
	}
	$right=rand();
	$right = rand(1,50);
	switch($right)
	{
		case ($right <= 20): $right = "10"; break;
		case ($right <= 30): $right = "20"; break;
		case ($right <= 40): $right = "30"; break;
		case ($right <= 50): $right = "40"; break;
	}
	$randomizer2 = rand();
	$randomizer2 = rand(1,50);
	switch($randomizer2)
	{
		case ($randomizer2 <= 20): $case2 = "1"; break;
		case ($randomizer2 <= 30): $case2 = "2"; break;
		case ($randomizer2 <= 40): $case2 = "3"; break;
		case ($randomizer2 <= 50): $case2 = "4"; break;
	}
	$randomizer3 = rand();
	$randomizer3 = rand(1,50);
	switch($randomizer3)
	{
		case ($randomizer3 <= 20): $fadeInDirection = "fadeInUp"; $float="left"; break;
		case ($randomizer3 <= 30): $fadeInDirection = "fadeInDown"; $float="right"; break;
		case ($randomizer3 <= 40): $fadeInDirection = "fadeInLeft"; $float="center"; break;
		case ($randomizer3 <= 50): $fadeInDirection = "fadeInRight"; $float="right"; break;
	}

	if($image_file == "data:image/jpeg;base64,") $image_file="img/profile.png";
?>
	<a href="index.php?view=profile_friend_popup&back=friends&id=<?=$student['stu_id']?>" style="text-decoration: none;" id="#friends_<?=$student['stu_id']?>">
		<div class="<?=$fadeInDirection;?> animated" style="float:left; animation-duration: <?=$case2;?>s;">
			<div style="margin-left:<?=$left;?>px; margin-right:<?=$right;?>px; margin-bottom: 10px; background-image:url('<?=$image_file;?>');" class="cir animated pulse infinite hvr-pulse-grow"><div class="bubble"></div>
			</div>
		</div>
	</a>
<!--
	<a href="index.php?view=profile_friend_popup&back=friends&id=<?=$student['stu_id']?>" style="text-decoration: none;" id="#friends_<?=$student['stu_id']?>">
		<div class="<?=$fadeInDirection;?> animated" style="float:right;animation-duration: <?=$case2;?>s;">
			<div style="margin-left:<?=$case;?>; margin-right:<?=$case;?>; margin-bottom: 10px; background-image:url('<?=$image_file;?>');" class="cir animated pulse infinite hvr-pulse-grow"><div class="bubble"></div>
			</div>
		</div>
	</a>

	<a href="" style="text-decoration: none;" data-toggle="modal" data-target="#myModal<?=$student['stu_id']?>">
		<div class="fadeInUp animated" style="float:right;animation-duration: <?=$case2;?>s;">
			<div style="margin-left:<?=$case;?>; margin-right:<?=$case;?>; margin-bottom; background-image:url('<?=$image_file;?>');" class="cir animated pulse infinite hvr-pulse-grow"><div class="bubble"></div>
			</div>
		</div>
	</a>
-->
<?php }?>

</td></tr>
<tr><td height="20">&nbsp;</td></tr>
<tr><td height="100" valign="bottom"><?php require("section_button.php");?></td></tr>
<tr><td class="footer">&copy; <?=(date('Y')+543);?> แก้วรวมช่อ 80 ปี มหาวิทยาลัยราชภัฏสวนสุนันทา</td></tr>
</table>
</div>

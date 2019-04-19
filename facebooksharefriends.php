<?php
// http://localhost/ssru80th/facebooksharefriends.php/58122202000/59f3c8ee498ec381cae11a9cdbc9d57b
// http://localhost:81/ssru80th/facebooksharefriends.php/58122202000/59f3c8ee498ec381cae11a9cdbc9d57b
// http://localhost:81/ssru80th/facebooksharefriends.php/1/f0dcee1034269e72e58ef771b30163c8
// http://localhost:81/ssru80th/facebooksharefriends.php/4063180128/9a51cec2f92b7120b0e84ca0db28e6ff
// ขนาดรูปภาพ
// ใช้รูปภาพขนาดอย่างน้อย 1200 x 630 พิกเซล สำหรับการแสดงผลที่ดีที่สุดในอุปกรณ์ที่มีความคมชัดสูง 
// อย่างน้อยที่สุด คุณควรใช้รูปภาพที่มีขนาด 600 x 315 พิกเซล  ในการแสดงโพสต์ที่ลิงก์ไปที่เพจด้วยรูปภาพที่มีขนาดใหญ่กว่า
// รูปภาพมีขนาดได้สูงสุด 8MB
require("configuration.php");

$uri=$_SERVER['REQUEST_URI'];
$link_share1="facebooksharefriends.php/";
$found=intval(strpos($uri,$link_share1));
if($found>0)
{
	list($heder,$parameters)=explode($link_share1, $uri);
	list($id,$key_get)=explode('/', $parameters);
}
$key_hash=md5(trim($config->secret).trim($id));
if($key_get!=$key_hash)
{
	echo "<head><meta http-equiv='refresh' content='0;url=".$config->facebook_url."'></head>";
	exit();
}
else
{
	function prepareThumb($user_profile, $thumb_width, $thumb_height)
	{
		// ลดขนาดภาพโปรไฟล์ให้เหลือแค่ 100x100 pixel แล้วใส่ไว้ที่ตัวแปร $thumb
		$thumb = imagecreatetruecolor($thumb_width, $thumb_height);
		imagecopyresampled($thumb, $user_profile, 0, 0, 0, 0, $thumb_width, $thumb_height, imagesx($user_profile), imagesy($user_profile));

		// ทำภาพสี่เหลี่ยมเป็นวงกลม
		$thumb_circle = imagecreatetruecolor($thumb_width, $thumb_height);
		imagecopy($thumb_circle, $thumb, 0, 0, 0, 0, $thumb_width, $thumb_height);
		$mask = imagecreatetruecolor($thumb_width, $thumb_height);
		$maskTransparent = imagecolorallocate($mask, 255, 0, 255);
		imagecolortransparent($mask, $maskTransparent);
		imagefilledellipse($mask, $thumb_width / 2, $thumb_height / 2, $thumb_width, $thumb_height, $maskTransparent);
		imagecopymerge($thumb_circle, $mask, 0, 0, 0, 0, $thumb_width, $thumb_height, 100);
		$dstTransparent = imagecolorallocate($thumb_circle, 255, 0, 255);
		imagefill($thumb_circle, 0, 0, $dstTransparent);
		imagefill($thumb_circle, $thumb_width - 1, 0, $dstTransparent);
		imagefill($thumb_circle, 0, $thumb_height - 1, $dstTransparent);
		imagefill($thumb_circle, $thumb_width - 1, $thumb_height - 1, $dstTransparent);
		imagecolortransparent($thumb_circle, $dstTransparent);
		return $thumb_circle;
	}
	function calCoorXY()
	{
		global $friend_no, $coor_x, $coor_y, $round, $child, $thumb_widthX, $gap, $thumb_width, $center_x, $center_y;
		$max_child=0;
		for($i=1;$i<=$round;$i++) $max_child+=$child[$i];
		if($friend_no>$max_child) $round++;
		$deg=intval(360/$child[$round]);
		$radius=($thumb_widthX/2)+($round*$gap)+(($round-1)*$thumb_width)+($thumb_width/2);
		//$bg_width, $bg_height
		$coor_x=$center_x+$radius*(-cos(deg2rad($deg*$friend_no)));
		$coor_y=$center_y+$radius*sin(deg2rad($deg*$friend_no));
	}
	$sql = "SELECT * FROM student WHERE stu_id = ?";
	$stmt = $con->prepare($sql);
	$stmt->bind_param("s", $id);
	$stmt->execute();
	$result = $stmt->get_result();
	$student = $result->fetch_assoc();
	$image_profile='data:image/jpeg;base64,'.base64_encode($student['stu_photo']);
	$image_share_thumb=$student['stu_photo'];
	if($image_profile == "data:image/jpeg;base64,")
	{
		$image_profile=$image_share_thumb="img/profile.png";
	}
	$bg="img/cover_bg.jpg";
	$thumb_widthX=$thumb_heightY=180;
	list($bg_width, $bg_height) = getimagesize($bg);
	$center_x=($bg_width/2)-($thumb_widthX/2);
	$center_y=($bg_height/2)-($thumb_heightY/2);
	$user_profile=($image_share_thumb=="img/profile.png")? imagecreatefrompng($image_share_thumb) : imagecreatefromstring($image_share_thumb);
	$thumb_circle=prepareThumb($user_profile, $thumb_widthX, $thumb_heightY);
	
	// นำภาพโปรไฟล์มาวางบนภาพ bg
	$img = imagecreatefromjpeg($bg);
	imagecopymerge($img, $thumb_circle, $center_x, $center_y, 0, 0, $thumb_widthX, $thumb_heightY,100);

	// ดึงข้อมูลรูปเพื่อนมาแสดง
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
	$sql = "SELECT * FROM student  LEFT JOIN major ON student.stu_majorid = major.ma_id LEFT JOIN faculty ON student.stu_facultyid = faculty.fa_id LEFT JOIN degree d on (student.stu_degreeid=d.degree_id and student.stu_levelid=d.degree_levelid) WHERE stu_gen = $thisstudent[stu_gen] AND stu_sec = $thisstudent[stu_sec] AND stu_facultyid = $thisstudent[stu_facultyid] AND stu_majorid = $thisstudent[stu_majorid] AND stu_photo is not null AND stu_id!='$id' $order_by";
	$stmt = $con->prepare($sql);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows === 0) // ยังไม่มีรูปเพื่อน
	{
	}
	else
	{
		$gap=8; // ช่องว่าง pixel
		$child = array(0, 9, 15, 21, 26, 32, 40, 50, 60, 80, 100, 120);
		$unuse_friend_no=array(42, 43, 54, 55, 56, 96, 97, 98, 99);
		$buble_size=array(90, 85, 70, 65, 60);
		$friend_no=0;
		$round=1;	
		$thumb_width=($thumb_widthX/2);
		$thumb_height=($thumb_heightY/2);
		$center_x+=($thumb_width/2);
		$center_y+=($thumb_height/2);
		while($student=mysqli_fetch_array($result))
		{
			$friend_no++;
			$random_size=rand();
			$random_size=rand(1,99);
			$random_size=$random_size%5;
			$random_size=$buble_size[$random_size];
			calCoorXY();
			while($coor_y<(-($random_size/2))) { $friend_no++; calCoorXY(); }
			while($coor_y>($bg_height-($random_size/2))) { $friend_no++; calCoorXY(); }
			foreach($unuse_friend_no as $fno) { if($friend_no==$fno){ $friend_no++; calCoorXY(); } }

			$image_profile='data:image/jpeg;base64,'.base64_encode($student['stu_photo']);
			$image_share_thumb=$student['stu_photo'];
			if($image_profile == "data:image/jpeg;base64,")
			{
				$image_profile=$image_share_thumb="img/profile.png";
			}
			$friend_profile=($image_share_thumb=="img/profile.png")? imagecreatefrompng($image_share_thumb) : imagecreatefromstring($image_share_thumb);
			$thumb_circle=prepareThumb($friend_profile, $random_size, $random_size);
			// นำภาพโปรไฟล์มาวางบนภาพ bg
			imagecopymerge($img, $thumb_circle, $coor_x, $coor_y, 0, 0, $random_size, $random_size,100);
		}
	}

	// Output the image to browser
	@header("Pragma-directive: no-cache");
    @header("Cache-directive: no-cache");
    @header("Cache-control: no-cache");
    @header("Pragma: no-cache");
    @header("Expires: 0");
	@header('Content-Type: image/png');
	imagejpeg($img, NULL, 100);
	if($img)
	{
		imagedestroy($img);
	}
}
?>
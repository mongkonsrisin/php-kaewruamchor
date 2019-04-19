<!-- profile.php -->
<?php require("check_login.php"); ?>
<?php
// ตรวจสอบว่าเป็นเพื่อนในรุ่นเท่านั้นถึงจะอนุญาตให้มองเห็นได้
$sql = "SELECT * FROM student WHERE stu_id = ? ";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $_SESSION[$config->session_id_name]);
$stmt->execute();
$result = $stmt->get_result();
$student_current = $result->fetch_assoc();
if(trim($student_current["stu_facultyid"])!=trim($student["stu_facultyid"]) || trim($student_current["stu_majorid"])!=trim($student["stu_majorid"]) || trim($student_current["stu_levelid"])!=trim($student["stu_levelid"]) || trim($student_current["stu_catid"])!=trim($student["stu_catid"]) || trim($student_current["stu_sec"])!=trim($student["stu_sec"]) || trim($student_current["stu_year"])!=trim($student["stu_year"]))
{
	// ไม่มีสิทธิ์เข้าใช้งาน
	echo "<head><meta http-equiv='refresh' content='0;url=index.php?view=friends_map'></head>";
	exit();
}
?>
<?php require("profile_header.php");?>
<div class="fab-share" onclick="alert('share')"></div>

<main class="content-wrap">
<section class="about-me" id="about">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 about-me-text pl-lg-5">
				<p class="lead my-4"><h4><i class="fa fa-book"></i> ข้อมูลการศึกษา</h4>
					<?php require("profile_education.php");?>
				</p>
			</div>
			<div class="col-lg-4 about-me-text pl-lg-5">
				<p class="lead my-4"><h4><i class="fa fa-drivers-license-o"></i> ข้อมูลส่วนตัว</h4>
					<ul class="list-inline">
						<li><b>คำนำหน้าชื่อ : </b><?=$student['stu_prefix'];?></li>
						<li><b>ชื่ออังกฤษ : </b><?=$student['stu_engfname'];?></li>
						<li><b>นามสกุลอังกฤษ : </b><?=$student['stu_englname'];?></li>
						<li><b>อาชีพ : </b><?=$student['stu_job'];?></li>
						<li><b>สถานะ :</b> <?=($student['stu_status']==1)?'มีชีวิต':'ถึงแก่กรรม';?></li>
					</ul>
				</p>
			</div>
			<div class="col-lg-4 about-me-text pl-lg-5">
				<p class="lead my-4"><h4><i class="fa fa-envelope"></i> ข้อมูลติดต่อ</h4>
					<ul class="list-inline">
<?php
					$fullAddress = fullAddress($student['stu_housenumber'], $student['stu_moo'], $student['stu_alley'], $student['stu_street'], $student['stu_district'], $student['stu_amphur'], $student['stu_province'], $student['stu_zipcode']);
?>
						<li><i class="fa fa-map-marker" style="color:#f777ad;"></i> <b>ที่อยู่ : </b><?=$fullAddress ?></li>
						<li><i class="fa fa-phone" style="color:#339933;"></i> <b>เบอร์โทรศัพท์ : </b><?=$student['stu_phonenumber'];?></li>
						<li><i class="fa fa-envelope-o"></i> <b>อีเมล : </b><?=$student['stu_email'];?></li>
						<li><img src="img/fb.gif" width="16"> <b>Facebook : </b><a href="https://www.facebook.com/<?=$student['stu_facebook'];?>" target="_blank"><?=$student['stu_facebook'];?></a></li>
						<li><img src="img/line.gif" width="16"> <b>LINE ID : </b><a href="http://line.me/ti/p/~<?=$student['stu_line'];?>" target="_blank"><?=$student['stu_line'];?></a></li>
					</ul>
				</p>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12 about-me-text pl-lg-5">
				<p class="lead my-12"><h4><i class="fa fa-map"></i> ที่อยู่ปัจจุบัน</h4></p>
			</div>
		</div>		

		<div class="row">
			<div class="col-lg-12">
<!--			<p class="lead my-4"><h4 style="color:#9C27B0;"><i class="fa fa-map"></i> ที่อยู่ปัจจุบัน</h4></p> -->
				<div id="map"></div>
				<script>
				var marker;
				var map;
				var infowindow;
				function initMap() {
//					var icon_image = '<?=$image_profile;?>';
					var icon_image = "<img width='100' height='100' src='<?=$image_profile;?>' style='border-radius:50%;'>";
					var icon_marker = {url:'img/pin_user.png',
						scaledSize: new google.maps.Size(70, 70), // scaled size
						origin: new google.maps.Point(0,0), // origin
						anchor: new google.maps.Point(35, 70) // anchor
					};
					var location = {lat: <?=$stu_latitude;?>, lng: <?=$stu_longtitude ?>};
					map = new google.maps.Map(document.getElementById('map'), {
						zoom: 16,
						center: location
					});
					infowindow = new google.maps.InfoWindow({
						content: icon_image+'<br>'+'<div style="margin:0 auto;text-align:center;"><b><?=$_SESSION[$config->session_id_username];?></b></div>',
						position:  location,
						map: map
					});
					var marker = new google.maps.Marker({
						position: location,
						map: map,
						icon: icon_marker,
						animation: google.maps.Animation.DROP,
						title: 'คุณอยู่ที่นี่ : <?=$_SESSION[$config->session_id_username];?>',
						html: icon_image+'<br>'+'<div style="margin:0 auto;text-align:center;"><b><?=$_SESSION[$config->session_id_username];?></b></div>'
					});
//					marker.setIcon(icon_marker);
					marker.addListener('click', function() {
						infowindow.setContent(this.html);
						infowindow.open(map,this);
					});
				}
				</script>
				<script async defer src="<?=$config->google_map_api;?>"></script>
			</div>
		</div> <!-- END row-->
	</div> <!-- END container-->
</section> <!-- END about-me-->

<?php require("section_button.php");?>	
</main>
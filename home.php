<?php
@session_start();
if(!isset($config)) include("configuration.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="#ssru80th #แก้วรวมช่อ 80 ปี มหาวิทยาลัยราชภัฏสวนสุนันทา สำหรับศิษย์เก่าที่สำเร็จการศึกษาจากมหาวิทยาลัยราชภัฏสวนสุนันทา เนื่องในโอกาสครบรอบ 80 ปีของมหาวิทยาลัยราชภัฏสวนสุนันทา โดยจะเป็นการจัดเก็บและรวบรวมข้อมูลศิษย์เก่าเอาไว้ และเพื่อให้เพื่อนร่วมรุ่นสามารถที่จะติดต่อสื่อสารกันได้จากแอปพลิเคชันนี้">
<meta name="author" content="ลาภ พุ่มหิรัญ">
<meta property="og:type" content="website" />
<meta property="og:title" content="แก้วรวมช่อ 80 ปี สวนสุนันทา" />
<meta property="og:description" content="#ssru80th #แก้วรวมช่อ 80 ปี มหาวิทยาลัยราชภัฏสวนสุนันทา สำหรับศิษย์เก่าที่สำเร็จการศึกษาจากมหาวิทยาลัยราชภัฏสวนสุนันทา เนื่องในโอกาสครบรอบ 80 ปีของมหาวิทยาลัยราชภัฏสวนสุนันทา โดยจะเป็นการจัดเก็บและรวบรวมข้อมูลศิษย์เก่าเอาไว้ และเพื่อให้เพื่อนร่วมรุ่นสามารถที่จะติดต่อสื่อสารกันได้จากแอปพลิเคชันนี้" />
<meta property="og:url" content="https://reg.ssru.ac.th/ssru80th/home.php" />
<meta property="og:image" content="https://reg.ssru.ac.th/ssru80th/img/screen.png" />
<meta property="fb:app_id" content="140683473241028">
<link rel="icon" href="img/favicon.ico" type="image/ico" sizes="32x32">
<title>แก้วรวมช่อ 80 ปี มหาวิทยาลัยราชภัฏสวนสุนันทา</title>
<style type="text/css">
	@font-face {
    font-family: Kanit;
    src: url('fonts/Kanit/Kanit-Regular.ttf');
}
html, body{
	margin:0; padding:0; width:100%; height:100%;
	font-family: Kanit,Helvetica,Arial,sans-serif !important;
	font-size: 12pt;
}
</style>
<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css" >
<!-- Custom fonts for this template -->
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/simple-line-icons.css">
<!--
<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
-->
<!-- Plugin CSS -->
<link rel="stylesheet" href="device-mockups/device-mockups.min.css">
<!-- Custom styles for this template -->
<link href="css/new-age.min.css" rel="stylesheet">
</head>
<body id="page-top">
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
	<div class="container">
		<a class="navbar-brand js-scroll-trigger" href="#page-top">แก้วรวมช่อ</a>
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item"><a class="nav-link js-scroll-trigger" href="#download">ดาวน์โหลด</a></li>
				<li class="nav-item"><a class="nav-link js-scroll-trigger" href="#features">ฟีเจอร์</a></li>
				<li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contact">ติดต่อเรา</a></li>
			</ul>
		</div>
	</div>
</nav>

<header class="masthead">
<div class="container h-100">
	<div class="row h-100">
		<div class="col-lg-7 my-auto">
			<div class="header-content mx-auto text-center">
				<img src="img/logo.png" class="img-fluid">
				<h1 class="mb-5"></h1>
				<a href="index.php?view=login" class="btn btn-outline btn-lg" style="font-size:32pt;">เข้าสู่ระบบ</a>
			</div>
		</div>
		<div class="col-lg-5 my-auto">
			<div class="device-container">
				<div class="device-mockup iphone6_plus portrait white">
					<div class="device">
						<div class="screen"><img src="img/screen.png" class="img-fluid" alt=""></div>
						<div class="button"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</header>

<section class="download bg-pink text-center" id="download">
<div class="container">
	<div class="row">
		<div class="col-md-12 mx-auto">
			<h2 class="section-heading"><i class="fa fa-users"></i><br>ค้นหาเพื่อน ๆ ร่วมห้องของคุณ</h2>
			<p><br></p>
			<div class="row">
			<div class="col-lg-3 badges">&nbsp;</div>

			<div class="col-lg-3 badges">
				<a class="badge-link" href="<?=$config->ios_app_link;?>" target="_blank"><img src="img/appstore.png" alt="" class="img-fluid"></a>
				<br><br>
				<a class="badge-link" href="<?=$config->android_app_link;?>" target="_blank"><img src="img/playstore.png" alt="" class="img-fluid"></a>
				<br><br>
			</div>

			<div class="col-lg-3 badges">
				<a class="badge-link" href="https://goo.gl/FbeVav" target="_blank"><img src="img/qrcode.jpg" style="width:140px;height:140px" alt="" class="img-fluid"></a>
			</div>

			<div class="col-lg-3 badges">&nbsp;</div>

			</div>
		</div>
	</div>
</div>
</section>

<section class="features" id="features">
<div class="container">
	<div class="row">
		<div class="col-lg-4 my-auto">
			<div class="device-container">
				<div class="device-mockup iphone6_plus portrait black">
					<div class="device">
						<div class="screen"><img src="img/screen.gif" class="img-fluid" alt=""></div>
						<div class="button"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-8 my-auto">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-6">
						<div class="feature-item">
							<i class="icon-people text-primary"></i>
							<h3>ค้นหาเพื่อน ๆ</h3>
							<p class="text-muted">ค้นหาเพื่อน ๆ ร่วมห้องของคุณ</p>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="feature-item">
							<i class="icon-map text-primary"></i>
							<h3>แผนที่</h3>
							<p class="text-muted">ดูแผนที่เพื่อค้นหาเพื่อน ๆ ที่อยู่ใกล้เคียงกับคุณ</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<div class="feature-item">
							<i class="icon-picture text-primary"></i>
							<h3>รูปภาพ</h3>
							<p class="text-muted">ดูรูปภาพเพื่อน ๆ ของคุณ</p>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="feature-item">
							<i class="icon-screen-smartphone text-primary"></i>
							<h3>แอปพลิเคชันบนมือถือ</h3>
							<p class="text-muted">รองรับทั้ง iOS และ Android</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
<section class="download  bg-pink text-center" id="download">
<div class="container">
	<div class="row">
		<div class="col-md-12 mx-auto">
			<h3 class="section-heading"><i class="fa fa-download"></i> ดาวน์โหลดคู่มือการใช้งาน</h3>
			<p><br></p>
			<div class="row">
				<div class="col-lg-12">
					<a href="manual_ios.pdf" target="_blank" role="button" class="btn btn-primary"><i class="fa fa-apple"></i> iOS</a>
					<a href="manual_android.pdf" target="_blank" role="button" class="btn btn-primary"><i class="fa fa-android"></i> Android</a>
					<a href="manual_web.pdf" target="_blank" role="button" class="btn btn-primary"><i class="fa fa-globe"></i> Web</a>

				</div>
			</div>
		</div>
	</div>
</div>
</section>
<section class="contact bg-violet" id="contact">
<div class="container" align="center">
	<h2>ติดต่อเรา</h2>
	<ul class="list-inline list-social">
		<li class="list-inline-item social-facebook">	<a href="https://www.facebook.com/ssru80th" target="_blank"><i class="fa fa-facebook"></i></a></li>
	</ul>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = 'https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.11&appId=140683473241028';
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<br><div class="fb-like" data-href="https://reg.ssru.ac.th/ssru80th/" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
	<br><br><div style="background-color:white; max-width:600px; min-width:300px;"><fb:comments colorscheme="light" numposts="5" href="https://reg.ssru.ac.th/ssru80th/"></fb:comments></div>
  </div>
</div>
</section>
<footer class="text-white">
<div class="container">
<p>&copy; <?=(date('Y')+543);?> แก้วรวมช่อ 80 ปี มหาวิทยาลัยราชภัฏสวนสุนันทา</p><p>&nbsp;</p>
</div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>

<!-- Plugin JavaScript -->
<script src="js/jquery.easing.min.js"></script>

<!-- Custom scripts for this template -->
<script src="js/new-age.min.js"></script>

</body>
</html>
<?php
include("analyticstracking.php");
?>
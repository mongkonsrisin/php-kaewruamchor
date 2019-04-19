<!-- profile_edit.php -->
<?php require("check_login.php"); ?>
<?php
if(isset($_POST['edit']) || isset($_POST['edit1']) || isset($_POST['edit2']) || isset($_POST['edit3']))
{
	$stu_prefix = $_POST['stu_prefix'];
	$engfname = $_POST['engfname'];
	$englname = $_POST['englname'];
	$status = $_POST['status'];
	$job = $_POST['job'];
	$housenumber = $_POST['housenumber'];
	$moo = $_POST['moo'];
	$alley = $_POST['alley'];
	$street = $_POST['street'];
	$district = $_POST['district'];
	$amphoe = $_POST['amphoe'];
	$province = $_POST['province'];
	$zipcode = $_POST['zipcode'];
	$phonenumber = $_POST['phonenumber'];
	$email = $_POST['email'];
	$facebook = $_POST['facebook'];
	$line = $_POST['line'];
	$profile = $_POST['profileimg'];
	if(isset($_POST['stu_latitude']))
		$latitude = $_POST['stu_latitude'];
	else
		$latitude=$stu_latitude;
	if(isset($_POST['stu_longtitude']))
		$longtitude = $_POST['stu_longtitude'];
	else
		$longtitude=$stu_longtitude;
	
	if(empty($_FILES['fileInput']['name']))
	{
		$update_image="";
	}
	else
	{
		$img = $_POST['profileimg'];
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$file_upload=addslashes($data);
		$update_image=" stu_photo='$file_upload', ";
	}

	$sql2= "UPDATE student SET
	stu_prefix='$stu_prefix',
	stu_engfname='$engfname',
	stu_englname='$englname' ,
	stu_job='$job' ,
	$update_image 
	stu_status='$status' ,
	stu_housenumber='$housenumber' ,
	stu_moo='$moo' ,
	stu_alley='$alley' ,
	stu_street='$street' ,
	stu_district='$district' ,
	stu_amphur='$amphoe' ,
	stu_province='$province' ,
	stu_zipcode='$zipcode' ,
	stu_phonenumber='$phonenumber' ,
	stu_email='$email' ,
	stu_facebook='$facebook' ,
	stu_line='$line' ,
	stu_latitude=$latitude ,
	stu_longtitude=$longtitude 
	WHERE stu_fname='".trim($_SESSION["session_id_fname"])."' and stu_lname='".trim($_SESSION["session_id_lname"])."' ";
	$stmt2 = $con->prepare($sql2);
	$stmt2->execute();
//	echo '<script>swal("แจ้งเตือน", "บันทึกข้อมูลเรียบร้อยแล้ว", "success");</script>';
/*
	if(isset($_POST['edit']))
	{
		echo "<head><meta http-equiv='refresh' content='0;url=index.php?view=profile'></head>";
		exit();
	}
	if(isset($_POST['edit1']) || isset($_POST['edit2']) || isset($_POST['edit3']))
	{
		echo "<head><meta http-equiv='refresh' content='0;url=index.php?view=profile_edit'></head>";
		exit();
	}
*/
	echo "<head><meta http-equiv='refresh' content='0;url=index.php?view=profile'></head>";
	exit();
}
?>

<link rel="stylesheet" href="css/jquery.Thailand.min.css">
<link rel="stylesheet" href="css/ng-img-crop.css"/>
<style>
label { font-weight: bold; }
#fileInput{ display:none; }
input[type="text"]:disabled {
	/*override Input disable color because jQuery Thailand ruin it !*/
	background: lightgray !important;
}
.pac-card {
	margin: 10px 10px 0 0;
	border-radius: 2px 0 0 2px;
	box-sizing: border-box;
	-o-box-sizing: border-box;
	-moz-box-sizing: border-box;
	-webkit-box-sizing: border-box;
	outline: none;
	box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
	background-color: #fff;
	font-family: Roboto;
}
#pac-container { padding-bottom: 12px; margin-right: 12px; }
.pac-controls { display: inline-block; padding: 5px 11px; }
.pac-controls label { font-family: Roboto; font-size: 13px; font-weight: 300; }
#pac-input {
	background-color: #fff;
	font-family: Roboto;
	font-size: 15px;
	font-weight: 300;
	margin-left: 12px;
	padding: 0 11px 0 13px;
	text-overflow: ellipsis;
	width: 50%;
	margin-top: 10px;
}
#pac-input:focus { border-color: #4d90fe; }
</style>

<?php require("profile_header.php");?>

<form name="formEdit" id="formEdit" action="index.php" method="post" enctype="multipart/form-data">
<main class="content-wrap">
<section class="about-me" id="about">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 about-me-text pl-lg-5">
				<p class="lead my-4">
					<h4><i class="fa fa-book"></i> ข้อมูลการศึกษา</h4>
					<?php require("profile_education.php");?>
				</p>
				
				<p class="lead my-4">
					<h4><i class="fa fa-drivers-license-o"></i> ข้อมูลส่วนตัว</h4>
					<div class="form-group"><label>คำนำหน้าชื่อ</label>
						<select class="form-control custom-select select-small" name="stu_prefix" id="exampleFormControlSelect1">
							<option>กรุณาเลือก...</option>
							<option <?=(trim($student["stu_prefix"])=="นาย")?" selected ":"";?> value="นาย">นาย</option>
							<option <?=(trim($student["stu_prefix"])=="นางสาว")?" selected ":"";?> value="นางสาว">นางสาว</option>
							<option <?=(trim($student["stu_prefix"])=="นาง")?" selected ":"";?> value="นาง">นาง</option>	
						</select>
					</div>
					<div class="form-group"><label>ชื่อภาษาอังกฤษ</label><input type="text" name="engfname" class="form-control" value="<?=$student["stu_engfname"];?>"></div>
					<div class="form-group"><label>นามสกุลภาษาอังกฤษ</label><input type="text" name="englname" class="form-control" value="<?=$student["stu_englname"];?>"></div>
					<div class="form-group"><label>อาชีพ</label>
						<select class="form-control custom-select select-small" name="job" id="exampleFormControlSelect1">
<?php
						$sql="SELECT * FROM occupation";
						$stmt = $con->prepare($sql);
						$stmt->execute();
						$result = $stmt->get_result();
						while($row2 = $result->fetch_assoc())
						{
							$selected=(trim($student["stu_job"])==trim($row2["oc_desc"]))?" selected ":"";
?>
							<option value="<?=$row2['oc_desc'];?>" <?=$selected;?>> <?=$row2['oc_desc'];?> </option>
<?php 
						}
?>
						</select>
					</div>
<?php
					if (intval($student["stu_status"]) == 0){ $status2 = "checked"; $status1 = ""; }
					else { $status1 = "checked"; $status2 = ""; }
?>
					<div class="form-group"><label>สถานะ</label><br>
						<label class="custom-control custom-radio" name="status">
						 <input <?=$status1; ?> id="radio1" name="status" type="radio" class="custom-control-input" value="1" <?php if($student['stu_status']=="alive"){ echo "checked"; }?>><span class="custom-control-indicator"></span> <span class="custom-control-description">มีชีวิต</span></label>
						<label class="custom-control custom-radio"><input <?=$status2; ?> id="radio2" name="status" type="radio" class="custom-control-input" value="0" <?php if($student['stu_status']=="dead"){ echo "checked"; }?>><span class="custom-control-indicator"></span> <span class="custom-control-description">ถึงแก่กรรม</span></label>
					</div>
<!--					<div align="center"><button name="edit1" class="btn btn-success btn-lg" type="submit"><i class="fa fa-save"></i> บันทึก</button></div> -->
				</p>
				<p class="lead my-4">
					<h4 id="your_image_profile"><i class="fa fa-image"></i> รูปโปรไฟล์</h4>
					<script>
					function chooseImageProfile()
					{
						document.getElementById("image_preview_box").style.display="none";
						document.getElementById("image_new").style.display="block";
						document.formEdit.fileInput.click();
					}
					</script>
					<div class="col-lg-12" align="center">
						<input type="file" name="fileInput" multiple="multiple" id="fileInput" />
						<a href="#your_image_profile" onclick="chooseImageProfile();" role="button" class="btn btn-success btn-lg" id="btn_logout"><i class="fa fa-cloud-upload"></i> เปลี่ยนรูปโปรไฟล์</a><br>
						<div id="image_preview_box" align="center"><img src="<?=$image_profile;?>" width="250"></div>
						<span id="image_new" style="display:none;"><img-crop image="myImage" result-image="myCroppedImage"></img-crop></span>
						<input type="hidden" name="profileimg" value="{{myCroppedImage}}">
					</div>
				</p>
			</div>
			
			<div class="col-lg-6 about-me-text pl-lg-5">
				<p class="lead my-4">
					<h4><i class="fa fa-envelope"></i> ข้อมูลติดต่อ</h4>
					<div class="form-group">
						<label class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="foreign" onclick="javascript:checkForeign();"><span class="custom-control-indicator"></span> <span class="custom-control-description">พักอาศัยอยู่ต่างประเทศ</span></label>
					</div>
					<div class="form-group"><label>บ้านเลขที่</label><input type="text" class="form-control" name="housenumber" id="housenumber"value="<?=$student["stu_housenumber"];?>"></div>
					<div class="form-group"><label>หมู่</label><input type="text" class="form-control" name="moo" id="moo" value="<?=$student["stu_moo"];?>"></div>
					<div class="form-group"><label>ซอย</label><input type="text" class="form-control" name="alley" id="alley" value="<?=$student["stu_alley"];?>"></div>
					<div class="form-group"><label>ถนน</label><input type="text" class="form-control" name="street" id="street" value="<?=$student["stu_street"];?>"></div>
					<div class="form-group"><label>แขวง/ตำบล</label><input type="text" class="form-control" name="district" id="district"  value="<?=$student["stu_district"];?>"></div>
					<div class="form-group"><label>เขต/อำเภอ</label><input type="text" class="form-control" name="amphoe" id="amphoe" value="<?=$student["stu_amphur"];?>"></div>
					<div class="form-group"><label>จังหวัด</label><input type="text" class="form-control" name="province" id="province" value="<?=$student["stu_province"];?>"></div>
					<div class="form-group"><label>รหัสไปรษณีย์</label><input type="text" class="form-control" name="zipcode" id="zipcode" value="<?=$student["stu_zipcode"];?> "></div>
					<div class="form-group"><label><i class="fa fa-phone" style="color:#339933;"></i> เบอร์โทรศัพท์</label><input type="text" class="form-control" name="phonenumber" value="<?=$student["stu_phonenumber"];?>" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}"  maxlength="10"></div>
					<div class="form-group"><label><i class="fa fa-envelope-o"></i> อีเมล</label><input type="text" class="form-control" name="email" value="<?=$student["stu_email"];?>"></div>
					<div class="form-group"><label><img src="img/fb.gif" width="16"> Facebook</label><input type="text" class="form-control" name="facebook" value="<?=$student["stu_facebook"];?>"></div>
					<div class="form-group"><label><img src="img/line.gif" width="16"> LINE ID</label><input type="text" class="form-control" name="line" value="<?=$student["stu_line"];?>"></div>
<!--					<div align="center"><button name="edit2" class="btn btn-success btn-lg" type="submit"><i class="fa fa-save"></i> บันทึก</button></div> -->
				</p>
			</div>
			
			<div class="col-lg-12 about-me-text pl-lg-5">
				<p class="lead my-4">
					<h4><i class="fa fa-map"></i> กำหนดที่อยู่ปัจจุบัน</h4>
					<span>คลิกหรือแตะ 1 ครั้งบนแผนที่ เพื่อเลือกที่อยู่ปัจจุบัน</span><br><br>
					<div id="map"></div>
					<input id="pac-input" class="controls" type="text" placeholder="พิมพ์เพื่อค้นหาที่อยู่">
					<script>
					var marker;
					var map;
					var infowindow;
					function initMap() {
//						var icon_image = '<?=$image_profile;?>';
						var icon_image = "<img width='100' height='100' src='<?=$image_profile;?>' style='border-radius:50%;'>";
						var icon_marker = {url:'img/pin_user.png',
							scaledSize: new google.maps.Size(70, 70), // scaled size
							origin: new google.maps.Point(0,0), // origin
							anchor: new google.maps.Point(35, 70) // anchor
						};
						var location = {lat: <?=$stu_latitude;?>, lng: <?=$stu_longtitude;?>};
						map = new google.maps.Map(document.getElementById('map'), { zoom: 14, center: location });
						// Create the search box and link it to the UI element.
						var input = document.getElementById('pac-input');
						var searchBox = new google.maps.places.SearchBox(input);
						map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
						// Bias the SearchBox results towards current map's viewport.
						map.addListener('bounds_changed', function() { searchBox.setBounds(map.getBounds()); });
						var markers = [];
						// Listen for the event fired when the user selects a prediction and retrieve
						// more details for that place.
						searchBox.addListener('places_changed', function() {
							var places = searchBox.getPlaces();
							if(places.length == 0) { return; }
							// Clear out the old markers.
							markers.forEach(function(marker) { marker.setMap(null); });
							markers = []; 
							// For each place, get the icon, name and location.
							var bounds = new google.maps.LatLngBounds();
							places.forEach(function(place) {
								if (!place.geometry) { console.log("Returned place contains no geometry"); return; }
								var icon = { url: place.icon,
									size: new google.maps.Size(71, 71),
									origin: new google.maps.Point(0, 0),
									anchor: new google.maps.Point(17, 34),
									scaledSize: new google.maps.Size(25, 25)
								};
								// Create a marker for each place.
								markers.push(new google.maps.Marker({
									map: map,
									icon: icon,
									title: place.name,
									position: place.geometry.location
								}));
								if (place.geometry.viewport) {
									// Only geocodes have viewport.
									bounds.union(place.geometry.viewport);
								} else { bounds.extend(place.geometry.location); }
							});
							map.fitBounds(bounds);
						});
						marker = new google.maps.Marker({ position: location,
							map: map,
							icon: icon_marker,
							animation: google.maps.Animation.DROP,
							title: 'คุณอยู่ที่นี่ : <?=$_SESSION[$config->session_id_username];?>',
							html: icon_image+'<br>'+'<div style="margin:0 auto;text-align:center;"><b><?=$_SESSION[$config->session_id_username];?></b></div>'
						});
						infowindow = new google.maps.InfoWindow({ map:map, 
							content: icon_image+'<br>'+'<div style="margin:0 auto;text-align:center;"><b><?=$_SESSION[$config->session_id_username];?></b></div>',
							position:  new google.maps.LatLng(<?=$stu_latitude;?>,<?=$stu_longtitude;?>) 
						});
						marker.addListener('click', function() {
							infowindow.setContent(this.html);
							infowindow.open(map,this);
						});
						//When map is clicked
						map.addListener('click', function(event) {
							placeMarker(event.latLng, map);
							var html = '';
							html += '<h5>พิกัด</h5>';
							html += '<br> <b>ละติจูด : </b><span id="lat">' + event.latLng.lat() + '</span>';
							html += '<br> <b>ลองติจูด : </b><span id="lng">' + event.latLng.lng() + '</span>';
							html += '<br><br> <button class="btn btn-success btn-sm" onclick="saveLatLng();">บันทึก</button>';
							infowindow.open(map,marker);
							infowindow.setContent(html);
							infowindow.setPosition(event.latLng);
						});
					} //End init map
					//Place marker func
					function placeMarker(position, map) {
						if (marker) {
							marker.setPosition(position);
						} else {
							marker = new google.maps.Marker({ position: position, map: map });
						}
					}
					function saveLatLng(){
						var id = <?=$_SESSION[$config->session_id_name];?>;
						var lat = $("#lat").text();
						var lng = $("#lng").text();

						var newfield = document.createElement("input");
						newfield.setAttribute("type", "hidden");
						newfield.setAttribute("name", "stu_latitude");
						newfield.setAttribute("id", "stu_latitude");
						newfield.setAttribute("value", lat);
						document.getElementById("formEdit").appendChild(newfield);

						var newfield = document.createElement("input");
						newfield.setAttribute("type", "hidden");
						newfield.setAttribute("name", "stu_longtitude");
						newfield.setAttribute("id", "stu_longtitude");
						newfield.setAttribute("value", lng);
						document.getElementById("formEdit").appendChild(newfield);

						var newfield = document.createElement("input");
						newfield.setAttribute("type", "hidden");
						newfield.setAttribute("name", "edit3");
						newfield.setAttribute("id", "edit3");
						newfield.setAttribute("value", "");
						document.getElementById("formEdit").appendChild(newfield);


						document.formEdit.submit();
/*
						$.ajax({
							method : "POST",
							url: "profile_update_location.php",
							data: { lat:lat, lng:lng,id:id }
						}).done(function(text){
							swal("แจ้งเตือน", "บันทึกพิกัดที่อยู่ปัจจุบันของคุณแล้ว", "success");
							infowindow.close();
						});
*/
					}
					</script>
					<script async defer src="<?=$config->google_map_api;?>"></script>
				</p>
			</div>
		</div> <!-- END row-->
	</div> <!-- END container-->
</section> <!-- END about-me-->

<section>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 button-group">
				<a href="index.php?view=profile" role="button" class="btn btn-secondary btn-lg"><i class="fa fa-close"></i> ย้อนกลับ</a>
				<button name="edit" class="btn btn-success btn-lg" type="submit"><i class="fa fa-save"></i> บันทึก</button>
			</div>
		</div>
	</div>
</section>
</main> <!-- END content-wrap-->
</form>

<script type="text/javascript" src="js/angular.min.js"></script>
<script type="text/javascript" src="js/ng-img-crop.js"></script>
<script>
function checkForeign()
{
	if(document.getElementById('foreign').checked)
	{
		// Is foreign
		document.getElementById('housenumber').setAttribute('disabled','disabled');
		document.getElementById('housenumber').value = "";
		document.getElementById('moo').setAttribute('disabled','disabled');
		document.getElementById('moo').value = "";
		document.getElementById('alley').setAttribute('disabled','disabled');
		document.getElementById('alley').value = "";
		document.getElementById('street').setAttribute('disabled','disabled');
		document.getElementById('street').value = "";
		document.getElementById('district').setAttribute('disabled','disabled');
		document.getElementById('district').value = "";
		document.getElementById('amphoe').setAttribute('disabled','disabled');
		document.getElementById('amphoe').value = "";
		document.getElementById('province').setAttribute('disabled','disabled');
		document.getElementById('province').value = "";
		document.getElementById('zipcode').setAttribute('disabled','disabled');
		document.getElementById('zipcode').value = "";
	}
	else
	{
		// Is in Thailand
		document.getElementById('housenumber').removeAttribute('disabled');
		document.getElementById('moo').removeAttribute('disabled');
		document.getElementById('alley').removeAttribute('disabled');
		document.getElementById('street').removeAttribute('disabled');
		document.getElementById('district').removeAttribute('disabled');
		document.getElementById('amphoe').removeAttribute('disabled');
		document.getElementById('province').removeAttribute('disabled');
		document.getElementById('zipcode').removeAttribute('disabled');
		document.getElementById('housenumber').value = "";
		document.getElementById('moo').value = "";
		document.getElementById('alley').value = "";
		document.getElementById('street').value = "";
		document.getElementById('district').value = "";
		document.getElementById('amphoe').value = "";
		document.getElementById('province').value = "";
		document.getElementById('zipcode').value = "";
	}
}
</script>
<script>
	angular.module('app', ['ngImgCrop'])
	.controller('Ctrl', function($scope) {
	$scope.myImage='';
	$scope.myCroppedImage='';
	$scope.selMinSize=250;
	$scope.resImgSize=250;
	var handleFileSelect=function(evt) {
		var file=evt.currentTarget.files[0];
		var reader = new FileReader();
		reader.onload = function (evt) {
			$scope.$apply(function($scope){ $scope.myImage=evt.target.result; });
		};
		reader.readAsDataURL(file);
	};
	angular.element(document.querySelector('#fileInput')).on('change',handleFileSelect);
});
</script>

<?php
if(trim($student["stu_housenumber"])=="" && trim($student["stu_moo"])=="" && trim($student["stu_alley"])=="" && trim($student["stu_street"])=="" && trim($student["stu_district"])=="" && trim($student["stu_amphur"])=="" && trim($student["stu_province"])=="")
{
	echo "<script>document.getElementById('foreign').checked=true; checkForeign();</script>";
}
?>
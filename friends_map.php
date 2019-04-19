<!-- map_friends.php -->
<?php require("check_login.php"); ?>
<?php require("profile_header.php");?>
<div class="fab-share" onclick="alert('share')"></div>

<main class="content-wrap">
<section class="about-me" id="about">
	<div class="container">
		<div class="row">
			<h2 class="map-heading"><i class="fa fa-map"></i> แผนที่เพื่อน</h2>
			<div class="col-lg-12">
				<div id="map"></div>			
				<script>
				var marker;
				var map;
				var infowindow;
				function initMap() {
//					var icon_image = '<?=$image_profile;?>';
					var icon_image = "<img width='100' height='100' src='<?=$image_profile;?>' style='border-radius:50%;'>";
					var location = {lat: <?=$stu_latitude;?>, lng: <?=$stu_longtitude ?>};
					map = new google.maps.Map(document.getElementById('map'), {
						zoom: 12,
						center: location
					});
					infowindow = new google.maps.InfoWindow({
						content: icon_image+'<br>'+'<div style="margin:0 auto;text-align:center;"><b><?=$_SESSION[$config->session_id_username];?></b></div>',
						position:  location,
						map: map
					});
					selectLocation('<?=$student["stu_facultyid"];?>','<?=$student["stu_majorid"];?>','<?=$student["stu_levelid"];?>','<?=$student["stu_catid"];?>','<?=$student["stu_sec"];?>','<?=$student["stu_year"];?>');
				}
				var facultyid;
				var majorid;
				var levelid;
				var catid;
				var sec;
				var year;
				function selectLocation(facultyid,majorid,levelid,catid,sec,year){
					$.ajax({
						type:"GET",
						url: "json_get_friend_location.php",
						data: ({ facultyid: facultyid,majorid:majorid,levelid:levelid,catid:catid,sec:sec,year:year })
					}).done(function(text){
						var json = $.parseJSON(text);
						for(var i = 0 ;i<json.length;i++){
							var latitude = json[i].stu_latitude;
							var longtitude = json[i].stu_longtitude;
							var stuPhoto = json[i].stu_photo;
							if (stuPhoto == "") {
								stuPhoto = "img/profile.png";
							} else {
								stuPhoto = "data:image/jpeg;base64,"+stuPhoto;
							}
							var fullname = json[i].stu_fname + '&nbsp;' +  json[i].stu_lname;
							if (latitude!="" && longtitude != "") {
								//Have location
								var latlng = new google.maps.LatLng(latitude,longtitude);
								var img = "<a href='index.php?view=profile_friend_popup&back=friends_map&id="+ json[i].stu_id +"'><img width='100' height='100' src="+stuPhoto+" style='border-radius:50%;'></a>"
								var markeroption = {map:map, html:img+'<br>'+'<div style="margin:0 auto;text-align:center;"><b>'+fullname+'</b></div>', position:latlng};
								var marker = new google.maps.Marker(markeroption);
								if (json[i].stu_id == <?=$_SESSION[$config->session_id_name];?>) {
									var icon = {url:'img/pin_user.png',
										scaledSize: new google.maps.Size(70, 70), // scaled size
										origin: new google.maps.Point(0,0), // origin
										anchor: new google.maps.Point(35, 70) // anchor
									};
									marker.setIcon(icon);
								};
								google.maps.event.addListener(marker,'click',function(e){
									infowindow.setContent(this.html);
									infowindow.open(map,this);
								});
							} else { //No location 
							}
						} // end of for
					});
				}
			</script>
			<script async defer src="<?=$config->google_map_api;?>"></script>
		</div>
    </div> <!-- END row-->
  </div> <!-- END container-->
</section> <!-- END about-me-->

<?php require("section_button.php");?>	
</main> <!-- END content-wrap-->
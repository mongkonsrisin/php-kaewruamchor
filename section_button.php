	<section id="all_button">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 button-group">
<?php
					if($_SESSION["view"]=="profile_friend_popup")
					{
						if(isset($_GET["back"]))
							echo '<a href="index.php?view='.$_GET["back"].'" role="button" class="btn btn-secondary btn-lg"><i class="fa fa-close"></i> ย้อนกลับ</a>';
						else
							echo '<a href="index.php?view=friends_map" role="button" class="btn btn-secondary btn-lg"><i class="fa fa-close"></i> ย้อนกลับ</a>';
					}
					else
					{
?>
					<?php if($_SESSION["view"]!="profile") echo '<a href="?view=profile" role="button" class="btn btn-primary btn-lg" id="btn_edit"><i class="fa fa-drivers-license-o"></i> ข้อมูลศิษย์เก่า</a>'; ?>
					<?php if($_SESSION["view"]!="profile_edit") echo '<a href="?view=profile_edit" role="button" class="btn btn-info btn-lg" id="btn_edit"><i class="fa fa-edit"></i> แก้ไขข้อมูล</a>'; ?>
					<?php if($_SESSION["view"]!="friends_map") echo '<a href="?view=friends_map" role="button" class="btn btn-lg" id="btn_map" style="color:#ffffff; background-color:#339933; border-color:#339933;"><i class="fa fa-map"></i> แผนที่เพื่อน</a>'; ?>
					<?php if($_SESSION["view"]!="friends") echo '<a href="?view=friends" role="button" class="btn btn-warning btn-lg" id="btn_friends"><i class="fa fa-users"></i> เพื่อนร่วมรุ่น</a>'; ?>
					<a href="?view=logout" role="button" class="btn btn-danger btn-lg" id="btn_logout"><i class="fa fa-power-off"></i> ออกจากระบบ</a>
<?php
					}
?>
				</div>
			</div>
		</div>
	</section>
<!-- Bootstrap core JavaScript -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>

<!-- Plugin JavaScript -->
<script src="js/jquery.easing.min.js"></script>

<!-- Custom scripts for this template -->
<script src="js/new-age.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/lightbox.min.js"></script>
<script src="js/select2.min.js"></script>
<script src="js/sweetalert.min.js"></script>
<script type="text/javascript" src="js/ajax.js" ></script>

<?php if($_SESSION["view"]!="login" && $_SESSION["view"]!="profile_edit" && $_SESSION["view"]!="register"){ ?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.11&appId=<?=$config->facebook_app_id;?>';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<style>#shareBtn:hover { cursor: pointer; }</style>

<script>
function sharePage()
{
	document.getElementById('shareBtn').onclick = function() {
	  FB.ui({
		method: 'share',
		mobile_iframe: true,
		display: 'popup',
		hashtag: '<?=$config->facebook_hashtag;?>',
		href: '<?=$config->website;?>facebooksharefriends.php/<?=$id;?>/<?=$key_hash;?>',
	  }, function(response){});
	}
}
</script>
<div id="shareBtn" class="fab-share" onClick="javascript:sharePage();" title="แชร์หน้านี้"></div>
<?php } ?>

<?php if($_SESSION["view"]=="login" || $_SESSION["view"]=="register"){ ?>
<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="js/bootstrap-datepicker.th.js"></script>
<script type="text/javascript" src="js/bootstrap-datepicker.thai.js"></script>
<script>
$('#pass').datepicker({ format: "dd/mm/yyyy", autoclose: true });
</script>
<?php } ?>

<?php if($_SESSION["view"]=="profile_edit"){ ?>
<!-- dependencies for zip mode -->
<script type="text/javascript" src="js/zip.js/zip.js"></script>
<!-- / dependencies for zip mode -->
<script type="text/javascript" src="js/JQL.min.js"></script>
<script type="text/javascript" src="js/typeahead.bundle.js"></script>
<script type="text/javascript" src="js/jquery.Thailand.min.js"></script>
<script type="text/javascript">
$.Thailand({
	database: 'database/db.json', // path หรือ url ไปยัง database
	$district: $('#district'), // input ของตำบล
	$amphoe: $('#amphoe'), // input ของอำเภอ
	$province: $('#province'), // input ของจังหวัด
	$zipcode: $('#zipcode'), // input ของรหัสไปรษณีย์
});
</script>
<?php } ?>

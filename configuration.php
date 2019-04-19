<?php
class SysConfig {
	public $debug = 1;  // 1 is open debug ,  0 is close debug
	public $web_server_name = 'web1';
	public $facebook_app_id = '140683473241028';
	public $facebook_image = 'https://reg.ssru.ac.th/ssru80th/img/screen.png';
	public $facebook_url = 'https://reg.ssru.ac.th/ssru80th/home.php';
	public $facebook_hashtag='#แก้วรวมช่อ';
	public $website = 'https://reg.ssru.ac.th/ssru80th/';
//	public $website = 'http://localhost:81/ssru80th/';
	public $website_name='แก้วรวมช่อ 80 ปี มหาวิทยาลัยราชภัฏสวนสุนันทา';
	public $website_footer_line1='แก้วรวมช่อ 80 ปี มหาวิทยาลัยราชภัฏสวนสุนันทา';
	public $website_footer_line2='เลขที่ 1 ถนนอู่ทองนอก แขวงวชิระ เขตดุสิต กรุงเทพมหานคร 10300';
	public $secret = 'EzjSsRuFrd2O18pD';
	public $dbhost = '192.168.1.31'; // MySQL Database สำหรับเครื่อง Web1 ถึง Web4
//	public $dbhost = 'localhost'; // MySQL Database สำหรับเครื่อง OEM หรือเครื่องโปรแกรมเมอร์
	public $dbuser = "ssru80";
	public $dbpass = "krcSSru#80th";
	public $dbname = "kaewruamchor";
	public $cookie_name = "ssru80th_user";
	public $session_id_name = "ssru80th_id";
	public $session_id_username = "ssru80th_username";
	public $ssru_latitude = 13.776626;
	public $ssru_longtitude = 100.508779;
	public $google_map_api_key = "AIzaSyCa3OpUKTNPjl2YYCsO4wE0oVix4R6oNsA";
	public $google_map_api = "https://maps.googleapis.com/maps/api/js?key=AIzaSyCa3OpUKTNPjl2YYCsO4wE0oVix4R6oNsA&callback=initMap&language=th&libraries=places";
//											  	  "https://maps.googleapis.com/maps/api/js?key=AIzaSyAMUn6xl6SLd6zPXdoYjjI7Trf_AMc9FRY&callback=initMap&language=th&libraries=places"
	public $ios_app_link = "https://itunes.apple.com/th/app/%E0%B9%81%E0%B8%81-%E0%B8%A7%E0%B8%A3%E0%B8%A7%E0%B8%A1%E0%B8%8A-%E0%B8%AD/id1324934585?mt=8";
	public $android_app_link = "https://play.google.com/store/apps/details?id=th.ac.ssru.kaewruamchor&hl=th";
}
function mySQL2thaiDate($mysql_date)
{
	list($y,$m,$d)=explode('-',$mysql_date);
	$thai_month=array('','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
	if(intval($y)==1901 || intval($y)==0)
		return 'ไม่ระบุ';
	else
		return intval($d).' '.$thai_month[intval($m)];//.' '.(intval($y)+543);
}

function mySQL2thaiDateFull($mysql_date)
{
	list($y,$m,$d)=explode('-',$mysql_date);
	$thai_month=array('','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
	if(intval($y)==1901 || intval($y)==0)
		return 'ไม่ระบุ';
	else
		return intval($d).' '.$thai_month[intval($m)].' '.(intval($y)+543);
}
function fullAddress($stu_housenumber, $stu_moo, $stu_alley, $stu_street, $stu_district, $stu_amphur, $stu_province, $stu_zipcode)
{
	$fullAddress = trim($stu_housenumber);
	$fullAddress .= (trim($stu_moo)!='')? (" ม.".trim($stu_moo)) :"";
	$fullAddress .= (trim($stu_alley)!='')? (" ซ.".trim($stu_alley)) :"";
	$fullAddress .= (trim($stu_street)!='')? (" ถ.".trim($stu_street)) :"";
	$fullAddress .= (trim($stu_district)!='')? (((trim($stu_province)!='กรุงเทพมหานคร')?" ต.":" แขวง").$stu_district) :"";
	$fullAddress .= (trim($stu_amphur)!='')? (((trim($stu_province)!='กรุงเทพมหานคร')?" อ.":" เขต").$stu_amphur) :"";
	$fullAddress .= (trim($stu_province)!='')? (((trim($stu_province)!='กรุงเทพมหานคร')?" จ.":" ").$stu_province) :"";
	$fullAddress .= " ".trim($stu_zipcode);
	if(trim($fullAddress)=="") return "ยังไม่ระบุ (หรืออยู่ต่างประเทศ)";
	else return trim($fullAddress);
}

$config=new SysConfig();
$con = new mysqli($config->dbhost,$config->dbuser,$config->dbpass,$config->dbname);
if($con->connect_error) {
  exit('ขออภัย! การเชื่อมต่อฐานข้อมูลขัดข้อง กรุณากลับมาใหม่ภายหลัง'); //Should be a message a typical user could understand in production
}
$con->set_charset("utf8");
?>
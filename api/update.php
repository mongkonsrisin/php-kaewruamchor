<?php
require_once('dbconfig.php');
$response = array();
$sql="";
$total_update=0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id'])) {
        $id = mysqli_real_escape_string($con, trim($_POST['id']));
        if (isset($_POST['engfname'])) {
            $engfname = mysqli_real_escape_string($con, trim($_POST['engfname']));
            $sql.=" stu_engfname='$engfname' ";
			$total_update++;
        }
        if (isset($_POST['englname'])) {
            $englname = mysqli_real_escape_string($con, trim($_POST['englname']));
			$sql.=($total_update>0)? " , ":" ";
            $sql.=" stu_englname='$englname' ";
			$total_update++;
        }
        if (isset($_POST['housenumber'])) {
            $housenumber = mysqli_real_escape_string($con, trim($_POST['housenumber']));
			$sql.=($total_update>0)? " , ":" ";
            $sql.=" stu_housenumber='$housenumber' ";
			$total_update++;
        }
        if (isset($_POST['moo'])) {
            $moo = mysqli_real_escape_string($con, trim($_POST['moo']));
			$sql.=($total_update>0)? " , ":" ";
            $sql.=" stu_moo='$moo' ";
			$total_update++;
        }
        if (isset($_POST['alley'])) {
            $alley  = mysqli_real_escape_string($con, trim($_POST['alley']));
			$sql.=($total_update>0)? " , ":" ";
            $sql.=" stu_alley='$alley' ";
			$total_update++;
        }
        if (isset($_POST['street'])) {
            $street = mysqli_real_escape_string($con, trim($_POST['street']));
			$sql.=($total_update>0)? " , ":" ";
            $sql.=" stu_street='$street' ";
			$total_update++;
        }
        if (isset($_POST['district'])) {
            $district = mysqli_real_escape_string($con, trim($_POST['district']));
			$sql.=($total_update>0)? " , ":" ";
            $sql.=" stu_district='$district' ";
			$total_update++;
        }
        if (isset($_POST['amphur'])) {
            $amphur = mysqli_real_escape_string($con, trim($_POST['amphur']));
			$sql.=($total_update>0)? " , ":" ";
            $sql.=" stu_amphur='$amphur' ";
			$total_update++;
        }
        if (isset($_POST['province'])) {
            $province = mysqli_real_escape_string($con, trim($_POST['province']));
			$sql.=($total_update>0)? " , ":" ";
            $sql.=" stu_province='$province' ";
			$total_update++;
        }
        if (isset($_POST['zipcode'])) {
            $zipcode = mysqli_real_escape_string($con, trim($_POST['zipcode']));
			$sql.=($total_update>0)? " , ":" ";
            $sql.=" stu_zipcode='$zipcode' ";
			$total_update++;
        }
        if (isset($_POST['phonenumber'])) {
            $phonenumber = mysqli_real_escape_string($con, trim($_POST['phonenumber']));
			$sql.=($total_update>0)? " , ":" ";
            $sql.=" stu_phonenumber='$phonenumber' ";
			$total_update++;
        }
        if (isset($_POST['email'])) {
            $email  = mysqli_real_escape_string($con, trim($_POST['email']));
			$sql.=($total_update>0)? " , ":" ";
            $sql.=" stu_email='$email' ";
			$total_update++;
        }
        if (isset($_POST['facebook'])) {
            $facebook = mysqli_real_escape_string($con, trim($_POST['facebook']));
			$sql.=($total_update>0)? " , ":" ";
            $sql.=" stu_facebook='$facebook' ";
			$total_update++;
        }
        if (isset($_POST['line'])) {
            $line   = mysqli_real_escape_string($con, trim($_POST['line']));
			$sql.=($total_update>0)? " , ":" ";
            $sql.=" stu_line='$line' ";
			$total_update++;
        }
        if (isset($_POST['latitude'])) {
            $latitude = mysqli_real_escape_string($con, trim($_POST['latitude']));
			$sql.=($total_update>0)? " , ":" ";
            $sql.=" stu_latitude='$latitude' ";
			$total_update++;
        }
        if (isset($_POST['longtitude'])) {
            $longtitude = mysqli_real_escape_string($con, trim($_POST['longtitude']));
			$sql.=($total_update>0)? " , ":" ";
            $sql.=" stu_longtitude='$longtitude' ";
			$total_update++;
        }
        if (isset($_POST['status'])) {
            $status = mysqli_real_escape_string($con, trim($_POST['status']));
			$sql.=($total_update>0)? " , ":" ";
            $sql.=" stu_status='$status' ";
			$total_update++;
        }
        if (isset($_POST['job'])) {
            $job = mysqli_real_escape_string($con, trim($_POST['job']));
			$sql.=($total_update>0)? " , ":" ";
            $sql.=" stu_job='$job' ";
			$total_update++;
        }
        if (isset($_POST['prefix'])) {
            $prefix = mysqli_real_escape_string($con, trim($_POST['prefix']));
			$sql.=($total_update>0)? " , ":" ";
            $sql.=" stu_prefix='$prefix' ";
			$total_update++;
        }

		if ($total_update>0) {
			$result = mysqli_query($con, "SELECT stu2.stu_id FROM student stu LEFT JOIN student stu2 ON (stu.stu_fname = stu2.stu_fname AND stu.stu_lname = stu2.stu_lname AND stu.stu_birthday = stu2.stu_birthday) WHERE stu.stu_id='$id' ");
			foreach($result as $row)
			{
				$sql2="UPDATE student SET ".$sql." WHERE stu_id='".$row['stu_id']."' ";
				$result2 = mysqli_query($con, $sql2);
			}
        }

        $response['success'] = true;
    } else {
        $response['success'] = false;
        $response['msg']     = 'No ID';
    }
} else {
    $response['success'] = false;
    $response['msg']     = 'Access Denied';
}
mysqli_close($con);
echo json_encode($response);
?>

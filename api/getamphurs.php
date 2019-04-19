<?php
require_once('dbconfig.php');
$response = array();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id'])) {
        $id = mysqli_real_escape_string($con, trim($_POST['id']));
        $sql = "SELECT * FROM amphur
		WHERE am_proid='$id' ORDER BY am_thainame";
        $result = mysqli_query($con, $sql);
        $rows   = array();
        while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
        } 
        $response['success'] = true;
        $response['msg'] = $rows;
    } else {
        $response['success'] = false;
        $response['msg']     = 'Parameters are missing';
    }
} else {
    $response['success'] = false;
    $response['msg']     = 'Access Denied';
}
mysqli_close($con);
echo json_encode($response);
?>

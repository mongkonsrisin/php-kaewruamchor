<?php
require_once('dbconfig.php');
$response = array();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $sql    = "SELECT * FROM occupation";
        $result = mysqli_query($con, $sql);
        $rows   = array();
        while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
        }
        $response['success'] = true;
        $response['msg']     = $rows;

} else {
    $response['success'] = false;
    $response['msg']     = 'Access Denied';
}
mysqli_close($con);
echo json_encode($response);
?>

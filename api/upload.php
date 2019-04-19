<?php
require_once('dbconfig.php');
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    if (isset($_FILES['image'])) {
        $errors    = array();
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp  = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_ext  = strtolower(end(explode('.', $_FILES['image']['name'])));
        $expensions = array(
            "jpeg",
            "jpg",
            "png"
        );
        if (in_array($file_ext, $expensions) === false) {
            $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
        }
        if (empty($errors) == true) {
            $img    = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
			$result = mysqli_query($con, "SELECT stu2.stu_id FROM student stu LEFT JOIN student stu2 ON (stu.stu_fname = stu2.stu_fname AND stu.stu_lname = stu2.stu_lname AND stu.stu_birthday = stu2.stu_birthday) WHERE stu.stu_id='$id' ");
			foreach($result as $row)
			{
				$sql= "UPDATE student SET stu_photo='$img' WHERE stu_id='".$row['stu_id']."' ";
				$result2 = mysqli_query($con, $sql);
			}
//            $sql    = "UPDATE student SET stu_photo='$img' WHERE stu_id='$id'";
//            $result = mysqli_query($con, $sql);
            echo "Success";
        } else {
            print_r($errors);
        }
    }
} else {
}
?>
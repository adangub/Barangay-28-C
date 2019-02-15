<!DOCTYPE html>
<html>
<body><?php
	
	include '/_sql/config.php';
	
	if(isset($_FILES["image"]["name"]) && $_FILES["image"]["tmp_name"] != "" && isset($_POST['uploader'])){	
		
		$uploaderid = $_POST['uploader'];
		
		$filetmp=" ";
		$filename=" ";
		$filetype=" ";
		$filepath=" ";
		
		$filetmp=$_FILES["image"]["tmp_name"];
		$filename=$_FILES["image"]["name"];
		$filetype=$_FILES["image"]["type"];
		$fileSize = $_FILES["image"]["size"];
		$filepath="img/user/".$filename;
		$kaboom = explode(".", $filename);
		$fileExt = end($kaboom);
		
		$db_file_name = rand(1000,999999999999).".".$fileExt;
		
		echo $fileExt;
		
		$query = mysqli_query($conn, "SELECT image FROM resident WHERE id='$uploaderid'");
		$row = mysqli_fetch_row($query);
		$avatar = $row[0];
		if($avatar != ""){
			$picurl = "img/user/$avatar"; 
	    if (file_exists($picurl)) { unlink($picurl); }
		}
		
		$moveResult = move_uploaded_file($filetmp, "img/user/$db_file_name");
		if ($moveResult != true) {
			header("location: ../message.php?msg=ERROR: File upload failed");
			exit();
		}
		$target_file = "img/user/$db_file_name";
		$resized_file = "img/user/$db_file_name";
		$wmax = 200;
		$hmax = 300;
		img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);
		
		$insertSql=mysqli_query($conn,"UPDATE resident set image = '$db_file_name' where id = '$uploaderid';");
		
		session_start();
		$_SESSION['u_image'] = $db_file_name;
		echo "Item Added!"; header("Refresh: 0; url=".$_SERVER['HTTP_REFERER']."");
		
		
	}
	else{
		header("Refresh: 0; url=".$_SERVER['HTTP_REFERER']."");
	}
	
	mysqli_close($conn);

?>

<?php

function img_resize($target, $newcopy, $w, $h, $ext) {
    list($w_orig, $h_orig) = getimagesize($target);
    $scale_ratio = $w_orig / $h_orig;
    if (($w / $h) > $scale_ratio) {
           $w = $h * $scale_ratio;
    } else {
           $h = $w / $scale_ratio;
    }
    $img = "";
    $ext = strtolower($ext);
    if ($ext == "gif"){ 
      $img = imagecreatefromgif($target);
    } else if($ext =="png"){ 
      $img = imagecreatefrompng($target);
    } else { 
      $img = imagecreatefromjpeg($target);
    }
    $tci = imagecreatetruecolor($w, $h);
    // imagecopyresampled(dst_img, src_img, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
    imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
    imagejpeg($tci, $newcopy, 84);
}
?>
</body>
</html>


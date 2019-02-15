<html>
<center>
<br>
<br>
<br>
<br>


<img src="images/default.jpg" width=100 style='border-style: groove; margin-left: 0px; cursor: pointer; cursor: hand;' id="profilepic">

<form action='imageupload.php' method='post' name="imaging" id='imaging' enctype='multipart/form-data'>
	<input type="hidden" name="uploader" id="uploader" value="<?php echo $user ?>" background="something.jpg">
	<input type="file" name="image" id="image" style="margin-left: 40px;">
	<input type='button' style="width: 205px" value='Update Profile Picture' onClick="validateItem()"/>
</form>
</html>

<script>

function validateItem(){
	var img = document.getElementById("img");
	if(img.value != '')
	document.imaging.submit();
	else alert('Please choose your image.');
}
document.getElementById('profilepic').onclick = function(){
	document.getElementById('image').click();
}

$("#profilepic").click(function() 
	{
		$("#image").click();
		
	});
	
</script>














<?php
	
	include 'config.php';
	if(isset($_FILES["imager"]["name"]) && $_FILES["imager"]["tmp_name"] != "" && isset($_POST['uploader'])){	
	
		$query = mysqli_query($conn, "SELECT id FROM accounts WHERE username='".$_POST['uploader']."'");
		$row = mysqli_fetch_array($query);
		$uploaderid = $row['id'];

		$filetmp=" ";
		$filename=" ";
		$filetype=" ";
		$filepath=" ";
		
		$filetmp=$_FILES["imager"]["tmp_name"];
		$filename=$_FILES["imager"]["name"];
		$filetype=$_FILES["imager"]["type"];
		$fileSize = $_FILES["imager"]["size"];
		$filepath="images/user/".$filename;
		$kaboom = explode(".", $filename);
		$fileExt = end($kaboom);
		
		$db_file_name = rand(1000,999999999999).".".$fileExt;
		
		$query = mysqli_query($conn, "SELECT image FROM accounts WHERE id='$uploaderid'");
		$row = mysqli_fetch_row($query);
		$avatar = $row[0];
		if($avatar != ""){
			$picurl = "images/user/$avatar"; 
			$picurlthumb = "images/user/thumb/$avatar";
	    if (file_exists($picurl)) { unlink($picurl); }
		if (file_exists($picurlthumb)) { unlink($picurlthumb); }
		}
		
		$moveResult = move_uploaded_file($filetmp, "images/user/$db_file_name");
		if ($moveResult != true) {
			header("location: ../message.php?msg=ERROR: File upload failed");
			exit();
		}
		$target_file = "images/user/$db_file_name";
		$resized_file = "images/user/$db_file_name";
		$wmax = 800;
		$hmax = 900;
		
		img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);
		
		$insertSql=mysqli_query($conn,"UPDATE accounts set image = '$db_file_name' where id = '$uploaderid';");
		header("Refresh: 0; url=index.php");
		

		makeThumb($db_file_name);

	}
	else{
		header("Refresh: 0; url=index.php");
	}
	
	mysqli_close($conn);
?>

<?php

//FUNCTION NI CYA PARA ICROP LNG TO THUMB
function makeThumb( $filename , $thumbSize=500 ){
  global $max_width, $max_height;
 /* Set Filenames */
  $srcFile = 'images/user/'.$filename;
  $thumbFile = 'images/user/thumb/'.$filename;
 /* Determine the File Type */
  $type = substr( $filename , strrpos( $filename , '.' )+1 );
 /* Create the Source Image */
  switch( $type ){
    case 'jpg' : case 'jpeg' :
      $src = imagecreatefromjpeg( $srcFile ); break;
    case 'png' :
      $src = imagecreatefrompng( $srcFile ); break;
    case 'gif' :
      $src = imagecreatefromgif( $srcFile ); break;
  }
 /* Determine the Image Dimensions */
  $oldW = imagesx( $src );
  $oldH = imagesy( $src );
   /* Calculate the New Image Dimensions */
   $limiting_dim = 0;
    if( $oldH > $oldW ){
     /* Portrait */
      $limiting_dim = $oldW;
    }else{
     /* Landscape */
      $limiting_dim = $oldH;
    }
 /* Create the New Image */
    $new = imagecreatetruecolor( $thumbSize , $thumbSize );
/* Transcribe the Source Image into the New (Square) Image */
    imagecopyresampled( $new , $src , 0 , 0 , ($oldW-$limiting_dim )/2 , ( $oldH-$limiting_dim )/2 , $thumbSize , $thumbSize , $limiting_dim , $limiting_dim );
  switch( $type ){
    case 'jpg' : case 'jpeg' :
      $src = imagejpeg( $new , $thumbFile ); break;
    case 'png' :
      $src = imagepng( $new , $thumbFile ); break;
    case 'gif' :
      $src = imagegif( $new , $thumbFile ); break;
  }
  imagedestroy( $new );

}


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
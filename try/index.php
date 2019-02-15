<html>
<center>
<br>
<br>
<br>
<br>


<form action='' method='post' name="imaging" id='imaging' enctype='multipart/form-data'>
	<input type="hidden" name="uploader" id="uploader" value="<?php echo $user ?>" background="something.jpg">
	<input type="file" name="image" id="image" style="margin-left: 40px;">
	<input type='submit' style="width: 205px" value='Update Profile Picture'/>
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
	

	if(isset($_FILES["image"]["name"]) && $_FILES["image"]["tmp_name"] != "" && isset($_POST['uploader'])){
		echo 'haha';
		$filetmp=" ";
		$filename=" ";
		$filetype=" ";
		$filepath=" ";
		
		$filetmp=$_FILES["image"]["tmp_name"];
		$filename=$_FILES["image"]["name"];
		$filetype=$_FILES["image"]["type"];
		$fileSize = $_FILES["image"]["size"];
		$filepath="images/user/".$filename;
		$kaboom = explode(".", $filename);
		$fileExt = end($kaboom);
		
		$db_file_name = rand(1000,999999999999).".".$fileExt;
		
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
		
		

		makeThumb($db_file_name);

	}


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
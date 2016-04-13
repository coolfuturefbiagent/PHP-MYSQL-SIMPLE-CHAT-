<?php

require_once("../config.php");
$userid=$_SESSION['userid'];

require_once  "../includes/bulletproof.php";
$image = new Bulletproof\Image($_FILES['img']);
$image->setSize(0,3145728); 
$image->setMime(array("jpeg","jpg","JPEG","JPG"));  
$img_name="noncropped".$userid.rand();
$image->setDimension(2500,2500); 
$image->setName($img_name);
$location="../profilepictures/".$userid."/";


$image->setLocation($location);  

$response = Array();
 try{

 //if($image->getMime() !== "JPG" OR $image->getMime() !== "JPEG" OR $image->getMime() !== "jpeg" OR $image->getMime() !== "jpg"){
   //   throw new \Exception(" Image should be a 'jpeg' type :". $image->getMime());
  //}

   if($image->getSize() >3145728){
      throw new \Exception(" Image size Large ");
   }

   if($image->upload()){
      
	   $response = array(
			"status" => 'success',
			"url" =>$website_url.ltrim($image->getFullPath(),"./"),
			"width" =>$image->getWidth(),
			"height" => $image->getHeight()
		  );
		  
	  
   }else{
     throw new \Exception($image["error"]);
   }

 }catch(\Exception $e){
 
   $response = array(
			"status" => 'error',
			"message" => $e->getMessage()
		);
      
 }


error_log(json_encode($response));
print json_encode($response);


/*
    $imagePath = "temp/";

	$allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
	$temp = explode(".", $_FILES["img"]["name"]);
	$extension = end($temp);
	
	//Check write Access to Directory

	if(!is_writable($imagePath)){
		$response = Array(
			"status" => 'error',
			"message" => 'Can`t upload File; no write Access'
		);
		print json_encode($response);
		return;
	}
	
	if ( in_array($extension, $allowedExts))
	  {
	  if ($_FILES["img"]["error"] > 0)
		{
			 $response = array(
				"status" => 'error',
				"message" => 'ERROR Return Code: '. $_FILES["img"]["error"],
			);			
		}
	  else
		{
			
	      $filename = $_FILES["img"]["tmp_name"];
		  list($width, $height) = getimagesize( $filename );

		  move_uploaded_file($filename,  $imagePath . $_FILES["img"]["name"]);

		  $response = array(
			"status" => 'success',
			"url" => $imagePath.$_FILES["img"]["name"],
			"width" => $width,
			"height" => $height
		  );
		  
		}
	  }
	else
	  {
	   $response = array(
			"status" => 'error',
			"message" => 'something went wrong, most likely file is to large for upload. check upload_max_filesize, post_max_size and memory_limit in you php.ini',
		);
	  }
	  
	  print json_encode($response);
*/
?>

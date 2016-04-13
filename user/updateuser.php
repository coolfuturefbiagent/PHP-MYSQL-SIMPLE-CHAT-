<?php require_once("../config.php");



class updateuser{
	
	
	
	
	
		private $profilepicture;
	private $bio;
	private $gender;
	private $website;
	private $twitter;
	private $facebook;
	private $birthday;
	private $phone;
	private $addr1;
	private $addr2;
	private $citytown;
	private $country;
	
	private $profilepictureurl;
	
	
	function __construct(){

		$this->profilepictureurl=$_POST['cropped_img_url'];
		$this->bio=$_POST['bio'];
		$this->gender=$_POST['gender'];
			$this->website=$_POST['website'];
			$this->twitter=$_POST['twitter'];
			$this->facebook=$_POST['facebook'];
			$this->birthday=$_POST['birthday'];
			$this->phone=$_POST['phone'];
			$this->addr1=$_POST['addr1'];
			$this->addr2=$_POST['addr2'];
			$this->citytown=$_POST['citytown'];
			$this->country=$_POST['country'];
		// $this->upload(); no need , image is pre-uploaded
		$this->update();
	}
	
/*
	function upload(){
		$userid=$_SESSION['userid'];
		$filename=$this->profilepicture['name'];
		$filetype=$this->profilepicture['type'];
		$tempdir=$this->profilepicture['tmp_name'];
		$filesize=$this->profilepicture['size'];
		$rondomnumber=rand();
		global $savedir;
		$savedir="../profilepictures/personalpropic{$userid}{$rondomnumber}{$filename}";
	
		
		if( move_uploaded_file($_FILES["propic"]["tmp_name"],
     $savedir)){
			$this->profilepictureurl=$savedir;
			
			$_SESSION['personalaccountpicture']=$savedir;
			$this->update();
	
		
		}
		else{
		echo "File Uploading Faild";	
		$this->profilepictureurl="";
			$this->update();
		}
		
	}
	
	
	*/
	
	function update(){
		$userid=$_SESSION['userid'];
		$db = MysqliDb::getInstance();
		
		
		$data = Array ("gender" =>$this->gender,
           "pictureurl" =>$this->profilepictureurl,
		   "bio" =>$this->bio,
		   "website" =>$this->website,
		   "twitter" =>$this->twitter,
		   "facebook" =>$this->facebook,
		   "birthday" =>$this->birthday,
		   "phone" =>$this->phone,
		   "addrline1" =>$this->addr1,
		   "addrline2" =>$this->addr2,
		   "citytown" =>$this->citytown,
		   "country" =>$this->country		   
                 );
				 $db->where ('id', $userid);

	
	if($db->update ('personalaccount', $data)){
		header("LOCATION:index.php?u=true");
		exit;
	}
	
	else{
		
	
	}
		
	}
}


$update= new updateuser();






?>
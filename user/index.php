<?php  require_once("../config.php"); ?>
<?php   

if(!isset($_SESSION['username'])){
header("location:../signup.php");
exit;	
}

 ?>

<?php   include("tem/header.html"); ?>

<?php require_once("../includes/user.php");?>
  <?php require_once("left_panel.php");  ?>
    <!-- Bootstrap core CSS -->
    

    <!-- Custom styles for this template -->
    <link href="../media/assets/css/main.css" rel="stylesheet">
    <link href="../media/assets/css/croppic.css" rel="stylesheet">
<?php

$userid=(int)$_SESSION['userid'];
$username=$_SESSION['username'];


//$user=new User($userid);
class ProfileSettings extends User{

public $id;	
	
function __construct($id){	
$this->id=(int)$id;
parent::__construct($this->id);
}
static function get_user_information($field_name){

	return parent::$user_info[$field_name];
	
}	
	
	
}

$user=new ProfileSettings($userid);


?>
 
  <?php  $user->check_user_exists($userid);?>
  <br/>  <br/>  <br/>
    <br/>  <br/>
 <div class='profilecontainer'>
  <div class='leftpanel' style="float:left; width:220px; min-height:500px; ">
<?php get_sidebar(); ?>

 <br/>
 <br/>
 <br/>
 <br/>



</div>
 <div class="profilecontent">
  <div class="emailacticvation" style='display:<?php    if(isset($_GET['u']) AND $_GET['u']="true"){ echo "";} else{echo "none";}  ?>'>
 <p>Account Is Updated! , It Will Be Activated Next Time You Logged In</p>
 </div>
 
 <?php if(!$user->checkverified($userid)){ ?>
 <div class="emailacticvation" style=''>
 <p>The e-mail adderss <?php echo $user->get_user_information("email"); ?> is not yet verified to be working. Please check your e-mail's inbox or spam/junk folder.</p>
 </div>
 
 <?php } ?>
 <legend>Profile Settings</legend>
 <form id='profilesettingsform' action="updateuser.php" enctype="multipart/form-data" method="post">
 <fieldset style=" width:100%;">

	<div class="row mt " style='width:200px; margin:0 auto;'>
			<div class="col-lg-4 ">
				<h4 class="centered"> Profile Picture </h4>
				<p class="centered">( Upload Or Resize  )</p>
				<div style= 'width:120px; height:120px; ' id="cropContainerMinimal">
				
				<img width='120px' height='120px' src='<?php echo $user->get_user_information("pictureurl"); ?>' />
				</div>
				
			</div>		
			<br/>
			<br/>
			
		</div>	
		
<br/>
<br/>

	

 <label style="float:left;margin-right:30px; margin-left:150px;line-height:30px;">Bio</label>
 <textarea rows="3" name='bio' style="width:269px; border: 1px solid #6CF;" >
<?php echo $user->get_user_information("bio"); ?>
 </textarea>
  <p  style='margin-left:200px;'>A short bio about yourself</p>
  <label style="float:left;line-height:30px; margin-right:20px; margin-left:130px;">Gender</label>
  <select  required  name="gender" style="border: 1px solid #6CF;margin-left:6px;">
  <option value="male">Male</option>
   <option value="female">Female</option>
  
  </select>
  <br/>
   <label style="float:left;margin-right:20px;line-height:30px; margin-left:133px;">Website</label>
   <input type="text" name="website" style='width:220px; height:30px;border: 1px solid #6CF;' value="<?php echo $user->get_user_information("website"); ?>">
   <br/>
   
    <label style="float:left;margin-right:20px;line-height:30px; margin-left:137px;">Twitter</label>
   <input type="text" name='twitter' style='width:220px; height:30px;border: 1px solid #6CF;' value="<?php echo $user->get_user_information("twitter"); ?>">
     <p  style='margin-left:200px;'>Your Twitter Username</p>
     
     
   
    <label style="float:left;margin-right:20px;line-height:30px; margin-left:127px;">Facebook</label>
   <input type="text" name='facebook' style='width:220px; height:30px;border: 1px solid #6CF;' value="<?php echo $user->get_user_information("facebook"); ?>">
     <p  style='margin-left:200px;'>A link to your fcebook profile</p>
     
       <label style="float:left;margin-right:20px;line-height:30px; margin-left:107px;">Date of Birth</label>
   <input type="date"  name="birthday"required value="<?php echo $user->get_user_information("birthday"); ?>"  style='width:220px; height:30px;border: 1px solid #6CF;' placeholder='31-12-2012'>
   <br/>
    <label required  style="float:left;margin-right:20px;line-height:30px; margin-left:99px;">Phone number</label>
   <input type="text" name="phone" style='width:220px; height:30px;border: 1px solid #6CF;'  value="<?php echo $user->get_user_information("phone"); ?>" >
   
    <br/>
    <label required style="float:left;margin-right:20px;line-height:30px; margin-left:99px;">Address Line 1</label>
   <input type="text" name="addr1" value="<?php echo $user->get_user_information("addrline1"); ?>" style='width:220px; height:30px;border: 1px solid #6CF;' >
   
    <br/>
    <label style="float:left;margin-right:20px;line-height:30px; margin-left:99px;">Address Line 2</label>
   <input type="text" name="addr2"   value="<?php echo $user->get_user_information("addrline2"); ?>"style='width:220px; height:30px;border: 1px solid #6CF;' >
   
   <br/>
       <label style="float:left;margin-right:20px;line-height:30px; margin-left:123px;">City/Town</label>
   <input type="text"  name="citytown" value="<?php echo $user->get_user_information("citytown"); ?>" style='width:220px; height:30px;border: 1px solid #6CF;'>
   <br/>
          <label style="float:left;margin-right:20px;line-height:30px; margin-left:123px;">Country</label>
          <select   name="country"value="<?php echo $user->get_user_information("country"); ?><?php echo $user->get_user_information("email"); ?>"  required style='border: 1px solid #6CF;margin-left:12px;'>
       <option></option>
 <option  value="Kuwait">Kuwait</option>
 <option value="KSA">KSA</option>
 <option value="Bahrain">Bahrain</option>
 <option value="UAE">UAE</option>
 <option value="OMAN">OMAN</option>
 <option  value="Qtar">Qtar</option>
          </select>
          <div class="submitarea" style="height:70px;">
<input class="btn btn-primary margin0" type="submit" style="margin-left:200px; margin-top:20px;" name="submit" value="Save">
</div>
 </fieldset>
 
 </form>
 </div>
 
 
 </div>
 
 
 
 
 
 
 
 
 
 
 
 
 
 

 
 
 
 
 
 
 
 
 
  <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script> -->
	
   

	<script src="../media/assets/js/jquery.mousewheel.min.js"></script>
   	<script src="croppic.js"></script>
    <script src="../media/assets/js/main.js"></script>
    <script>
		var croppicHeaderOptions = {
				//uploadUrl:'img_save_to_file.php',
				cropData:{
					"dummyData":1,
					"dummyData2":"asdas"
				},
				cropUrl:'img_crop_to_file.php',
				customUploadButtonId:'cropContainerHeaderButton',
				modal:false,
				processInline:true,
				loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
				onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
				onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
				onImgDrag: function(){ console.log('onImgDrag') },
				onImgZoom: function(){ console.log('onImgZoom') },
				onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
				onAfterImgCrop:function(){ console.log('onAfterImgCrop') },
				onReset:function(){ console.log('onReset') },
				onError:function(errormessage){ console.log('onError:'+errormessage) }
		}	
		var croppic = new Croppic('croppic', croppicHeaderOptions);
		
		
		var croppicContainerModalOptions = {
				uploadUrl:'img_save_to_file.php',
				cropUrl:'img_crop_to_file.php',
				modal:true,
				imgEyecandyOpacity:0.4,
				loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
				onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
				onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
				onImgDrag: function(){ console.log('onImgDrag') },
				onImgZoom: function(){ console.log('onImgZoom') },
				onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
				onAfterImgCrop:function(){ console.log('onAfterImgCrop') },
				onReset:function(){ console.log('onReset') },
				onError:function(errormessage){ console.log('onError:'+errormessage) }
		}
		var cropContainerModal = new Croppic('cropContainerModal', croppicContainerModalOptions);
		
		
		var croppicContaineroutputOptions = {
				uploadUrl:'img_save_to_file.php',
				cropUrl:'img_crop_to_file.php', 
				outputUrlId:'cropOutput',
				modal:false,
				loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
				onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
				onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
				onImgDrag: function(){ console.log('onImgDrag') },
				onImgZoom: function(){ console.log('onImgZoom') },
				onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
				onAfterImgCrop:function(){ console.log('onAfterImgCrop') },
				onReset:function(){ console.log('onReset') },
				onError:function(errormessage){ console.log('onError:'+errormessage) }
		}
		
		var cropContaineroutput = new Croppic('cropContaineroutput', croppicContaineroutputOptions);
		
		var croppicContainerEyecandyOptions = {
				uploadUrl:'img_save_to_file.php',
				cropUrl:'img_crop_to_file.php',
				imgEyecandy:false,				
				loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
				onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
				onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
				onImgDrag: function(){ console.log('onImgDrag') },
				onImgZoom: function(){ console.log('onImgZoom') },
				onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
				onAfterImgCrop:function(){ console.log('onAfterImgCrop') },
				onReset:function(){ console.log('onReset') },
				onError:function(errormessage){ console.log('onError:'+errormessage) }
		}
		
		var cropContainerEyecandy = new Croppic('cropContainerEyecandy', croppicContainerEyecandyOptions);
		
		var croppicContaineroutputMinimal = {
				uploadUrl:'img_save_to_file.php',
				cropUrl:'img_crop_to_file.php', 
				modal:false,
				doubleZoomControls:false,
			    rotateControls: false,
				loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
				onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
				onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
				onImgDrag: function(){ console.log('onImgDrag') },
				onImgZoom: function(){ console.log('onImgZoom') },
				onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
				onAfterImgCrop:function(){ console.log('onAfterImgCrop') },
				onReset:function(){ console.log('onReset') },
				onError:function(errormessage){ console.log('onError:'+errormessage) }
		}
		var cropContaineroutput = new Croppic('cropContainerMinimal', croppicContaineroutputMinimal);
		
		var croppicContainerPreloadOptions = {
				uploadUrl:'img_save_to_file.php',
				cropUrl:'img_crop_to_file.php',
				loadPicture:'assets/img/night.jpg',
				enableMousescroll:true,
				loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
				onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
				onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
				onImgDrag: function(){ console.log('onImgDrag') },
				onImgZoom: function(){ console.log('onImgZoom') },
				onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
				onAfterImgCrop:function(){ console.log('onAfterImgCrop') },
				onReset:function(){ console.log('onReset') },
				onError:function(errormessage){ console.log('onError:'+errormessage) }
		}
		var cropContainerPreload = new Croppic('cropContainerPreload', croppicContainerPreloadOptions);
		
		
	</script>
<?php  include("../tem/footer.html"); ?>
<?php  session_start();?><?php  if(isset($_SESSION['username'])){ header("LOCATION:index.php"); exit;}

else{
	include("tem/header.html");
}?>

<?php
require_once("config.php");
?>


<br/>

<br/>
<br/>


<br/>
<?php


?>

<?php



if( isset($_POST['userid']) AND $_POST['userid']!=="" AND isset($_POST['username']) AND  $_POST['username']!==""  AND isset($_POST['email']) AND $_POST['email']!=="" AND isset($_POST['password']) ){
echo $_POST['password'];

update();

}


function update(){

	$username=$_POST['username'];
	$email=$_POST['email'];
	$userid=$_POST['userid'];
	
	$password=md5($_POST['password']);
	echo $_POST['password'];
$sql="UPDATE personalaccount SET password='$password' WHERE username='$username' ANd email='$email' AND id='$userid'";	
	if(mysql_query($sql)){
		
		echo "<div class='row' style=' margin-left:200px;'>
	<div class='span12' style='width: 940px;float: left;
min-height: 1px;
margin-left: 20px;'>
		<div class='round-4 bgff pad20' style='background: #fff; padding: 20px; -webkit-border-radius: 4px;
border-radius: 4px;'>
	
	<div class='pad20 bgf4' style='background: #eee; padding: 20px;'>
	Your password was reset successfully.
<a href='signup.php'>Sign in </a>with your new password.
	</div>
	
	</div>
	</div>
</div>";
		
		exit;
		
	}
	else{
		echo mysql_error();
			
		echo "<div class='row' style=' margin-left:200px;'>
	<div class='span12' style='width: 940px;float: left;
min-height: 1px;
margin-left: 20px;'>
		<div class='round-4 bgff pad20' style='background: #fff; padding: 20px; -webkit-border-radius: 4px;
border-radius: 4px;'>
	
	<div class='pad20 bgf4' style='background: #eee; padding: 20px;'>
	Error While Updating Your Account Please Try Again Later!
	</div>
	
	</div>
	</div>
</div>";
		
		exit;	
	}
}

?>

<div class="row" style=" margin-left:200px;">
	<div class="span12" style="width: 940px; float: left;
min-height: 1px;
margin-left: 20px;">
		<div class="round-4 bgff pad20" style="background: #fff; padding: 20px; -webkit-border-radius: 4px;
border-radius: 4px;">
	
<form class="form-horizontal" method="POST" action="reset.php">
		<legend>Change Your password</legend>
		
		
		
		<label for="id_firstname">New password</label>
		<input type="password"  name="password" style="border:thin solid #6CF;  width:206px; height:28px; margin-right:150px; margin-bottom:20px;  id="id_new_password1">
		
		
		

		<label for="id_firstname">New password confirmation</label>
		<div class="controls"><input type="password"    name="confirm" style="border:thin solid #6CF;  width:206px; height:28px; margin-right:150px; margin-bottom:20px;  id="id_new_password2">
		
		</div>
		</div>
		<input type="hidden" name="userid" value="<?php if(isset($_GET['userid'])){ echo $_GET['userid'];}?>" >
        	<input type="hidden" name="username" value="<?php if(isset($_GET['username'])){ echo $_GET['username'];}?>" >
            	<input type="hidden" name="email" value="<?php if(isset($_GET['email'])){ echo $_GET['email'];}?>" >
		<div class="form-actions">
			<input type="hidden" name="type" value="signup">
			<input class="btn suss2 btn-large"  style="margin-bottom:0;" type="submit" name="submit" value="Submit">
		</div>
	</form>
	
	</div>
	</div>
</div>



</div>


<br/>
<br/>

<br/>
<br/>
<?php 


include("tem/footer.html");

?>
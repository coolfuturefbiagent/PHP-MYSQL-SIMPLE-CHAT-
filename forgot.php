<?php  session_start();?><?php  if(isset($_SESSION['username'])){ header("LOCATION:index.php"); exit;;}

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



if(isset($_POST['email']) AND $_POST['email']!==""){
	
	select_user();
	
	
	
	
	
}

function select_user(){
	
	
	$sql="SELECT * FROM personalaccount WHERE email='{$_POST['email']}'";
	$result=mysql_query($sql);
	
	$selected_status="";
	if($row=mysql_fetch_array($result)){
		
		
		$username=$row['username'];
		$userid=$row['id'];
		$first_name=$row['firstname'];
		$lastname=$row['lastname'];
		$email=$row['email'];
		 sendmail($username,$userid,$first_name,$lastname,$email);
	}
	
	else
	global $selected_status;
	$selected_status="no";
	{
		
		
	}
	
}


function sendmail($username,$userid,$first_name,$lastname,$email){
	
	$to=$email;
	$subject="Password reset on dawrat.com";
	$pathto_here="http://".$_SERVER['HTTP_HOST']."/reset.php?userid=$userid && $username=$username && email=$email";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
if(mail($to,$subject,"

You're receiving this e-mail because you requested a password reset for your user account at dawrat.com. 
<br/>
Please go to the following page and choose a new password: 
<br/>
<a href='http://{$_SERVER['HTTP_HOST']}/reset.php?userid=$userid & username=$username & email=$email' >{$pathto_here} </a>  
<br/<
Your username, in case you've forgotten: {$username}
<br/>
Thanks for using our site! 
<br/>
The dawrat.com team


",$headers



)){
	
	echo "<div class='row' style=' margin-left:200px;'>
	<div class='span12' style='width: 940px;float: left;
min-height: 1px;
margin-left: 20px;'>
		<div class='round-4 bgff pad20' style='background: #fff; padding: 20px; -webkit-border-radius: 4px;
border-radius: 4px;'>
	
	<div class='pad20 bgf4' style='background: #eee; padding: 20px;'>
	Link sent successfully to your e-mail.
	</div>
	
	</div>
	</div>
</div>";
	exit;
}

	
	
}
?>
<div class="row" style=" margin-left:200px;">
	<div class="span12" style="width: 940px;float: left;
min-height: 1px;
margin-left: 20px;">
		<div class="round-4 bgff pad20" style="background: #fff; padding: 20px; -webkit-border-radius: 4px;
border-radius: 4px;">
	
	<form class="form" action="forgot.php" method="post"><div style="display:none"></div>
		<legend>Forgot Your Password?</legend>
		
		
		<div class="control-group error">
		<label for="id_firstname" style="color:<?php  	global $selected_status;if(isset( $selected_status) AND  $selected_status=="no"){ echo "#b94a48;;";}?>">Enter your e-mail to get a reset password link.</label>
		<div class="controls"><input id="id_email" type="email" name="email"  style="border:thin solid #6CF;  width:206px; height:28px; margin-right:150px; margin-bottom:20px;  " value="" maxlength="75">
    		<p class="help-block" style="text-align:left; display:<?php  	global $selected_status;if(isset( $selected_status) AND  $selected_status=="no"){ echo "none;";}?>">That e-mail address doesn't have an associated user account. Are you sure you've registered?</p>
		</div>
		</div>
		
		<div class="form-actions">
			<input type="hidden" name="type" value="signup">
			<input class="btn suss2 btn-large"  style="margin-bottom:0;" type="submit" name="submit" value="Submit">
		</div>
	</form>
	
	</div>
	</div>
</div>




<Br/>

<br/>

<br/>
<br/>
<br/>

<br/>

<br/>

<br/>





<?php 


include("tem/footer.html");

?>
<?php
session_start();
if(isset($_SESSION['username'])){	
header("LOCATION:index.php");
exit;	
}


?>
<?php include("tem/header.html");  ?>

<div class='logincontainer'>
<div class='signupformonsignuppage'>

<?php


$firstname="";
$lastname="";
$password="";
$email="";

if(isset($_POST['firstname'])){
$firstname=$_POST['firstname'];	
}
if(isset($_POST['lastname'])){
	
$lastname=$_POST['lastname'];	
}
if(isset($_POST['password'])){
	
$password=$_POST['password'];	
}
if(isset($_POST['email'])){
	
$email=$_POST['email'];	
}

?>



<legend>Sign up</legend>

<form action="includes/signuppersonalaccount.php" method="post" >

<fieldset style="margin-left:30px; width:100%; height:auto;">
<label   class="labelclz"style='float:left; width:80px; line-height:26px;  margin-left:70px; ' >First Name</label>
<input type="text" required  class="textflz" id='firstname' value="<?php  echo $firstname;?>" name="firstname" style="border:thin solid #6CF; float:left; width:206px; height:28px; margin-right:150px; margin-bottom:20px;  ">

<label  style='float:left; line-height:26px; width:80px;  margin-left:70px; ' >Last Name</label>
<input type="text" id='lasttname' required  value="<?php  echo $lastname;?>"  name="lastname" style="border:thin solid #6CF; float:left; width:206px; height:28px; margin-right:150px; margin-bottom:20px;  ">

<label  style='float:left; width:80px; line-height:26px; margin-left:70px; ' >Username</label>
<input type="text" id='username' required  name="username" style="border:thin solid #6CF; float:left; width:206px; height:28px; margin-right:150px; margin-bottom:20px;  ">

<label  style='float:left; width:80px; line-height:26px; margin-left:70px; ' >Password</label>
<input type="password" required  id='password'  value="<?php  echo $password;?>" name='password' style="border:thin solid #6CF; float:left; width:206px; height:28px; margin-right:150px; margin-bottom:20px;  ">

<label  style='float:left; width:80px; line-height:26px; margin-left:70px; ' >Email</label>
<input type="email" required id='email'name='email'  value="<?php  echo $email;?>" style="border:thin solid #6CF; float:left; width:206px; height:28px; margin-right:150px; margin-bottom:20px;  ">



<label style='float:left; width:80px; line-height:26px; margin-left:70px;  ' >Terms of use</label>
<input type="checkbox" required id='terms'  style="float:left; margin-left:15px;"name='terms' ><label style="float:left; margin-left:10px;">I agree to the terms. (read)</label>
</fieldset>
<div class='submitarea'>
<input class="btn suss2 btn-large" style=" margin-left:190px; margin-top:20px;" type="submit" name="siginingup" value="Create My Account">

</div>
</form>
</div>

</div>
<div class='loginform' style="height:auto">
<div class="emailacticvation" style='display:<?php if(!isset($_GET['s'])){echo "none;";}?>; color:<?php  if($_GET['s']=="completed"){ echo "green";} else{echo "red";}?>'>
 <p><?php 
 
 if($_GET['s']=="completed"){
	 ?>
	 
 Account Is Updated! , It Will Be Activated Next Time You Logged In</p>
 <?php 
 }
 else{
	 
	echo "Ploblems With Registration!"; 
 }
 ?>
 </div>
<form action="includes/login.php" method="post">
<legend>Login</legend>

<div class="alert alert-error" style="margin-bottom:10px; display:<?php if(isset($_GET['error']) AND $_GET['error']==4){} else{echo "none;";}?>">Please enter a correct username and password. Note that both fields are case-sensitive.</div>
<Input type="hidden" name="next" value="<?php if(isset($_GET['next'])){ echo $_GET['next']; } ?>">
<label  style='float:left; width:60px; line-height:28px; margin-left:100px; margin-right:15px; ' >Username</label>
<input type="text" name='username' id='username' required placeholder="Username here" style="border:thin solid #6CF; float:left; width:140px; height:28px; margin-bottom:20px;  ">

<label  style='float:left; width:60px; line-height:28px; margin-left:100px; margin-right:15px; ' >Password</label>
<input type="password" id='password'  required name='password' placeholder="Password here" style="border:thin solid #6CF; float:left; width:140px; height:28px; margin-bottom:20px;  ">
<a class="shouldunderline_a" href="forgot.php">  <label style="margin-left:175px;color: #08C; cursor:pointer;">Forgot your password?</label></a>
<input type="hidden" name="next" value="<?php if(isset($_GET['next'])){ echo $_GET['next'];} ?>" >
</fieldset>
<div class="submitarea" style="height:70px;">
<input class="btn btn-primary margin0" type="submit" style="margin-left:175px; margin-top:20px;" name="submit" value="Login">
</div>
</form>
</div>
</div>

<?php include("tem/footer.html"); ?>
<?php  session_start();?>
<?php  if(isset($_SESSION['username'])){ include("tem/userheader.html");}

else{
	include("tem/header.html");
}?>

<?php
if(!isset($_SESSION['username'])){
	
	
}

?>
<?php



if(!isset($_GET)){	
header("LOCATION:index.php");
exit;	
}

?>
<?php include("config.php"); ?>


<br/><br/><br/><br/>

<?php

$act_id=$_GET['verification_id'];


$sql="UPDATE personalaccount SET verified=1 WHERE verification_id='{$act_id}'";

if(mysql_query($sql)){
	echo mysql_error();
	echo "<div class='row' style=' margin-left:200px;'>
	<div class='span12' style='width: 940px;float: left;
min-height: 1px;
margin-left: 20px;'>
		<div class='round-4 bgff pad20' style='background: #fff; padding: 20px; -webkit-border-radius: 4px;
border-radius: 4px;'>
	
	<div class='pad20 bgf4' style='background: #eee; padding: 20px;'>
	You Have Sucessfully Activated The Account!
	</div>
	
	</div>
	</div>
</div>";
	exit;	
	
}

else{
	echo "<div class='row' style=' margin-left:200px;'>
	<div class='span12' style='width: 940px;float: left;
min-height: 1px;
margin-left: 20px;'>
		<div class='round-4 bgff pad20' style='background: #fff; padding: 20px; -webkit-border-radius: 4px;
border-radius: 4px;'>
	
	<div class='pad20 bgf4' style='background: #eee; padding: 20px;'>
	Error! Account Is Not Activated Please Contact Site Administrator!
	</div>
	
	</div>
	</div>
</div>";
	exit;	
	
}








?>





<?php

include("tem/footer.html");

?>
<?php 
require_once("../config.php");
@session_start();
class login{
	
	private $username;
	private $password;
	private $next_u;
	private $mysqlpassword;
	private $mysqlusername;
	
	
	function __construct(){
		$this->password=md5($_POST['password']);
		$this->username=$_POST['username'];
		$this->getmysql();
		
		if(isset($_POST['next'])){
		$this->next_u=$_POST['next'];	
		}
	}
	
function getmysql(){
$db = MysqliDb::getInstance();	
$db->where("username",$this->username);
$db->where("status",'online');
$cols = Array ("username", "password", "id","pictureurl","firstname","lastname","associatedwithorganizer");
$result = $db->getOne ("personalaccount", $cols);


$this->mysqlusername=$result['username'];
$this->mysqlpassword=$result['password'];	

if($this->mysqlusername==$this->username && $this->mysqlpassword==$this->password){
	

$_SESSION['username']=$this->mysqlusername;
$_SESSION['userid']=$result['id'];
$_SESSION['personalaccountpicture']=$result['pictureurl'];
$_SESSION['personalaccountname']=$result['firstname']."\t "."\t".$result['lastname'];;
$_SESSION['assiociatedwithorganier']=$result['associatedwithorganizer'];

}
else{	
	header("LOCATION:../signup.php?error=4");
	exit;
}
if($result['associatedwithorganizer']==1){

	$this->getoragnierinfo($this->mysqlusername);
}
if(isset($_POST['next']) AND $_POST['next']!==""){
$this->ifnextuel_exists();
}
else{
header("LOCATION:../signup.php?error=4");
exit;
}


}

// future upgrade
function getoragnierinfo($username){
	
$sql="SELECT * FROM organizeraccount WHERE username='$username'";
if($result=mysql_query($sql)){
	
$row=mysql_fetch_array($result);
}
else{
header("LOCATION:".WEBSITE_URL."index.php");
exit;
mysql_error();	
}
$_SESSION['organiername']=$row['name'];
$_SESSION['organizertype']=$row['organizertype'];
$_SESSION['organierprofilepicture']=$row['profilepicture'];



}
function ifnextuel_exists(){
	
	
	if(isset($_POST['next']) AND $_POST['next']!==""){
		header("LOCATION:{$_POST['next']}");
		exit;
	}

}

function nextnotexists(){
	
	
	
	
}
}
$login=new login();
?>
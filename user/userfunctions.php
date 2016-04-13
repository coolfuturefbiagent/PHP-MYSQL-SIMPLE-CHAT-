<?php
require_once("../config.php");
require_once("../includes/datemodiier.php");

class userfunction{
	
	function get_user_invoices($id){
	$db = MysqliDb::getInstance();
	$db->where ('userid',$id);		
	$result= $db->get("invoice");	
	
    return $result;	
		
	}
	
	function get_applied_courses($userid,$filters,$order_by){
	$db = MysqliDb::getInstance();

    if(count($filters)==0){

	}
    else{
     foreach ($filters as $key => $val) {
		 
		 $db->where ($key,$val);
		 
	 }
    }	
		if(count($order_by)!==0){
			foreach($order_by as $key =>$val){
			$db->orderBy ($key,$val);
			
			}
		}
		
   $result=$db->get("appliedcourses");
   return $result;
		
	}
	
function check_user_exists($username){
	$db = MysqliDb::getInstance();
	$db->where ('username',$username);
	$stats = $db->getOne ("personalaccount", "count(*) as cnt");
	
if($stats['cnt']<1){
		header("LOCATION:../../index.php");	
	exit;
	
}

	
}

	
function getuserprofilepicture(){
global $username;
	$username=$_SESSION['username'];
	$sql="SELECT pictureurl from personalaccount WHERE username='$username'";
	$result=mysql_query($sql);
	$row=mysql_fetch_array($result);
	$propic=$row['pictureurl'];
	if($propic==""){
	$propic="../media/none.120x120.png";	
	}
	else{
	$propic=$row['pictureurl'];	
	}
echo $propic;
}


function getcurrentbio(){
$userid=$_SESSION['userid'];
	
	$sql="SELECT bio FROM personalaccount WHERE id='$userid'";
	$result=mysql_query($sql);
	$row=mysql_fetch_array($result);
	echo $row['bio'];
}

function website(){
$userid=$_SESSION['userid'];
$sql="SELECT * FROM personalaccount WHERE id='$userid'";	
	
		$result=mysql_query($sql);
		global $row;
	$row=mysql_fetch_array($result);
	echo $row['website'];
	
}
function checkverified(){
	$userid=$_SESSION['userid'];
		$db = MysqliDb::getInstance();
	$db->where ('id',$userid);
	$row= $db->getOne ("personalaccount", "verified");
	
   
	$verify=$row['verified'];
	array($)
	if($verify==1){
	return true;
	}
	else{
		return false;
	}
}

function getcourseinfo($courseid){
	
$sql="SELECT * FROM courses WHERE courseid='$courseid'";
$result=mysql_query($sql);

if(!$result){
echo mysql_error();
exit;	
}

$courseinfo=mysql_fetch_array($result);
global $courseimg0;
global $coursename;
global $sessionid;
$courseimg0=$courseinfo['imgcourse0'];
$coursename=$courseinfo['coursename_en'];

	
}

function getsessioninfo($sessionid){
	
	$sql="SELECT * FROM session WHERE sessionid='$sessionid'";
	$result=mysql_query($sql);
	
	if(!$result){
		echo mysql_error();
	}
	$session=mysql_fetch_array($result);
	 startdate($session['startdate']);
	 enddate($session['enddate']);
global $fullstartdate;

	global $fullenddate;
	
	global $startsat;
	global $endsat;
	$startsat=$session['startsat'];
	$endsat=$session['endsat'];
	
}
}
global $row;
global $email;
$user=new userfunction


?>
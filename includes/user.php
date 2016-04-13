<?php



class User{
protected static $user_info=array();
private $mysqli;

function __construct($id=null){

if((isset($id) AND is_int($id) ) AND $this->check_user_exists($id)){
	echo "hiss";
    $db = MysqliDb::getInstance();
	$db->where ('id',$id);
	$row= $db->getOne ("personalaccount");	
	foreach($row as $key=>$value){
		User::$user_info[$key]=$value;
	}
}
	
}

function checkverified($userid){
    $db = MysqliDb::getInstance();
	$db->where ('id',$userid);
	$row= $db->getOne ("personalaccount", "verified");
	
   
	$verify=$row['verified'];
	
	if($verify=="1"){
	return true;
	}
	else{
		return false;
	}
}
public function check_user_exists($userid){
	$db = MysqliDb::getInstance();
	$db->where ('id',$userid);
	$stats = $db->getOne ("personalaccount", "count(*) as cnt");

if($stats['cnt']<1){
	header("LOCATION:".NOTFOUNDPAGE);	
	exit;
	
}	
else{
	return true;
}
}



function search_user($andwhere=null,$orwhere=null,$orderby=null,$likewhere=null,$limit=20,$returntype="array"){
$db = MysqliDb::getInstance();
if(count($likewhere)>0){
	foreach($likewhere as $key=>$value){
	$db->orWhere("$key LIKE '%{$value}%'");		
	}
}
if(count($andwhere)>0){
foreach($andwhere as $key=>$value){$db->where($key,$value);}
}
if(count($orwhere)>0){
	foreach($orwhere as $key=>$value){$db->orWhere($key,$value);}
}
if(count($orderby)>0){
	foreach($orderby as $key=>$value){$db->orderBy($key,$value);}
}

$result=$db->get("personalaccount");

if($returntype=="array"){
	return $result;
}
elseif($returntype=="json"){
 return json_encode($result);		
}
	
	
}
function check_image_exists($image){
if (getimagesize($image) !== false) {
   return true;
} else {
    return false;
}	
	
}
function get_profile_picture($userid,$acc="personalaccount",$size=null){

$db = MysqliDb::getInstance();
if($acc=="personalaccount"){

$cols = Array ("pictureurl");


$db->where ("id",$userid);
$result = $db->getone("personalaccount",'pictureurl',$cols);
//var_dump($result);
if(!$result){
	if(DEBUG){
		//echo 'insert failed: ' . $db->getLastError();
		//error_log($db->getLastError());
	}
}
else{
     $image=$result['pictureurl'];
	 
	 if($image!=="" AND $this->check_image_exists($image)){
		 
		 return $image;
	 }
	 else{
		 return NO_USER_IMG;
	 }

	
	
}

}
else{

$cols = Array ("pictureurl");


$db->where ("userid",$userid);
$result = $db->getone("organizeraccount",'pictureurl',$cols);
if(!$result){
	if(DEBUG){
		//echo 'SELECT failed: ' . $db->getLastError();
		//error_log($db->getLastError());
	}
}
else{
	
  $image=$result['pictureurl'];
	 
	 if($image!=="" AND $this->check_image_exists($image)){
		 
		 return $image;
	 }
	 else{
		 return NO_USER_IMG;
	 }
	
	
}


}



}



function get_username($id){
$db = MysqliDb::getInstance();


$db->where ("id",$id);
$result = $db->getone("personalaccount",'username');


return $result['username'];

}

function get_fullname($id,$accounttype="personalaccount",$limit){
$db = MysqliDb::getInstance();

if($accounttype==="personalaccount"){
	

$db->where ("id",$id);
$result = $db->getone($accounttype,array('firstname','lastname'));
$full_name=$result['firstname']." ".$result['lastname'];	
if($limit!==0){
	
return substr($full_name,0,$limit);
}
else{
	return $full_name;
}
}
else{


$db->where ("userid",$id);
$result = $db->getone("organizeraccount","name");
if(!$result){
	echo "Error";
	return false;
}
$full_name=$result['name'];

if($limit!==0){
	
return substr($full_name,0,$limit);
}
else{
	return $full_name;
}


}	
	
}
function get_email($userid){
$db = MysqliDb::getInstance();	
$db->where ("id",$userid);
$result = $db->getone("personalaccount","email");	

return $result['email'];

}
function get_useid($username){
$db = MysqliDb::getInstance();	
$db->where ("username",$username);
$result = $db->getone("personalaccount","id");	

return $result['id'];

}

function get_full_name($userid,$output="return",$limit=15){
$db = MysqliDb::getInstance();	
$db->where ("id",$userid);
$result = $db->getone("personalaccount");
$first_name=$result['firstname'];
$last_name=$result['lastname'];
$full_name=$first_name."\t".$last_name;
$edited_fullname="";
if($limit!==0){
	$full_name=substr($full_name,0,15);
}
if($output=="json"){

echo json_encode(array("fullname"=>$full_name));

}
else{

return $full_name;
}
}
}










?>
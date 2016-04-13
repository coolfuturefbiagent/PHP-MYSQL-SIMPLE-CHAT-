<?php
@require_once("../../config.php");
require_once("../user.php");

class Message extends User{
	
	
function __construct(){


if(isset($_POST['action']) AND  $_POST['action']=="get_messages"){

	$return_type=urldecode(stripslashes($_POST['returntype']));
	$limit_from=(int)urldecode(stripslashes($_POST['limit_from']));	
	$limit_to=(int)urldecode(stripslashes($_POST['limit_to']));	
	$conversationid=urldecode(stripslashes($_POST['conversationid']));
	$userid=$_SESSION['userid'];

	$user_joined=$this-> check_user_inconversation($userid,$conversationid);
	if($user_joined){
		$limit=array($limit_from,$limit_to);
		$result=$this->get_messages_inconversation($conversationid,$userid,$limit,$return_type);
		echo $result;
	}
}



if(isset($_POST['action']) AND $_POST['action']=="get_receivers"){
	

$return_type=urldecode(stripslashes($_POST['returntype']));
$conversationid=(int)urldecode(stripslashes($_POST['conversationid']));
$receivers=$this->get_receivers_inconversation($conversationid,$return_type);

if($receivers){
	echo $receivers;
}

}




if(isset($_POST['action']) AND $_POST['action']=="get_conversations"){
	
$userid=$_SESSION['userid'];
$return_type=urldecode(stripslashes($_POST['returntype']));
$limit_from=(int)urldecode(stripslashes($_POST['limit_from']));	
$limit_to=(int)urldecode(stripslashes($_POST['limit_to']));	
$orderby=array("id","DESC");
$conversations=$this->get_joined_conversations($userid,$limit_from,$limit_to,$return_type,$orderby);
if(!is_array($conversations)){
	echo $conversations;
	return false;
}
else{
	return  print_r($conversations);
}

}

if(isset($_POST['action']) AND  $_POST['action']=="send_message"){



	$return_type=urldecode(stripslashes($_POST['returntype']));
$conversationid=(int)urldecode(stripslashes($_POST['conversationid']));
$userid=$_SESSION['userid'];
$message=strip_tags(urldecode(stripslashes($_POST['message'])));
$temp_id=strip_tags(urldecode(stripslashes($_POST['temp_id'])));
$temp_element_id=strip_tags(urldecode(stripslashes($_POST['temp_element_id'])));
$status=$this->send_message($conversationid,$userid,$return_type,$message,$temp_id,$temp_element_id);
echo $status;
}

if(isset($_POST['action']) AND  $_POST['action']=="search_user"){
	$return_type=urldecode(stripslashes($_POST['returntype']));
	$limit=(int)urldecode(stripslashes($_POST['limit']));	
	$name=urldecode(stripslashes($_POST['name']));
$like_where=array("firstname"=>$name,"lastname"=>$name);
$user=$this->search_user(null,null,null,$like_where,$limit,$return_type);
echo $user;
}


if(isset($_POST['action']) AND  $_POST['action']=="new_conversation"){
$returntype=urldecode(stripslashes($_POST['returntype']));
$receivers=$_POST['receivers'];
$title=urldecode(stripslashes($_POST['conversation_title']));
$message=urldecode(stripslashes($_POST['message']));
$creater_userid=$_SESSION['userid'];
$user_submitted_id=urldecode(stripslashes($_POST['from']));

if((is_array($receivers) && count($receivers)>1) && ($user_submitted_id==$creater_userid) ){
	$result=$this->create_conversation($receivers,$title,$message,$creater_userid,$returntype);
	if($result){
		echo $result;
	}
	else{
	$error=array("ERROR"=>6,"MESSAGE"=>"Unknown Error");	
echo json_encode($error);
return false;	
		
	}
}
elseif(count($receivers)<2 OR !is_array($receivers)){
$error=array("ERROR"=>1,"MESSAGE"=>"You Need More Than 1 Reciver For Create a Conversation");	
echo json_encode($error);
return false;	
}
elseif($user_submitted_id!==$creater_userid){
$error=array("ERROR"=>2,"MESSAGE"=>"Invalid Operation");	
echo json_encode($error);
return false;		
}
else{	
$error=array("ERROR"=>3,"MESSAGE"=>"Unknown Error");	
echo json_encode($error);
return false;				
}
}
}
protected function conversation_last_msg($id,$last_sender,$last_message){
	$db = MysqliDb::getInstance();	
	$data=array("last_sender"=>$last_sender,"last_message"=>$last_message,"last_date"=>date("Y-m-d H:i:s"));
	$db->where("id",$id);
	$db->update("conversations",$data);
	
}

protected function send_message($conversationid,$userid,$returntype,$message,$temp_id=null,$temp_element_id=null){
	$db = MysqliDb::getInstance();	
	$datenow=date("Y-m-d H:i:s");
	$status=array();
	$data = Array ("conversationid" =>$conversationid,
               "userid" => $userid,
               "message" => $message,
			      "sent_date" => $datenow
);
$id = $db->insert ('messsages', $data);
$this->conversation_last_msg($conversationid,$userid,$message);
if($id){
	$status['status']="success";
	$status['id']=$id;
	$status['conversationid']=$conversationid;
	if($temp_id!==null && $temp_element_id!==null){
		$status['temp_id']=$temp_id;	
        $status['temp_element_id']=$temp_element_id;		
	}
}
else{
	$status['status']="faild";
	$status['conversationid']=$conversationid;
	if($temp_id!==null && $temp_element_id!==null){
		$status['temp_id']=$temp_id;	
        $status['temp_element_id']=$temp_element_id;		
	}
}

if($returntype=="array"){
	return $status;
}
elseif($returntype=="json"){
	
	return json_encode($status);
}
}

protected function join_usersto_conversation($userid,$conversationid){
$db = MysqliDb::getInstance();	
$datenow=date("Y-m-d H:i:s");
$data = Array ("conversationid" => $conversationid,
               "userid" =>$userid,
               "joined_date" =>$datenow
			);
$id = $db->insert ('joined_conversations', $data);

if($id){
	return true;
}
else{
	return false;
}
}
protected function create_message($conversationid,$userid,$message){
$db = MysqliDb::getInstance();	
$datenow=date("Y-m-d H:i:s");
$data = Array ("conversationid" => $conversationid,
               "userid" =>$userid,
               "message" =>$message,
			   "sent_date" =>$datenow
			);
$id = $db->insert ('messsages', $data);
	
	if($id){return true;}else{return false;}
	
}

protected function get_receivers_inconversation($conversationid,$returntype){
$db = MysqliDb::getInstance();		
$db->join("personalaccount p", "j.userid=p.id", "LEFT");	
$db->where("j.conversationid",$conversationid);

$result= $db->get ("joined_conversations j",null, "j.userid,j.id,j.conversationid,j.joined_date,p.pictureurl");		

if($returntype=="json"){
	echo json_encode($result);
}	
elseif($returntype=="array"){
	return $return;
}
}
protected function create_conversation($receivers,$title,$message,$creater_id,$returntype){
$db = MysqliDb::getInstance();	
$datenow=date("Y-m-d H:i:s");
$data = Array ("users" => count($receivers),
               "watched" => 0,
               "conversation_name" =>$title,
			   "last_sender" =>$creater_id,
			   "last_message" =>substr($message,0,20),
			   "last_date" =>$datenow
			   
);
$id = $db->insert ('conversations', $data);
	
if($id){
$message=$this->create_message($id,$creater_id,$message);
$join=false;
for($i=0;$i<count($receivers);$i++){
$join=$this->join_usersto_conversation($receivers[$i],$id);
}


if($message && $join){
	
$final_result=array("status"=>"complete","conversationid"=>$id);
if($returntype=="json"){
	return json_encode($final_result);
}
elseif($returntype=="array"){
	return $final_result;
}
	
}
elseif(!$join){
		
$final_result=array("ERROR"=>5,"MESSAGE"=>"Faild to  Join Receivers to The Conversation");
if($returntype=="json"){
	return json_encode($final_result);
}
elseif($returntype=="array"){
	return $final_result;
}
	
}
elseif(!$message){
		
$final_result=array("ERROR"=>4,"MESSAGE"=>"Faild to Create Message");
if($returntype=="json"){
	return json_encode($final_result);
}
elseif($returntype=="array"){
	return $final_result;
}
	
}
else{
return false;	
}	
	
}
}
protected function check_user_inconversation($userid,$conversationid){
	$db = MysqliDb::getInstance();	
	$db->where("conversationid",$conversationid);
	$db->where("userid",$userid);
	$result=$db->getValue("joined_conversations","userid");

if($result){
return true;	
}	
else{
	return false;
}
}
protected function get_messages_inconversation($conversation_id,$userid,$limit=array(),$returntype="array"){
	if(count($limit)<2){
		$limit=null;
	}
$db = MysqliDb::getInstance();	
$db->join("personalaccount p", "m.userid=p.id", "LEFT");	
$db->join("conversations c", "m.conversationid=c.id", "LEFT");	
$db->where("m.conversationid",$conversation_id);	
$db->orderBy("m.id","desc");
$result= $db->get ("messsages m", $limit, "m.id,m.userid,m.conversationid,m.message,m.sent_date,p.pictureurl,p.firstname,c.conversation_name");	
	
	
	if($returntype=="array"){
		return  array_reverse($result);
	}
	elseif($returntype=="json"){
		return json_encode( array_reverse($result));
			}
	
}
protected function get_conversation_data($conversation_id,$return_type){
	$db = MysqliDb::getInstance();	
	$db->where("id",$conversation_id);	
	if($return_type=="array"){
	$result=$user = $db->getOne ("conversations");
	return $result;
	}
	elseif($return_type=="json"){
	$result=$db->JsonBuilder()->getOne("conversations");;
	return $result;	
	}
}
protected function get_joined_conversations($userid,$limit_from,$limit_to,$return_type,$orderby=null){
	$output=array();
$db = MysqliDb::getInstance();	
$db->where("userid",$userid);
$db->orderBy("joined_date","DESC");
if($limit_to!==null AND $limit_to>0){
	$limit=array($limit_from,$limit_to);
}
else{	
	$limit=null;
}
$i=0;
$result=$db->get ("joined_conversations", $limit,"conversationid");	
foreach($result as $id){
$i=$i+1;
$conversation_id=$id['conversationid'];
$conversation_info=$this->get_conversation_data($conversation_id,"array");
$last_userid=$conversation_info['last_sender'];
$last_message=$conversation_info['last_message'];
$last_user_picture=$this->get_profile_picture($last_userid,"personalaccount",null);
$conversation_info['last_userid']=$last_userid;
$conversation_info['last_message']=$last_message;
$conversation_info['last_userpicture']=$last_user_picture;
$output[$i]=$conversation_info;


}

if($return_type=="array"){
	return $output;
}
elseif($return_type=="json"){
	
	return json_encode($output);
}	
	
}
	
	
	
	
	
	
	
	
}
$message=new Message();
?>
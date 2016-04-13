<?php require_once("../config.php");
if(!isset($_SESSION['username'])){
header("LOCATION:../index.php");
exit;	
}

?>

<?php include("tem/header.html"); ?>
<link rel='stylesheet' href='../media/inbox.css' />
<?php  require_once("left_panel.php"); ?>
<?php require_once("../includes/functions.php");?>

<?php $from_admin=0;?>transitions.js

<script src='../includes/messages_app/message.js'  type='text/javascript' ></script>
<script src='../includes/ajax.js'  type='text/javascript' ></script>
<link  rel='stylesheet' href='../media/ios7stylemessages.css' />

<style>


</style>
 <br/>  <br/>  <br/>
    <br/>  <br/>
	
<div class='profilecontainer' style='width:90%'>
<div class='leftpanel' style="float:left; width:220px; height:auto; ">

<center>


<br/>







<?php get_sidebar();?>
	

</div>
<div class="centercontent">



<?php require_once("../includes/messages_app/inbox.php"); ?>




<br/>





</div>

<?php require_once("rightsidebar.php");?>


</div>



</div>








</div>






</div></div>
	


</div>
</div>
</div>


<script>
	
	var inbox=new Inbox(<?php echo (int) $_SESSION['userid'];?>);
	inbox.messageclassurl="<?php echo $website_url;?>includes/messages_app/Message.php"
inbox.getconversations();

function send_message_callback(msg){

	messages=JSON.parse(msg);
	if(messages.status=="success"){
    temp_element_id=messages.temp_element_id;
	
	id=messages.id;
	new_id="message"+id;
	$("#"+temp_element_id).find( ".msg_sent" ).removeClass("message_sending");
	$("#"+temp_element_id).attr("id","message"+id);
	$("#"+new_id).attr("message-id",id);
	}
	else{
		
		
	}
}
function send_message_loading(data){
	var message;
	var userid;
	var picture="<?php echo $_SESSION['personalaccountpicture']; ?>";
	if(picture=="" || picture==null){
		picture="<?php echo NO_USER_IMG;?>";
	}
	
	var messageclass;
	var temp_message_id;
	
  for(i in data){
   switch(data[i].name){
	   
	   case "message":
	   message=data[i].value;
	   break;
	   case "temp_id":
	   temp_message_id=data[i].value;
	   break;
	   case "messageclass":
	   messageclass=data[i].value;
	   break;
	   
   }
  
    }
var temp_message_element_id="message"+temp_message_id;	
var timenow="<?php echo date("Y-m-d H:i:s"); ?>";
output="<div  id='"+temp_message_element_id+"' message-id='"+temp_message_id+"'class='row msg_container base_sent'><div class='col-md-10 col-xs-10'><div class='messages msg_sent message_sending'>                                <p>"+message+"</p>                          <time  class='timeago'title='"+timenow+"'></time>        <time>You &nbsp;  • &nbsp;    </time>                        </div>                        </div>                        <div class='col-md-2 col-xs-2 avatar'>                            <img src='"+picture+"' class=' img-responsive '>                        </div>                    </div>";

$("."+messageclass).append(output);
$("."+messageclass).animate({ scrollTop: $("."+messageclass).prop("scrollHeight")}, 1000);
$.getScript("../includes/messages_app/transitions.js", function(){
   
});

}
function send_message(id){
form_id=$(id).attr("id");
message_class=$("#"+form_id+" input[name=messageclass]").attr("value");
	data=$(id).serialize();
	
	array_form_data=$("#"+form_id).serializeArray();
inbox.sendmessages(data,"json",send_message_callback,send_message_loading(array_form_data),inbox.messageclassurl);
	

	return false;
}
function receivers_callback(msg){

	receivers=JSON.parse(msg);
		for(var i in receivers)
{
	
		userid=receivers[i].userid;
	picture=receivers[i].pictureurl;
if(picture=="" || picture==null){
		picture="<?php echo NO_USER_IMG;?>";
	}
	$(".joined-users-chat").append("  <div  id='receiver_"+userid+"'class='conversationreceipent' style='background-image: url("+picture+");    background-repeat: round;'>  </div>");	
}


}
function receivers_loading(){
	
}
function get_receivers(conv_id){
	
	inbox.getreceivers(conv_id,receivers_callback,receivers_loading,"json",inbox.messageclassurl);
	

}
function load_more_messages_callback(msg){
	$(".loading-more").fadeOut();
messages=JSON.parse(msg);
conversationid0=messages[0].conversationid;
message_element_name=conversationid0+"_eachmessage_class";

	for(var i in messages)
{
	
userid=messages[i].userid;
myuserid=<?php echo $_SESSION['userid'];?>;
picture=messages[i].pictureurl;
if(null==picture ){picture='<?php echo NO_USER_IMG;?>';}
if(picture==""){picture='<?php echo NO_USER_IMG;?>';}
conversationid=messages[i].conversationid;
conversationname=messages[i].conversation_name;


message_content=messages[i].message;
datetime=messages[i].sent_date;
firstname=messages[i].firstname;
message_elemenent_id="message"+messages[i].id;





if(userid==myuserid){

output="<div id='"+message_elemenent_id+"' message-id='"+messages[i].id+"' class='row msg_container base_sent'><div class='col-md-10 col-xs-10'><div class='messages msg_sent'>                                <p>"+message_content+"</p>                          <time  class='timeago'title='"+datetime+"'>  "+datetime+"</time>        <time>"+firstname+"  &nbsp;  • &nbsp;    </time>                        </div>                        </div>                        <div class='col-md-2 col-xs-2 avatar'>                            <img src='"+picture+"' class=' img-responsive '>                        </div>                    </div>";

///$("."+message_element_name).prepend(output);
$(output).hide().prependTo("."+message_element_name).fadeIn(2000);
$.getScript("../includes/messages_app/transitions.js", function(){
   
});

}
else{
	
	output="<div class='row msg_container base_receive'><div class='col-md-10 col-xs-10'><div class='messages msg_receive'>                                <p>"+message_content+"</p>                         <time>"+firstname+"  &nbsp;  • &nbsp;    </time>          <time class='timeago' datetime='"+datetime+"'></time>                          </div>                        </div>                        <div class='col-md-2 col-xs-2 avatar'>                            <img src='"+picture+"' class=' img-responsive '>                        </div>                    </div>";

$(output).hide().prependTo("."+message_element_name).fadeIn(2000);
	$.getScript("../includes/messages_app/transitions.js", function(){
   
});
}
}
}
function load_more_messages_loading(){
	$(".loading-more").fadeIn();
}
function load_more_messages(conversationid,messagecount){
message_limit=messagecount+inbox.messages_per_new_load;
inbox.getmessages(conversationid,messagecount,message_limit,load_more_messages_callback,load_more_messages_loading,"json",inbox.messageclassurl);
}
function show_messages(msg){
	
	$("#select_conversation_default").hide();
	$("#messagecontent").html("");
	$(".joined-users-chat").html("");
	messages=JSON.parse(msg);
conversationname=messages[0].conversation_name;
conversationid0=messages[0].conversationid;
 get_receivers(conversationid0);
formid="conversation_messages_"+conversationid0;
message_class=conversationid0+"_eachmessage_class";
chatroom_header="<div class='container'>    <div class='row chat-window col-xs-5 col-md-3' id='chat_window_1' style='margin-left:10px;'> <div class='col-xs-12 col-md-12'><div class='panel panel-default'> <div class='panel-heading top-bar'> <div class='col-md-8 col-xs-8'><h3 class='panel-title'><span class='glyphicon glyphicon-comment'></span> "+conversationname+"</h3></div> <div class='joined-users-chat' > </div> </div><div class='loading-more'></div> <div id='messagebody'  conversationid='"+conversationid0+"'   style=''class=' messagebody panel-body msg_container_base  "+conversationid0+"_eachmessage_class'></div><div class='panel-footer'> <div class='input-group'> <form  class='sendmessage'id='"+formid+"' onsubmit='send_message("+formid+");return false;' method='post'><input id='btn-input'  name='message'style='height:35px; width:80%;' type='text' class='form-control input-sm chat_input' placeholder='Write your message here...' /> <span class='input-group-btn'> <button class='btn btn-primary btn-sm' id='btn-chat'>Send</button><input type='hidden' name='conversationid' value='"+conversationid0+"' /><input type='hidden' name='userid' value='<?php echo $_SESSION['userid'];?>' /><input type='hidden' name='messageclass' value='"+message_class+"' /><input type='hidden' name='temp_element_id' value='message<?php echo sha1(date("ymdHis")); ?>' /><input type='hidden' name='temp_id' value='<?php echo sha1(date("ymdHis")); ?>' /> <input type='hidden' name='returntype' value='json' /><input type='hidden' name='action' value='send_message' /></form>      </span>      </div>        </div></div> </div> </div></div>";


chatroom_footer="  ";


$("#messagecontent").append(chatroom_header);
$("#messagecontent").append(chatroom_footer);

	for(var i in messages)
{

userid=messages[i].userid;
myuserid=<?php echo $_SESSION['userid'];?>;
picture=messages[i].pictureurl;
if(null==picture){picture='<?php echo NO_USER_IMG;?>';}
if(picture==""){picture='<?php echo NO_USER_IMG;?>';}
conversationid=messages[i].conversationid;
conversationname=messages[i].conversation_name;


message_content=messages[i].message;
datetime=messages[i].sent_date;
firstname=messages[i].firstname;
message_elemenent_id="message"+messages[i].id;





if(userid==myuserid){

output="<div id='"+message_elemenent_id+"' message-id='"+messages[i].id+"' class='row msg_container base_sent'><div class='col-md-10 col-xs-10'><div class='messages msg_sent'>                                <p>"+message_content+"</p>                          <time  class='timeago'title='"+datetime+"'>  "+datetime+"</time>        <time>"+firstname+"  &nbsp;  • &nbsp;    </time>                        </div>                        </div>                        <div class='col-md-2 col-xs-2 avatar'>                            <img src='"+picture+"' class=' img-responsive '>                        </div>                    </div>";

$("#messagebody").append(output);

$.getScript("../includes/messages_app/transitions.js", function(){
   
});
$.getScript("../media/message_load_more_scroll.js", function(){
   
});
}
else{
	
	output="<div class='row msg_container base_receive'><div class='col-md-10 col-xs-10'><div class='messages msg_receive'>                                <p>"+message_content+"</p>                         <time>"+firstname+"  &nbsp;  • &nbsp;    </time>          <time class='timeago' datetime='"+datetime+"'></time>                          </div>                        </div>                        <div class='col-md-2 col-xs-2 avatar'>                            <img src='"+picture+"' class=' img-responsive '>                        </div>                    </div>";

$("#messagebody").append(output);
	$.getScript("../includes/messages_app/transitions.js", function(){
   
});
}

$("."+message_class).scrollTop($(document).height());
}	
	

	

	
}
function show_messages_loading(){
	$("#select_conversation_default").html("");
$(".messages_loading_loader").fadeIn();
}
function get_conversation_messages(id,limit_from,limit_to){
if(null==limit_from){
		limit_from=0;
	}
	if(null==limit_to){
	limit_to=20;
	}
	conversationid=$(id).attr("conv_id");
	inbox.getmessages(conversationid,limit_from,limit_to,show_messages,show_messages_loading,"json",inbox.messageclassurl);
}
function removetag(userid){

receiver_element_name="receiver_"+userid;
$("#"+receiver_element_name).remove();
$('.usertag').each(function(i, obj) {
if($(this).attr("userid")==userid){
	$(this).remove();
}
});
}
function add_tags(arr){
userid=$("#"+arr).attr("userid");
fullname=$("#"+arr).attr("firstname")+"\t \t "+$("#"+arr).attr("lastname").substr(0,11);

output="<li userid='"+userid+"' class='usertag'><a >"+fullname+"</a>  <span onclick='removetag("+userid+")' style='margin-left:5px;cursor:pointer; margin-right:5px;'>&#10799;  </span></li>";
$(".tags").append(output);

output2="<input type='hidden' name='receivers[]' id='receiver_"+userid+"' value='"+userid+"'  /> " ;

$("#new_msg_form").append(output2);	
}
function compose_message_intial_settings(){
	
$(".suggestions").hide();	
$(".caretss").hide();
$("#blue-loader-search-users").hide();	
}
function hide_loaders(loader_id){
		$(loader_id).fadeOut();
}
function display_loaders(loader_id){
		$(loader_id).fadeIn();
}
 function show_autocomplete(msg){
	 compose_message_intial_settings();
	  
	  
	$(".suggestions").html("");
	users=JSON.parse(msg);
	count=users.length;
	
	if(count>0){
		
$(".suggestions").fadeIn();
	
	
	$(".caretss").fadeIn();
	
	for(var i in users)
{
	firstname=users[i].firstname;
	userid=users[i].id;
		lastname=users[i].lastname;
	profilepicture=users[i].pictureurl;
	bio=users[i].bio.substr(0,15);
	element_id=Math.floor((Math.random() * 1000) + 1);
	
	if(profilepicture=="" ){profilepicture='<?php echo WEBSITE_URL; ?>media/none.120x120.png';}
 output="<a id='"+element_id+"' userid="+userid+" firstname="+firstname+" lastname="+lastname+" class='suggestion_each' onclick='add_tags("+element_id+");'><div class='suggestion' ><i class='icon' style='background: url("+profilepicture+") no-repeat; background-size:contain;'></i><span class='title'>"+firstname+" "+lastname+"</span><div class='description'>"+bio+"</div></div></a>";
	$(".suggestions").append(output);
}
	}
	else{
	$(".suggestions").fadeIn();	
	$(".caretss").fadeIn();	
		 output="<div class='suggestion'><i class='icon' style='background: url(<?php echo WEBSITE_URL;?>media/message_icons/usernotfound.png) no-repeat; background-size:contain;'></i><span class='title'>No Users </span><div class='description'></div></div>";
	$(".suggestions").append(output);
	}
 }
 
 function autocomplete_loading(){
	 
	 display_loaders("#blue-loader-search-users");
 }
function display_conversations(msg){
$(".msgList").html("");
hide_loaders("#loading-conversations-loader");
conversations=JSON.parse(msg);
if(conversations.length<2){
	out="<br/><br/><center><p >No Conversations To Display</p></center>";
	$(".msgList").html(out);
	
}
else{
for(var i in conversations)
{
	id=conversations[i].id;
	users=JSON.parse(conversations[i].id);
	last_date=conversations[i].last_date;
	last_message=conversations[i].last_message;
	last_userid=conversations[i].last_userid;
	last_userpicture=conversations[i].last_userpicture;

if(last_userpicture==""){last_userpicture='<?php echo NO_USER_IMG;?>';}
	
	watched=conversations[i].watched;
	conversation_name=conversations[i].conversation_name;
    article_id="conversation_"+id;
out="<article id='"+article_id+"' conv_id='"+id+"' onclick='get_conversation_messages("+article_id+")' class='message'><div class='ssss' style='width:40px; height:40px; border-color:white;  vertical-align:middle;border-radius:30px; background-image:url("+last_userpicture+");background-size: 40px 40px;background-repeat:no-repeat;float:left;position:absolute;top: 35;margin-left:10px;margin-right:10px;'></div><div style='width:95%;height:81px;float:right;'><a id='ms' href='#message-1' class='msg' name='id' sender_userid='last_userid' conv_id='conversationid'style=''><h2 style='margin-left:20px;'>"+conversation_name+"</h2><div style='width:90%;height:30px;margin-left:20px;overflow:hidden;'class='msgSummary'><small>"+last_message+"</small></div><i class='icon-chevron-right'></i></a></div></article>"
	$(".msgList").append(out);

     
}
}
}

function cal2(){
display_loaders("#loading-conversations-loader");
	
}
function createconversation_callback(msg){

conversation=JSON.parse(msg);
if (conversation.hasOwnProperty('ERROR')) {
	message=conversation.MESSAGE;
	$("#create_conversation_error").html(message);
$("#create_conversation_error").fadeIn();


hide_loaders("#css_loader_newconversation");
}
else{

$('.modal').hide();
$('.modal-backdrop').hide();
inbox.getconversations();	
hide_loaders("#css_loader_newconversation");	
}


}
function createconversation_loading(){
display_loaders("#css_loader_newconversation");
}
function create_conversation(){

form=$("#new_msg_form").serialize();
inbox.createconversation(form,createconversation_callback,createconversation_loading,"json",inbox.messageclassurl);
}

	</script>

<script>


	$(document).ready(function(){

$('#recievers_search').on('input', function() {
var receiver_name=$("#recievers_search").val();
inbox.searchusers(receiver_name,5,show_autocomplete,autocomplete_loading,"json",inbox.messageclassurl);
});
		$(".suggestion_each").click(function(){
	alert("SSS");
	});
	$('#recievers_search').focusout(function(){
		$(".caretss").fadeOut();
	$(".suggestions").fadeOut();
	});
	});




</script>

<script src='../includes/messages_app/transitions.js'  type='text/javascript' ></script>
<?php      include("../tem/footer.html");    ?>
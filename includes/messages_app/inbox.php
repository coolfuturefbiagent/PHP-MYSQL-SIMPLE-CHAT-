<?php

class Messages{









}

$msg=new Messages();



?>
<?php require_once("conversations.php");?>






















	
		
	<!-- Modal -->
<form  id='new_msg_form' >
<div id="compose_message" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Compose Message </h3>
	
  </div>
  <div id='create_conversation_error' style='display:none;' class="alert alert-error">
  ...
</div>
  <div class="modal-body">
<div id='message_sent' style='display:none;'>
<h3>Message Sent</h3>

</div>

<div id='message_error' style='display:none;'>
<h3>Error Sending Message</h3>
<p id='reason'></p>
</div>
  <div id='new_msg_box'>
  

<div class="control-group ">
	<label  style=' vertical-align:middle; line-height:26px;'class="control-label">Conversation Title </label>
	<div class="controls">
	<input  autocomplete="off" id='conversation_title' type="text" name="conversation_title" placeholder="Enter Conversation Title"  value="" style="width:350px;  height:30px; border: 1px solid #6cf; " /> 

	</div>
	</div>

<div class="control-group ">
	<label  style=' vertical-align:middle; line-height:26px;'class="control-label">Receivers</label>
	<div class="controls">
	<input  autocomplete="off" id='recievers_search' type="text" name="recievers_search" placeholder="Enter Receiver Name"  value="" style="width:200px;  height:30px; border: 1px solid #6cf; " /> 

	<div class='loading-gif-blue' id='blue-loader-search-users' >
	<img src='' />
	
	</div>
	<div class="caretss" style='display:none;'></div>
	
	  <div class="suggestions" style='display:none;'>
           
           
            </div>
	
	
	
	
	
	
	
	
	
	
	

	<ul class="tags">
	
	

</ul>
<br/>
	</div>
</div>

<input type='hidden' name='receivers[]' value='<?php echo $_SESSION['userid']; ?>' />
<input type='hidden' name='from' value='<?php echo $_SESSION['userid']; ?>' />
<input type='hidden' name='action' value='new_conversation' />
<input type='hidden' name='returntype' value='json' />
<div class="control-group " style='padding-top:5px;'>
	<label  style=' vertical-align:middle;  clear:both;'class="control-label">Message</label>
	<div class="controls">
	<textarea name="message" placeholder="Enter Receiver Name"  value="" style="width:400px;  height:100px; border: 1px solid #6cf; "> 
</textarea>
	</div>
</div>


	

	
  </div>
  </div>
  <div class="modal-footer">
  <div class="cssload-thecube"  id='css_loader_newconversation'style='display:none;    position: absolute;
    float: left;
    margin-left: 40%;
    bottom: 20;'>
	<div class="cssload-cube cssload-c1"></div>
	<div class="cssload-cube cssload-c2"></div>
	<div class="cssload-cube cssload-c4"></div>
	<div class="cssload-cube cssload-c3"></div>
</div>
    <button class="btn" id='close_modal_compose' data-dismiss="modal" aria-hidden="true">Close</button>
    <button id='submit' onclick='create_conversation()'class="btn btn-primary">Send </button>
  </div>
</div>
		</div>
		
	</form>	
		
<script>


$(document).ready(function(){


$("#submit").click(function(){
var form=$("#new_msg_form");
$.ajax({

  method: "POST",
  url: "<?php echo $website_url;?>includes/messages_app/Message.php",
  data: form.serialize()
})
  .done(function( msg ) {

var obj = jQuery.parseJSON(msg);

if(obj.error=="NO_ERROR"){


no_error_situation();

}else{

error_situation(obj.error);
}


  });


return false;



});


function no_error_situation(){
load_conversations();
$("#new_msg_box").fadeOut();
$("#message_sent").fadeIn();



}

function error_situation(reason){
$("#new_msg_box").fadeOut();
$("#reason").html(reason);
$("#message_error").fadeIn();



}

$("body").click(function(){
$("#too").fadeOut();

});
$("#to").keypress(function(){
$name=$("#to").val();
$("#username").val("");
$.ajax({

  method: "POST",
  url: "<?php echo $website_url;?>includes/messages_app/Message.php",
  data: { type: "autofill", name:$name }
})
  .done(function( msg ) {
  $("#too").fadeIn();
    $("#sug").html(msg);
get_it();
  });


});

function get_it(){
$(".autofill_username").click(function(){
$username=$(this).attr("name");
$name=$(this).attr("alt");
$("#username").val($username);
$("#to").val($name);

$("#to").stop().css("background-color", "#FFFF9C")
    .animate({ backgroundColor: "#FFFFFF"}, 1500);

});
}



});

</script>
		
		

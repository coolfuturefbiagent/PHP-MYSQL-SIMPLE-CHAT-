var times=0;
$(".messagebody").on('scroll', function() {
    var count=0;
console.log(times);
if($(this).scrollTop()==0 && times==0){
times=times+1;
conversationid=$(this).attr("conversationid");

number_of_messages=$(this).children().size();
load_more_messages(conversationid,number_of_messages);

}


});
function reset_times(){
times=0;
}
setInterval( reset_times, 7000 );
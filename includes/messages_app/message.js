var Inbox=function(userid,limit){
this.userid=userid;
this.limit=limit;
this.conversationslimit_from=0;
this.conversationslimit_to=20;
this.messageclassurl="";
this.messages_per_new_load=10;
};

Inbox.prototype.getconversations=function(){

parameters={ returntype: "json",limit_to:this.conversationslimit_to,limit_from:this.conversationslimit_from,userid:this.userid,action:"get_conversations"};
ajax.post(this.messageclassurl,parameters,display_conversations,cal2);

};

Inbox.prototype.searchusers=function(user_name,limit,callback,loading,returntype,url){

parameters={ returntype:returntype,limit:limit,name:user_name,action:"search_user"};

ajax.post(url,parameters,callback,loading);

};

Inbox.prototype.createconversation=function(data,callback,loading,returntype,url){
ajax.post(url,data,callback,loading);
};

Inbox.prototype.getmessages=function(conversationid,limit_from,limit_to,callback,loading,returntype,url){
parameters={conversationid:conversationid,limit_from:limit_from,limit_to:limit_to,action:"get_messages",returntype:"json"};

ajax.post(url,parameters,callback,loading);
}
Inbox.prototype.sendmessages=function(data,returntype,callback,loading,url){

ajax.post(url,data,callback,loading);
}
Inbox.prototype.getreceivers=function(conversationid,callback,loading,returntype,url){
parameters={conversationid:conversationid,action:"get_receivers",returntype:"json"};
ajax.post(url,parameters,callback,loading);
}
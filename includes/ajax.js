var ajax = {};

ajax.post = function(url,data,callback,loading){

$.ajax({
  type: "post",
  url: url,
  data: data,
  beforeSend: function() {
      if(!!loading){
	  loading();
	  }
    },
})

  .done(function( msg ) {
  if(!!callback){
   callback(msg);
   
   }
  });

};

ajax.get=function(url,data,callback,loading){

$.ajax({
  method: "GET",
  url: url,
  data: data,
    beforeSend: function() {
      if(!!loading){
	  loading();
	  }
    },
})
. beforeSend(function(){
loading();
})
  .done(function( msg ) {
   callback();
  });

};
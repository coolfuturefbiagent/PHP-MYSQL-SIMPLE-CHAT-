$(document).ready(function(){




	$('[data-toggle="modal"]').click(function(e) {
  
     $url = $(this).attr('ajax_load');
  $data=$(this).attr('ajax-data');
  $data2=$(this).attr('ajax-data2');
  $data3=$(this).attr('ajax-data3');
  $data4=$(this).attr('ajax-data4');
 $modal_class = $(this).attr('modal');
  $call_back=$(this).attr("call_back_function");

  $.ajax({

  type: "POST",
  url: $url,
  
  data: { data:$data ,data2:$data2,data3:$data3,data4:$data4},
        success: function(msg){
  // reviews_callback(msg);
  window[$call_back](msg);
            }

});
  
  
  
  
  
  
  
//  var url = $(this).attr('ajax_load');
  //var ajax_data=$(this).attr('ajax-data');
  //var modal_class = $(this).attr('modal');
  //$.get(url+"?"+, function(data) {
  //$("."+modal_class).find(".modal-body").html(data);
 
 // });
});









});
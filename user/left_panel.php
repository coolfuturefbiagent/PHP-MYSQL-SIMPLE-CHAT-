<?php



function get_sidebar($page=""){
?>
 <div class='sidebar'>
 <div class='sidebarslot1'>

 <div class='iconclz' id="icon1">
 
 
 </div>
 <div class='menuname'>
 
 <p class="pclassmenu"><a href="index.php">Profile Settings</a></p>
 </div>
 </div>
 

 

 
   <div class='sidebarslot1'>

 <div class='iconclz ' id="icon11">
 
 
 </div>
 <div class='menuname'>
 
 <p class="pclassmenu"><a href="messeges.php">Messeges</a></p>
 </div>
 </div>
 
 
 
 
 
 
 
 </div>
<br/>
<br/>
<br/><br/>
<br/>
<br/>
<?php

}



?>


<?php



function get_filters(){


?>

 <div class='fil2'  style="width:100%; height:auto; background: #EEE; margin-top:10px; border-radius:4px;">
 <div class="pad20 bgf4 round-4 mb20" style="padding: 20px;">
		<h6>FILTERS</h6>
		<dl>
			<dt>Status</dt>
			<dd class="" ><a href="courses.php?filter=booked" style="color: #333;">Booked Courses</a></dd>
			<dd class=""><a href="courses.php?filter=reserved" style="color: #333;">Reserved Courses</a></dd>
			<dd class=""><a href="courses.php?filter=canceled" style="color: #333;">Cancelled Courses</a></dd>
			<dd><a href="courses.php?filter=all" style="color: #333;">All</a></dd>
		</dl>
	</div>

</div>

<?php }?>




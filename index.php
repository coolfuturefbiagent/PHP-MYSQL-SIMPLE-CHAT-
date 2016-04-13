<?php include("config.php"); ?>



<?php  if(isset($_SESSION['username'])){ include("tem/userheader.html");}

else{
	include("tem/header.html");
}?>

<?php
if(!isset($_SESSION['username'])){
	
	
}

?>



<?php require_once("includes/user.php");$user=new User();?>


<style>
a{color:black;}
.activitya{ color:#08C;}
.activitya:hover{ text-decoration:underline;}

</style>
  <div class='ccc'>
     

		   

		  
	
			 
			 
			 
			 
			 

			 

		   
		   
		   
		   
		   <div style='width:1050px;margin:0 auto; height:400px;'>
               <div class='centerbox' style='width:620px;  float:left; margin-right:20px;height:370px;'>
                          <iframe width="620" height="349" src="https://www.youtube.com/embed/NpkvTna-UCk?vq=hd720;HD=1;rel=0;showinfo=0;controls=0" frameborder="0" allowfullscreen=""></iframe>
          </div> 
            <div class='rightbox' style=' border-radius:4px;  height:370px;  float:left;background: url(media/box-q.png); display:<?php       if(isset($_SESSION['username'])){ echo "none";}    ?>' >
                           
                 <div class='stitle'>
                  New to Dawrat?
                      
                      </div>
<form class="form-horizontal"  action="signup.php" method="post">
  <div class="control-group">
    <label class="control-label" for="firstname">First Name</label>
    <div class="controls">
      <input type="text" style='height:30px; margin-right:10px;' name="firstname" id="firstname">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="lastname">Last Name</label>
    <div class="controls">
      <input type="text"style='height:30px; ' name="lastname" id="lastname" >
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="password">Password</label>
    <div class="controls">
      <input type="password" style='height:30px'  name="password"id="password">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="email">Email</label>
    <div class="controls">
      <input type="text" style='height:30px'  name="email"id="email">
    </div>
  </div>
<button class="btn btn-large btn-block btn btn-success" type="submit"><h4>Sign up Now</h4></button>
</form>
               </div>  
            <div class='activityhompage' style="float:left; height:370px; overflow:auto; margin-left:20px; margin-bottom:20px;display:<?php     if(!isset($_SESSION['username'])){ echo "none";}     ?>">
  <div class='backimg' style="background-image:url(media/box-g.png);">

              
</div>
  <p style='font-size: 1.1em;
color: #D4D4D4;
font-weight: 300; margin-top:10px; margin-left:10px;' >Activity</p>
<table class="table table-striped" style="width:84%; border:none; margin:0 auto;  font-size:13.53px">
              <thead>
                <tr>
                  <th></th>
                  
                </tr>
              </thead>
              <tbody>

       
              
                     
              </tbody>
            </table>
  </div>
          </div>
		  </div>
		  
          <div  class='homepagecoursesnew'>
			  
		

  </div>
  </div>            </div>
                  
         
  
  </div>


<?php include("tem/footer.html") ?>

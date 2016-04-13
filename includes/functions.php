<?php

class functions{

function getcourselist(){
	
	$username=$_SESSION['username'];
	$userid=$_SESSION['userid'];
	if(!isset($_GET['h'])){
	$h="";
	
	}
	else{
		$h=$_GET['h'];
		
	}
global	$val;
	switch($h){
	 	
		case "online":
		$val="online";
		break;
		case "offline":
		$val="offline";
		break;
		case "pending":
		$val="Pending Approval";
		break;
		
		case "all":
		$val="";
		break;
		
		default:
		$val="";
		break;
		
	}
		
	
	if($val!==""){
			$sql="SELECT * FROM courses WHERE userid='$userid' AND status='$val' ORDER BY courseid DESC";	

	}
	else{
			$sql="SELECT * FROM courses WHERE userid='$userid' ORDER BY courseid DESC";

	}
$query=mysql_query($sql);

while($course=mysql_fetch_array($query)){
$courseid=$course['courseid'];
$status=$course['status'];
echo "<div class='courselist'>
<div class='courseimageinlist'>


<img src='../media/none.60x60.png' width='40px;' height='40px;'>





</div>
<div class='vieweditbuttons'>
<a class='btn btn-small' href='course.php?id={$course['courseid']}'><i class='viewicon'></i> View</a>
<a class='btn btn-small' href='editcourse.php?courseid={$course['courseid']}'><i class='viewicon' style='background-position: -96px -72px;'></i> Edit</a>

</div>
<a href='course.php?id={$course['courseid']}' style='font-size: 1.3em;color: #08C; float:left;
text-decoration: none; margin-left:15px;'>{$course['coursename_en']}</a><a style='font-size: 1.0em; line-height:25px; float:left; margin-left:5px;
font-weight: bold;'><small>{$course['coursetype']}</small></a><label style='float:left; margin-top:4px; margin-left:6px; background-color:"; if($status=="online"){ echo "#468847;";} else{echo "#F89406;";}      echo ";display: inline-block;
padding: 2px 4px;
font-size: 11.844px;
font-weight: bold;
line-height: 14px;
color: white;
white-space: nowrap;
vertical-align: baseline;
border-radius:4px;
'>{$course['status']}</label>

<br/>

<div class='coursebelowicons'>
<img src='../media/c-registered.png ' style=' margin-left:16px; float:left;'><label style='float:left; margin-left:7px; '>{$course['registerd']}</label>
<img src='../media/c-hits.png' style=' margin-left:16px; float:left;'><label style='float:left; margin-left:7px;'>{$course['hits']}</label>
<img src='../media/c-sessions.png' style=' margin-left:16px; float:left;'><label style='float:left; margin-left:7px;'>"; $this->gettotalsessions($courseid);echo "</label>

</div>
</div>";	
	
}
	
	
	
	
	
	
}


function showaddnewcourse(){
	$userid=$_SESSION['userid'];
	$sql="SELECT * FROM courses WHERE userid='$userid' ";
	$result=mysql_query($sql);
	
	if(!mysql_fetch_array($result)){
		
		echo " <div class='nocourses'>
  
 <P> You have not added any courses yet.</P>
  <a class='mt10 btn btn-primary btn-large'href='newcourse.php'><i  style='background-image: url('../media/glyphicons-halflings-white.png');background-position: -408px -96px;'class='icon-plus icon-white'></i> Click here to add a new course</a>
  </div>
</div>";

	}
	
}

function gettotalsessions($courseid){
				
	$sql="SELECT COUNT(*) as 'numberofsessions'
FROM session WHERE courseid='$courseid'";
$result=mysql_query($sql);
$totalsession=mysql_fetch_array($result);
echo $totalsession['numberofsessions'];

	}
	
function getpersonalaccountname($userid){

	$sql="SELECT * FROM personalaccount WHERE id='$userid'";
	$result=mysql_query($sql);
	$row=mysql_fetch_array($result);
	global $personalaccountname;
	$personalaccountname=$row['firstname']."\t \t".$row['lastname'];
	echo mysql_error();
}

function getprofilepictures($username){
	
	$sql="SELECT pictureurl from personalaccount where username='$username'";
	$result=mysql_query($sql);
	$row=mysql_fetch_array($result);
	
	$pictureurl=$row['pictureurl'];
	
	if($pictureurl!==""){
		
	echo "<img src='{$pictureurl}'   title='$username'>";
	}
	else{
		echo "<img src='../media/none.120x120.png' title='$username' >";
		
	}
	
	
	
	
}

function getcoursename($courseid){
	
	$sql="SELECT coursename_en from courses WHERE courseid='$courseid'";
	$result=mysql_query($sql);
	
	$row=mysql_fetch_array($result);
global $coursename;
	$coursename= $row['coursename_en'];
	
}



function registerdinsession($courseid,$sessionid){
	
	
	$sql="SELECT * FROM appliedcourses WHERE courseid='$courseid' AND sessionid='$sessionid'";
	if(!$result=mysql_query($sql)){
		
		
		
		echo mysql_error();
		exit;
	}
	
		
	while($reg=mysql_fetch_array($result)){
		
	$userid=$reg['userid'];
	getuserinfo($userid);
	$courseid=$reg['courseid'];
	$status=$reg['status'];	
	$paykey=$reg['paykey'];
	$applyid=$reg['applyid'];
	global $profilepicture;
	
	echo "<div class='regsteratedusercontainer' style='width:90%;  margin-top:10px; height:50px;  padding:5px; border-bottom: 1px solid #EEE;'>
<div class='contentsideofreg' style='width:70%; overflow:hidden; float:left;'>

 <div class='userimageregistration' style='width:40px; float:left; height:40px; '>
 
 <img src='{$profilepicture}' width='40' height='40' />
 
 </div>
 <label style='float:left; padding-left:10px; font-size:1.17em; color: #08C;  clear:right; overflow:hidden;'><a  style='color: #08C;' href='registrateduser.php?applyid={$reg['applyid']}'>{$reg['applicantfullname']}</a></label><label style='float:left; margin-top:2px; margin-left:9px; background-color:";  if($status!=="complete"){echo "#F89406;";}else{echo "#468847;";} echo"display: inline-block;
padding: 2px 4px;
font-size: 11.844px;
font-weight: bold;
line-height: 14px;
color: white;
white-space: nowrap;
vertical-align: baseline;
border-radius:4px;overflow:hidden;display:";echo "
'>{$status}</label><br/> <blockquote></blockquote>
<small style='margin-left:10px;overflow:hidden;'>Course Name:<a style='padding-left:5px;' href='../course/index.php?id={$reg['courseid']}'>{$reg['coursename']}</a></small>
 </div>
 <div class='o-course-commands btn-group right float-right' style='margin-top:12px;'>
		<a class='btn btn-small' style=' display:"; if($status=="complete"){echo "none";}  echo "' href='confirmpayment.php?applyid={$applyid} & paykey={$paykey} '><i class='icon-share' style='background:url(../media/glyphicons-halflings.png); background-position: -288px 0; margin-right:5px;'></i>Confirm</a><a class='btn btn-small' href='registrateduser.php?applyid={$reg['applyid']}'><i class='icon-edit'style=' background:url(../media/glyphicons-halflings.png); background-position: -120px -72px; margin-right:5px; '></i>View</a>
	</div>
 </div>";	
		
	}
		
		
		
		
		
		
		

		
		
		
		
	
	
	
	
	
	
	
}
}

$fun=new functions();

global $fun;




















?>
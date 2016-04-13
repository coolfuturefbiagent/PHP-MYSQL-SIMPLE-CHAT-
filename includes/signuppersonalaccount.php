<?php

require_once("../config.php");
@session_start();
global $db;
class signup{
	
	private $firstname;
	private $lastname;
	private $email;
	private $username;
	private $password;
	private $verification_id;


function __construct(){

	$this->firstname=$_POST['firstname'];
	$this->lastname=$_POST['lastname'];
	$this->email=$_POST['email'];
	$this->username=$_POST['username'];
	$this->password=md5($_POST['password']);
	$this->insertdata();
	}
	
	function insertdata(){
	$this->verification_id=$_POST['username'].rand();
		$sql="INSERT INTO personalaccount (firstname,lastname,email,username,password,associatedwithorganizer,verified,status,verification_id)";
		$sql.="VALUES('$this->firstname','$this->lastname','$this->email','$this->username','$this->password',0,0,'online','$this->verification_id')";
		global $db;
		$result=mysql_query($sql);
	
		if($result){
			$last_id=mysql_insert_id();
		$this->send_verification_url();
				$hos=$_SERVER['HTTP_HOST'];




		
	
		}
		else{
	header("LOCATION:../signup.php?s=not");
	exit;
		}
			
	
		
	}
	
	
	
	
	
	
	
	
	function send_verification_url(){
		$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$verify_url="http://".$_SERVER['HTTP_HOST']."/verify.php?verification_id={$this->verification_id}";
		if(mail($this->email,"Dawrat Please Verify Your Account ","
		
		
		<h3>Hello {$this->firstname} \t {$this->lastname}</h3>
		
		<br/>
		<br/>
		
		To Complete Registration Please Click Below Link
		<br/>
		
		<a href='{$verify_url}'>{$verify_url}</a>
		
		",$headers)){			
			header("LOCATION:../signup.php?s=completed&&mailsent=1");
			exit;	
		}else{
			header("LOCATION:../signup.php?s=completed&&mailsent=0");
			exit;	
			
		}
		
		
		
		
		
	
		
		
		
		
		
		
	}
	
}


$signup=new signup();
?>
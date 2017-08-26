<?php
ob_start();
session_start();
include('connection.php');
$fn1=strip_tags($_POST['first_name']);
$fn=mysqli_real_escape_string($connection,$fn1);
$newfn=substr($fn,0,1);
$selectfn=strtoupper($newfn);
$leftfn=substr($fn,1,200);
$firstname=$selectfn.$leftfn;
$ln1=strip_tags($_POST['last_name']);
$ln=mysqli_real_escape_string($connection,$ln1);
$newln=substr($ln,0,1);
$selectln=strtoupper($newln);
$leftln=substr($ln,1,200);
$lastname=$selectln.$leftln;
$email1=strip_tags($_POST['email']);
$email=mysqli_real_escape_string($connection,$email1);
$pass1=strip_tags($_POST['password']);
$pass=mysqli_real_escape_string($connection,md5($pass1));
$fullname=$firstname.' '.$lastname;
$query="select email from register where email='$email'";
$result=mysqli_query($connection,$query);
$row=mysqli_fetch_array($result);
if($row>0)
{echo "sorry but already register";}
else {
$query="insert into register (id,firstname,lastname,email,password,fullname) values ('','$firstname','$lastname','$email','$pass','$fullname')";
$result=mysqli_query($connection,$query);
$selectquery="select id from register where email='$email'";
$queryresult=mysqli_query($connection,$selectquery);
$queryrow=mysqli_fetch_array($queryresult);
$_SESSION['id']=$queryrow;
header('location: fillmobile.php');}
?>
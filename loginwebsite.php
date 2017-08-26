<?php
ob_start();
session_start();
include('connection.php');
if(isset($_POST['email1']))
{$email1=$_POST['email1'];
	$email=mysqli_real_escape_string($connection,$email1);}
if(isset($_POST['password1']))
{	$password1=$_POST['password1'];
	$password=mysqli_real_escape_string($connection,md5($password1));}
if(!empty($email) && !empty($password))
{$query="select id,category,following from register where email='$email' and password='$password'";
$result=mysqli_query($connection,$query);
$row=mysqli_fetch_array($result); 
if($row>0)
{$_SESSION['id']=$row['id'];
$login=$row['id'];
$category=$row['category'];
$following=$row['following'];
setcookie('id',$login,time()+86000);
if($following=="")
{
	if($category=="")
	{
		header('location: home.php?category=motivation&&page=1');
	}
	else
	{
		header('location: home.php?category='.$category.'&&page=1');
	}
}
else
{
	header('location: home.php?page=1');
}
}
else {header('location: loginerror.php');}}
else {header('location:loginerror.php');}
?>
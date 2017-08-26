<?php
ob_start();
session_start();
include('connection.php');
if(isset($_POST['email1']))
{$email=mysqli_real_escape_string($connection,htmlentities($_POST['email1']));}
if(isset($_POST['password1']))
{$password=mysqli_real_escape_string($connection,htmlentities($_POST['password1']));}
if(!empty($email) && !empty($password))
{$query="select id from register where email='$email' and password='$password'";
$result=mysqli_query($connection,$query);
$row=mysqli_fetch_array($result); 
if($row>0)
{$_SESSION['id']=$row;
foreach($row as $ask)
{header ('location: profile.php?id='.$ask.'');}}
else {echo "sorry but the email-id or password is wrong";}}
else {echo "please enter your email-id or password or there";}
?>
<html>
<head>
<style>
body{padding:0px; margin:0px}
#nav{background:#8000ff; color:white; width:100%; position:fixed;top:0;font-family:arial;font-size:16px;height:120}
#nav-wrapper{width:960px;margin:10 auto;text-align:right}
#register{background:#f6f7fa; color:#4d4d4c;font-family:arial;font-size:15px;height:250px;width:500px;border-radius:8px 8px 8px 8px;margin-top:170px;}
#register1{background:#f0f0f0;color:black;border-radius:8px 8px 8px 8px}
#search{height:30px;width:250px;border-radius:3px 3px 3px 3px}
#options {height:30px;width:270px;border-radius:3px 3px 3px 3px}
button{background:#619f4e;color:white;font-family:arial;border:1px solid #3974c6;font-size:17px;border-radius:2px 2px 2px 2px}
#button{background:#619f4e;color:white;font-family:arial;border:1px solid #3974c6;font-size:17px;border-radius:2px 2px 2px 2px}
#skip{font-family:arial;border:1px solid #3974c6;font-size:17px;border-radius:2px 2px 2px 2px}
#citysearch{color:red}
#current{height:30px;width:250px;border-radius:3px 3px 3px 3px}
#currentcity{color:red}
.element{border-radius:4px 4px 4px 4px;height:30px;font-size:17px;width:250px}
.element:focus{border-color:#8000ff;height:35px;width:300px}
#red{color:red}
#box{width:200px;height:200px}
#space{color:#043abe}
</style>
</head>
<body>
<div id="nav"></div><br><br>
<center><div id="register"><br>
<div id="space"><h4> Enter the email address and password through <br>which you have previously registered</h4></div>
<form action="loginform.php" method="post">
<input type="text" placeholder="Enter Email Id" class="element" name="email1"><br><br>
<input type="password" placeholder="Enter Password" class="element" name="password1"><br><br>
<input type="submit" value="submit" name="submit" id="button">
</form>
</div></center>
</body>
</html>
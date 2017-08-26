<?php
ob_start();
session_start();
include('connection.php');
if(isset($_POST['email1']))
{$email=mysqli_real_escape_string($connection,htmlentities($_POST['email1']));}
if(isset($_POST['password1']))
{
	$pass1=strip_tags($_POST['password1']);
	$pass2=md5($pass1);
	$password=mysqli_real_escape_string($connection,$pass2);}
if(!empty($email) && !empty($password))
{$query="select id from register where email='$email' && password='$password'";
$result=mysqli_query($connection,$query);
$row=mysqli_fetch_array($result);
if($row>0)
{$loginid=$row['id'];
setcookie('id',$loginid,time()+86000);
header ('location: profile.php?id='.$loginid.'&&page=1');
}
}
?>
<html>
<head>
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Login error</title>
<style>
body{padding:0px; margin:0px;background:#dbdee6}
#nav{background:#003f3c; color:white; width:100%; position:fixed;top:0;font-family:arial;font-size:16px;height:50px;text-align:center;line-height:50px}
#nav-wrapper{width:960px;margin:10 auto;text-align:right}
#heading{background:#003f3c;height:auto;width:100%;color:white}
#register{background:#f6f7fa; color:#4d4d4c;font-family:arial;font-size:15px;height:300px;width:500px;margin-top:100px;width:100%}
#register1{background:#f0f0f0;color:black;}
#search{height:30px;width:250px;border-radius:3px 3px 3px 3px}
#options {height:30px;width:270px;border-radius:3px 3px 3px 3px}
button{background:#619f4e;color:white;font-family:arial;border:1px solid #3974c6;font-size:17px;border-radius:2px 2px 2px 2px}
#button{background:#619f4e;color:white;font-family:arial;border:1px solid #3974c6;font-size:17px;border-radius:2px 2px 2px 2px}
#skip{font-family:arial;border:1px solid #3974c6;font-size:17px;border-radius:2px 2px 2px 2px}
#citysearch{color:red}
#current{height:30px;width:250px;border-radius:3px 3px 3px 3px}
#currentcity{color:red}
.element{border-radius:4px 4px 4px 4px;height:30px;font-size:17px;width:250px}
#red{color:red}
#box{width:200px;height:200px}
#space{color:red;font-size:15px;}
</style>
</head>
<body>
<center><div id="register">
<div id="heading">
<h3>Login</h3>
</div>
<br>
<div id="space"><b> Sorry but the Email id or<br>Password doesn't match</b></div><br>
<form action="loginerror.php" method="post">
<input type="text" placeholder="Enter Email Id" class="element" name="email1"><br><br>
<input type="password" placeholder="Enter Password" class="element" name="password1"><br><br>
<input type="submit" value="submit" name="submit" id="button"><br><br>
<a href="forgetpassword.php">Forgot password</a>
</form>
</div>
</center>
</body>
</html>
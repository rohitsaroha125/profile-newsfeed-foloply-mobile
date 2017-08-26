<?php
$timenow=time();
$datenow=date("Y-m-d");
ob_start();
session_start();
include('connection.php');
if(isset($_COOKIE['id']) && !empty($_COOKIE['id']))
{
	$msg=$_COOKIE['id'];
		$selectsql=mysqli_query($connection,"select * from online where userid='$msg'");
		$resultsql=mysqli_fetch_array($selectsql);
		$mysessionstart=$resultsql['sessionstart'];
		$countsql=mysqli_num_rows($selectsql);
		if($countsql==0)
		{
			$insertquery=mysqli_query($connection,"insert into online values('','$msg','$timenow','0')") or die(mysqli_error($connection));
		}
		else
		{
			$updatequery=mysqli_query($connection,"update online set sessionstart='$timenow' where userid='$msg'") or die(mysqli_error($connection));
		}
		$query="select * from register where id='$msg'";
		$result=mysqli_query($connection,$query);
		$row=mysqli_fetch_array($result);
		$email=$row['email'];
		$fn=$row['firstname'];
		$ln=$row['lastname'];
		$accounttype=$row['accounttype'];
		$following=$row['following'];
		$followingexplode=explode(",",$following);
		$countfollowing=count($followingexplode);
		$followers=$row['followers'];
		$followerexplode=explode(",",$followers);
		$profilepicdb=$row['profilepic'];
}
else {header('location: formobile.php');}
?>
<?php
$pagenum=mysqli_real_escape_string($connection,$_GET['page']);
if($pagenum=="" && $pagenum=="1")
{
	$page1=0;
}
else
{
	$page1=($pagenum*10)-10;
}
?>
<?php
$onlinequery=mysqli_query($connection,"select * from noteonline where userfrom='$msg'") or die(mysqli_error($connection));
$onlineresult=mysqli_fetch_array($onlinequery);
$onlineuserto=$onlineresult['userto'];
?>
<html>
<head>
<title>Home</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-86885838-1', 'auto');
  ga('send', 'pageview');

</script>
<style>
body{padding:0px; margin:0px;background:#dbdee6;font-family:arial}
#nav{background:#003f3c; color:white; width:100%; position:fixed;top:0;font-family:arial;font-size:16px;height:70;z-index:9999;margin:0px;padding:0px;}
#nav a{text-decoration:none;color:white;font-size:20px}
	a{text-decoration:none}
#register{background:#f6f7fa; color:#4d4d4c;font-family:arial;font-size:15px;height:750px;width:500px;border-radius:8px 8px 8px 8px;margin-top:170px}
#a5012687_ds{background:#f0f0f0;color:black;border-radius:8px 8px 8px 8px}
#search{height:30px;width:250px;border-radius:3px 3px 3px 3px}
#options {height:30px;width:270px;border-radius:3px 3px 3px 3px}
#button{background:#1f8e23;color:white;font-family:arial;border:1px solid #3974c6;font-size:17px;border-radius:2px 2px 2px 2px}
#button1{background:#e10000;color:white;font-family:arial;border:1px solid #3974c6;font-size:17px;border-radius:2px 2px 2px 2px}
.button{background:#1f8e23;color:white;font-family:arial;border:1px solid #3974c6;font-size:17px;border-radius:2px 2px 2px 2px}
#skip{font-family:arial;border:1px solid #3974c6;font-size:17px;border-radius:2px 2px 2px 2px}
.skip{font-family:arial;border:1px solid #3974c6;font-size:17px;border-radius:2px 2px 2px 2px}
#citysearch{color:red}
#current{height:30px;width:250px;border-radius:3px 3px 3px 3px}
#currentcity{color:red}
.element{border-radius:4px 4px 4px 4px;height:30px;font-size:17px;width:250px}
.element:focus{border-color:#8000ff;height:35px;width:300px}
#red{color:red}
	a{text-decoration:none}
#followersbox{height:50px;width:150px;background:white;text-align:center;color:#2ca0eb;border:1px solid #a4bed9}
#followingbox{width:52%;margin-left:auto;margin-right:auto;margin-top:50px;background:white;height:auto}
	#heading{width:100%;background:#003f3c;color:white;text-align:center}
#imagebox{height:50px;width:150px;background:white;text-align:center;color:#2ca0eb;margin-left:300px;margin-top:-52px;border:1px solid #a4bed9}
#left{margin-left:5px}
#box{width:200px;height:200px;color:black;}
#new{height:430px;width:100%;background:white;margin-top:0;margin-left:0px;font-family:arial}
#profilebox{height:auto;width:500px;background:#f0f0f0;margin-top:20px;margin-left:5%;font-family:arial;position:absolute}
#storybox{width:704px;background:white;margin-top:50px;margin-left:auto;margin-right:auto;font-family:arial;height:auto;}
#skip{font-family:arial;border:1px solid #3974c6;font-size:17px;border-radius:2px 2px 2px 2px}
#space{color:#043abe}
#suggestions{background:#1f8e23;color:white;font-family:arial;border:1px solid #3974c6;font-size:17px;border-radius:2px 2px 2px 2px}
#box1{background:white;width:452px;margin-left:25px;border: 1px solid #e5e5e5;padding:3px}
#right{background:#f6f7f8;height:30px;width:700px;border:1px solid #e5e5e5}
#seeposts{background:white;width:100%;margin-left:0px}
#space1{color:#043abe;margin-top:-50px;margin-left:50px}
#postbody{margin-left:0px;margin-top:5%}
#grey{color:grey;font-size:15px;margin-left:50px;margin-top:-20px}
#forname{font-size:10px;color:blue;}
#left10{margin-left:-10px}
#left11{margin-left:50px}
#left12{margin-left:50px;margin-top:170px}
#myinfo{margin-top:-400px;width:600px;margin-left:600px;background:white;height:400px}
#farleft{margin-left:0px;width:500px}
#myleft{margin-left:0px;margin-top:-10px}
#myleft1{margin-left:0px;margin-top:-10px}
#postmyinfo{margin-top:-240px;margin-left:400px}
#side{margin-left:0px;width:300px;margin-top:-15px;font-size:20px}
#newspacex{background:white;height:100px;width:300px}
#justup{margin-top:-215px;margin-left:150px;}
#suggestion{height:350px;margin-top:-230px;margin-left:450px;width:400px;background:white;border:1px solid #e5e5e5}
#inside{height:50px;width:400px;font-family:arial}
#word{margin-top:-20px;margin-left:40px}
#changeme{display:none}
#lineup{margin-left:270px;margin-top:-32px}
.submitbutton{margin-top:-20px}
#labelme{cursor:hand}
.overlay{height:100%;width:100%;top:0px;left:0px;display:none;background:#000;position:fixed}
.specialbox{height:700px;width:700px;position:absolute;margin-left:-150px;margin-top:-100px;display:none;}
#round{height:80px;width:80px;border-radius:80px}
#previewimage{width:324px;height:122px;margin-top:-127px;margin-left:370px;border:2px solid #f0f0f0}
#output{height:200px;width:100px;margin-top:0px;margin-left:0px}
#styleimage{height:100px;width:auto}
#thisbutton{margin-left:630px;background:#1f8e23;color:white;font-family:arial;border:1px solid #3974c6;font-size:17px;border-radius:2px 2px 2px 2px}
#positionbutton{margin-top:7px;margin-left:60%;}
.commentlink{margin-left:-60%}
.submitcomment{background:#1f8e23;color:white;font-family:arial;border:1px solid #3974c6;font-size:17px;border-radius:2px 2px 2px 2px}
.commentbox{width:60%;height:25px;border-radius:4px;margin-left:10px}
#newbutton{float:right;margin-top:-15px}
#newbutton1{float:right;margin-top:-15px}
#iconbox{border:1px solid #c5c5c5;height:32px}
.newdislike{background:#f0f0f0;width:90px;margin-left:180px;margin-top:0;height:32px;position:absolute;text-align:center}
.newlike{background:#f0f0f0;width:90px;height:32px;position:absolute;text-align:center}
.likeresult{background:#f0f0f0;height:32px;width:90px;margin-top:0;margin-left:89px;text-align:center;font-size:13px;line-height:35px;position:absolute}
.dislikeresult{background:#f0f0f0;height:32px;width:90px;margin-top:0;margin-left:269px;text-align:center;font-size:13px;line-height:35px;position:absolute}
.seecomment{background:#f0f0f0;height:32px;width:200px;margin-top:0;margin-left:360px;text-align:center;line-height:35px;position:absolute}
.star{height:32px;width:145px;margin-top:0;margin-left:559px;position:absolute;background:#f0f0f0;text-align:center}
.thiscomment{background:#f6f7f8}
.mylist{margin-left:-65px;background:#f0f0f0;border:4px groove #a4bed9;width:100px;font-size:15px;color:#064469;position:absolute}
.countcomments{margin-top:-30px;margin-left:90px;font-size:13px}
#newred{width:30px;height:auto;text-align:center;margin-top:-45px;margin-left:15px;background:#e10000;border-radius:2px;position:absolute;z-index:9999}
#listnotes{position:absolute;width:400px;height:auto;color:black;border:1px solid #a4bed9;background:#ffffff;margin-top:21px;display:none;}
#newrequest{width:30px;height:auto;text-align:center;margin-top:-45px;margin-left:15px;background:#e10000;border-radius:2px;position:absolute;z-index:9999}
#listrequest{position:absolute;width:400px;height:auto;color:black;border:1px solid #a4bed9;background:#ffffff;margin-top:21px;display:none;}
#newmessage{width:30px;height:auto;text-align:center;margin-top:-45px;margin-left:15px;background:#e10000;border-radius:2px;position:absolute;z-index:9999}
#listmessage{position:absolute;width:400px;height:auto;color:black;border:1px solid #a4bed9;background:#ffffff;margin-top:21px;display:none;}
#newmeme{width:30px;height:auto;text-align:center;margin-top:-45px;margin-left:15px;background:#e10000;border-radius:2px;position:absolute;z-index:9999}
	#results{background:#f5f5fa;position:absolute;z-index:9999;width:400px;height:auto;margin-top:-34px;margin-left:930px}
		#results{background:#f5f5fa;position:absolute;z-index:9999;width:400px;height:auto;margin-top:-30px;margin-left:55%}
	#searchbar{border-radius:4px 4px 0px 0px;margin-left:55%;height:25px;width:400px;margin-top:-35px;position:absolute}
	#searchicon{position:absolute;margin-left:55%;margin-top:-33px;}
	#imageurl{height:auto;width:50%;cursor:pointer;}
	#formobile{display:none}
	#menuitemlist{background:#ffffff;display:none;color:black;border:1px solid #f0f0f0;z-index:9999;}
	#pcmenuitemlist{background:#f0f3f7;display:none;color:black;border:1px solid #f0f0f0;width:150px;position:absolute;margin-left:90%;margin-top:50px}
	#profile{width:30px;height:50px;position:absolute;}
	#home{width:20%;height:auto;margin-left:5%;position:absolute}
	#menuitems{width:20%;height:auto;margin-left:5%;position:absolute;display:none}
		#request{margin-left:10%;position:absolute}
	#message{margin-left:15%;position:absolute}
	#note{margin-left:20%;position:absolute}
		#meme{width:20%;height:auto;margin-left:25%;position:absolute}
		#pcmenu{width:20%;height:auto;margin-left:95%;position:absolute;margin-top:}
	#request1{display:none}
	#message1{display:none}
	#note1{display:none}
	#mysearch{display:none}
	#phonecomment{display:none}
	#phonecount{display:none}
	.createpost{display:none}
	#fornext{background:white;border:1px solid #a7a7a7;border-radius:4px;margin-right:auto;margin-left:auto;color:white;width:90%;height:30px;line-height:30px;text-align:center}	
	#searchimage{;margin-left:1304px;margin-top:-50px;border:1px solid black;}
	#putthem{width:300px;margin-left:auto;margin-right:auto}
	#followercount{margin-left:0px;margin-top:100px;}
	#followingcount{text-align:center;margin-top:-40px}
	#photoscount{text-align:right;margin-top:-40px}
	#imagechange{position:absolute;background:white;left:0;right:0;top:0;bottom:0;color:black;height:100px;width:30%;margin:auto;border-radius:5px;}
	#myblocklist{margin-left:48%;background:#f0f0f0;border:4px groove #a4bed9;width:100px;font-size:15px;color:#064469;position:absolute;margin-top:10px}
	#blockimage{height:30px;width:auto;margin-left:45%;position:absolute}
	#overlaybody{height:100%;width:100%;top:0px;left:0px;display:none;background:#000;position:fixed;}
	#myimageblock{border:1px solid #a4bed9;height:31%;lin-height:100%}
	#myitem{width:100%;font-size:13px}
	#roll{overflow:hidden;height:25px;width:auto;position:absolute}
	#roll ul{margin:0px;padding:0px;top:-5px;display:block;}
	#roll li{height:25px;list-style:none;float:left;margin-left:5px;background:#cfdcea;text-align:center;border-radius:4px;line-height:25px;}
@media screen and (max-width:720px){
	#backdiv{background:#f0f0f0;margin-left:0%;margin-top:-2.5px;z-index:999;height:30px;width:30px;position:absolute}
	#backbutton{margin-top:5px;margin-left:5px}
	#nextbutton{margin-top:5px;margin-left:5px}
	#nextdiv{background:#f0f0f0;right:0;margin-top:-2.5px;z-index:999;height:30px;width:30px;position:absolute}
	#profilebox{margin-top:0px;margin-left:0px;width:100%;height:auto;padding:0px;margin:0px}
	#box1{width:98%;margin-left:0px;margin-top:0px}
	#followersbox{width:33%;margin-left:0px}
		#followingbox{width:100%;margin-left:0}
	#imagebox{width:33%;margin-left:66%}
	#storybox{margin-left:0px;margin-top:50px;width:100%}
	#mytextarea{margin-left:0px;width:50%}
	#previewimage{margin-left:49%;width:51%;display:none}
	#right{width:100%;margin-left:0px}
	#output{height:100px;width:auto}
	#thisbutton{margin-left:75%}
	#seeposts{width:99.8%;margin-left:0px}
	#newbutton{float:right;margin-top:-15px}
	#newbutton1{float:right;margin-top:-15px}
	.newlike{margin-left:0px;width:12.76%;}
	.likeresult{margin-left:12.76%;width:13%;font-size:12px}
	.newdislike{margin-left:25.52%;width:13%}
	.dislikeresult{margin-left:38.28%;width:13%;font-size:12px}
	.seecomment{margin-left:51.04%;width:28.5%;}
	.star{margin-left:79.42%;width:20.58%}
	.countcomments{margin-left:70%;}
	#imageurl{height:auto;width:100%;}
	#home{width:auto;height:20px;margin-left:0%;position:absolute}
	#message1{display:block;width:auto;height:20px;margin-left:16.67%;position:absolute}
	#note1{display:block;width:auto;height:20px;margin-left:33.34%;position:absolute}
	#mysearch{display:block;width:auto;height:20px;margin-left:50.1%;position:absolute}
		#profile{width:auto;height:20px;position:absolute;display:block;margin-left:66.67%;}
	#menuitems{width:auto;height:40px;margin-left:83.44%;position:absolute;display:block}
	#request{display:none}
	#pcmenu{display:none}
	#message{display:none}
	#note{display:none}
	#newred1{width:25px;height:auto;text-align:center;margin-top:-42px;background:#e10000;border-radius:2px;margin-left:15px;z-index:9999;position:absolute}
#listnotes{width:100%;height:auto;color:black;border:1px solid #a4bed9;background:#f6f7f8;margin-left:0%;margin-top:30px;display:none;overflow:scroll}
#newrequest1{width:25px;height:auto;text-align:center;margin-top:-42px;background:#e10000;border-radius:2px;margin-left:15px;z-index:9999;position:absolute}
#listrequest{width:100%;height:auto;color:black;border:1px solid #a4bed9;background:#f6f7f8;margin-left:0%;margin-top:30px;display:none;overflow:scroll}
#newmessage1{width:25px;height:auto;text-align:center;margin-top:-42px;background:#e10000;border-radius:2px;margin-left:15px;z-index:9999;position:absolute}
#listmessage{width:100%;height:auto;color:black;border:1px solid #a4bed9;background:#f6f7f8;margin-left:0%;margin-top:30px;display:none;overflow:scroll}
#newmeme{width:25px;height:auto;text-align:center;margin-top:-42px;background:#e10000;border-radius:2px;margin-left:15px;z-index:9999;position:absolute}
#mytextarea{width:80%;height:30px}
#formobile{display:block}
#forpc{display:none}
#searchicon{display:none}
#phonecomment{display:block;color:black}
#pccomment{display:none}
#fornext{background:white;border:1px solid #a7a7a7;border-radius:4px;margin-right:auto;margin-left:auto;color:black;width:90%;height:30px;line-height:30px;text-align:center}	
#pccount{display:none}
#phonecount{display:block}
#putthem{width:100%;margin-left:0px}
.pcpost{display:none}
#imagechange{width:100%}
#searchbar{display:none}
.createpost{display:block;margin-right:auto;margin-left:auto;width:100%;marginn-top:5px}
#myblocklist{margin-left:40%}
#blockimage{margin-left:35%}
#myitem{width:100%;font-size:15px}
}
</style>
<script>
function getminus()
{
	$.post("getminus.php",{msg:'<?php echo $msg; ?>',getid:'<?php echo $onlineuserto; ?>'},function(data)
		{
			if(data<90)
			{
				$.post("seeonline.php",{msg:'<?php echo $msg; ?>',getid:'<?php echo $onlineuserto; ?>',type:"online"})
			}
			else
			{
				$.post("deleteonline.php",{msg:'<?php echo $msg; ?>',getid:'<?php echo $onlineuserto; ?>',type:"online"})
			}
		})
}
function mytime()
{
	var d=new Date();
	var n=d.getTime();
	n=n/1000;
	var time=Math.ceil(n);
	$.post("addtime.php",{time: time,userid:<?php echo $msg; ?>});
}
window.addEventListener("mousemove",mytime);
window.addEventListener("mousemove",getminus);
</script>
</head>
<body>
<div id="nav"><br>
<a href="home.php?page=1" title="home" id="home"><img src="clipart/readingbook1.png" style="height:30px;width:auto"></a>
<a id="message1" href="messages.php"><img src="clipart/envelope1.png" style="height:30px;width:auto" ><div id="newmessage1"></div></a>
<a id="note1" href="mynote.php"><img src="clipart/globe1.png" style="height:30px;width:auto" ><div id="newred1"></div></a>
<a id="mysearch" href="mysearch.php"><img src="clipart/search2.png" style="height:30px;width:auto"></a>
<a href="profile.php?id=<?php echo $msg; ?>&&page=1" title="profile" id="profile"><img src="clipart/profile.png" style="height:30px;width:auto"></a>
<a id="menuitems" onclick="togglelist()"><img src="clipart/menu1.png" style="height:30px;width:auto"></a>
<br><br><div id="menuitemlist">
<?php
echo '<div style="text-align:center;background:#003f3c;color:white;z-index:9999"><br><img src="'.$profilepicdb.'" style="width:50px;height:50px;border-radius:40px;text-align:center">
<br><b>'.$fn.' '.$ln.'</b><br></div><div style="background:#a4bed9;height:1px;width:100%"></div><br>
<div style="float:left;border:1px solid #f0f0f0;width:90px;border-radius:5px;text-align:center;font-size:10px">
<a href="profile.php?id='.$msg.'&&page=1" style="color:black;">Profile</a><br></div>
<center><div style="border:1px solid #f0f0f0;width:90px;border-radius:5px;text-align:center;font-size:10px">
<a href="features.php" style="color:black;">Features</a>
</div></center>
<div style="float:right;border:1px solid #f0f0f0;width:90px;border-radius:5px;text-align:center;font-size:10px;margin-top:-25px">
<a href="logout.php" style="color:black;">Logout</a>
</div>
<br><br>
<div id="line1" style="background:#a4bed9;height:1px;width:100%"></div><br>
<a href="settings.php"><div id="myitem">
<font color="black">Settings</font>
</div></a>
<br>
<div id="line1" style="background:#a4bed9;height:1px;width:100%"></div><br>
<a href="aboutus.php"><div id="myitem">
<font color="black">About Us</font>
</div></a>
<br>
<div id="line1" style="background:#a4bed9;height:1px;width:100%"></div><br>
<a href="feedback.php"><div id="myitem">
<font color="black">Feedback</font>
</div></a><br>
<div id="line1" style="background:#a4bed9;height:1px;width:100%"></div>' 
?>
</div>
<script src="jquery.js"></script>
<script>
function togglelist()
{
	var menulist=document.getElementById("menuitemlist");
	var tellmenotes=menulist.style.display;
	if(tellmenotes=="block")
	{
		menulist.style.display="none";
	}
	else
	{
		menulist.style.display="block";
	}
}
</script>
<?php
	echo '<script src="jquery.js"></script>
	<script>
$("document").ready(function()
{
	$.post("countnotification1.php",{newid: "'.$msg.'"},function(data)
		{
			$("#newred1").html(data);
		})
});
$("document").ready(function()
{
	$.post("countmeme.php",{userid: "'.$msg.'"},function(data)
		{
			$("#newmeme").html(data);
		})
});
$("document").ready(function()
{
	$.post("countmessage.php",{userid:"'.$msg.'"},function(data)
		{
			$("#newmessage1").html(data);
		})
})
</script>';
?>
</div>
<br><br>
<div id="storybox">
<?php
echo '
<form action="createpost.php">
<input type="submit" value="Create your post" id="button" class="createpost">
</form>';
?>
<center>
<div id="rollopera" style="display:none">
<select name="selectcategory" style="height:25px" id="selectcategory">
<option value="0">Select category</option>
<option value="art">Art</option>
<option value="animals">Animals</option>
<option value="business">Business</option>
<option value="entertainment">Entertainment</option>
<option value="fashion">Fashion</option>
<option value="food">Food</option>
<option value="funny">Funny</option>
<option value="gaming">Gaming</option>
<option value="healthandfitness">health,fitness</option>
<option value="memes">Memes</option>
<option value="motivation">Motivation</option>
<option value="photography">Photography</option>
<option value="relationships">Relationships</option>
<option value="science">Science</option>
<option value="selfie">Selfie</option>
<option value="society">Society</option>
<option value="sports">Sports</option>
<option value="technology">Technology</option>
<option value="traveling">Traveling</option>
</select>
<input type="submit" class="submitroll" id="button" name="submitroll" onclick="rollforopera();">
<div id="operaerror"></div>
</div>
<script>
function rollforopera()
{
	var selectvalue=document.getElementById("selectcategory").value;
	if(selectvalue=="0")
	{
		document.getElementById("operaerror").innerHTML="<b>Please choose any category</b>"
	}
	else
	{
		window.location.href="home.php?category="+selectvalue+"&&page=1";
	}
}
</script>
</center>
<div id="backdiv" style="display:none"><img src="clipart/backimage.png" id="backbutton" style="width:20px;height:20px"></div>
<div id="roll" style="display: block">
<ul id="categorylist">
<li style="width:40px"><b><a href="home.php?category=art&&page=1" style="color:black;text-decoration:none">Art</a></b></li>
<li style="width:80px"><b><a href="home.php?category=animals&&page=1" style="color:black;text-decoration:none">Animals</a></b></li>
<li style="width:80px"><b><a href="home.php?category=business&&page=1" style="color:black;text-decoration:none">Business</a></b></li>
<li style="width:120px"><b><a href="home.php?category=entertainment&&page=1" style="color:black;text-decoration:none">Entertainment</a></b></li>
<li style="width:80px"><b><a href="home.php?category=fashion&&page=1" style="color:black;text-decoration:none">Fashion</a></b></li>
<li style="width:50px"><b><a href="home.php?category=food&&page=1" style="color:black;text-decoration:none">Food</a></b></li>
<li style="width:60px"><b><a href="home.php?category=funny&&page=1" style="color:black;text-decoration:none">Funny</a></b></li>
<li style="width:80px"><b><a href="home.php?category=gaming&&page=1" style="color:black;text-decoration:none">Gaming</a></b></li>
<li style="width:130px"><b><a href="home.php?category=healthandfitness&&page=1" style="color:black;text-decoration:none">Health,fitness</a></b></li>
<li style="width:80px"><b><a href="home.php?category=memes&&page=1" style="color:black;text-decoration:none">Memes</a></b></li>
<li style="width:90px"><b><a href="home.php?category=motivation&&page=1" style="color:black;text-decoration:none">Motivation</a></b></li>
<li style="width:110px"><b><a href="home.php?category=photography&&page=1" style="color:black;text-decoration:none">Photography</a></b></li>
<li style="width:120px"><b><a href="home.php?category=relationships&&page=1" style="color:black;text-decoration:none">Relationships</a></b></li>
<li style="width:70px"><b><a href="home.php?category=science&&page=1" style="color:black;text-decoration:none">Science</a></b></li>
<li style="width:60px"><b><a href="home.php?category=selfie&&page=1" style="color:black;text-decoration:none">Selfie</a></b></li>
<li style="width:90px"><b><a href="home.php?category=society&&page=1" style="color:black;text-decoration:none">Society</a></b></li>
<li style="width:60px"><b><a href="home.php?category=sports&&page=1" style="color:black;text-decoration:none">Sports</a></b></li>
<li style="width:100px"><b><a href="home.php?category=technology&&page=1" style="color:black;text-decoration:none">Technology</a></b></li>
<li style="width:80px"><b><a href="home.php?category=traveling&&page=1" style="color:black;text-decoration:none">Traveling</a></b></li>
</ul>
</div>
<div id="nextdiv"><img src="clipart/next.png" id="nextbutton"></div>
<script>
$("#nextdiv").click(function()
{
	var width=$(window).innerWidth();
	var newwidth=width-100;
	var ulleft=$("#categorylist").css("margin-left");
	ulleft=ulleft.replace("px","");
	var newulleft=parseInt(ulleft,10);
	var addvalue=newulleft-newwidth;
	$("#categorylist").animate({"margin-left":"-="+newwidth},1000);
	if(addvalue<0)
	{
		$("#backdiv").css("display","block");
	}
	if(addvalue<-1300)
	{
		$("#nextdiv").css("display","none");
	}
})
$("#backdiv").click(function()
{
	var width=$(window).innerWidth();
	var newwidth=width-100;
	$("#categorylist").animate({"margin-left":"+="+newwidth},1000);
	var ulleft=$("#categorylist").css("margin-left");
	ulleft=ulleft.replace("px","");
	var newulleft=parseInt(ulleft,10);
	var addvalue=newulleft+newwidth;
	if(addvalue>=0)
	{
		$("#backdiv").css("display","none");
	}
	if(addvalue>-1300)
	{
		$("#nextdiv").css("display","block");
	}
})
</script>
<br><br><br>
<?php
if(isset($_GET['category']) && !empty($_GET['category']))
{
	$catchoice=$_GET['category'];
	$sqlquery=mysqli_query($connection,"update register set category='$catchoice' where id='$msg'") or die(mysqli_error($connection));
	echo "<center>
	<b>Your choosen category:<font color='#003f3c'>".$catchoice."</font></b>
	</center>";
}
else
{
	$catchoice="undefined";
}
$string=0;
$newsql="select * from posts where ";
foreach($followingexplode as $myid)
{
	$getid=$myid;
	$newsql.="addedbyid='$getid' OR ";
}
$newsql=substr($newsql,0,-4);
$newsql .=" || addedbyid='$msg'";
$mycountquery=mysqli_query($connection,$newsql);
$countresult=mysqli_num_rows($mycountquery);
$lastnumber=ceil($countresult/10);	
if($countresult==0 && isset($_GET['category']))
{
	$newsql1="select * from posts where (";
	foreach($followingexplode as $myid)
{
	$newsql1 .="addedbyid='$myid' OR ";
}
	$newsql1=substr($newsql1,0,-4);
	$newsql1 .=" || addedbyid='".$msg."' || accounttype='2') && category='".$catchoice."' order by id desc limit $page1,10";
}
if($countresult!=0 && isset($_GET['category']))
{
$newsql1="select * from posts where (";
	foreach($followingexplode as $myid)
{
	$newsql1 .="addedbyid='$myid' OR ";
}
$newsql1=substr($newsql1,0,-4);
	$newsql1 .=" || addedbyid='".$msg."' || accounttype='2') && category='".$catchoice."' order by id desc limit $page1,10";
}
if($countresult!=0 && $catchoice=="undefined")
{
	$newsql1 = "select * from posts where ";
foreach($followingexplode as $myid)
{
	$getid=$myid;
	$newsql1.="addedbyid='$getid' OR ";
}
$newsql1 = substr($newsql1,0,-4);
$newsql1 .= " || addedbyid='$msg' order by id desc limit $page1,10";
}
$seequeryresult=mysqli_query($connection,$newsql1);
while($findnewresult=mysqli_fetch_array($seequeryresult))
{
$mypostid=$findnewresult['id'];
$body=$findnewresult['body'];
$dateadded=$findnewresult['dateadded'];
$databasetime=$findnewresult['time'];
$addedbyid=$findnewresult['addedbyid'];
$imageurl=$findnewresult['image'];
$bodylength=strlen($body);
if($bodylength>2500)
{
	$body=substr($body,0,2500);
	$body =$body.'...';
}
echo '<div id="seeposts">';
if($body!="" && $imageurl=="")
{$imagequery="select * from register where id='$addedbyid'";
$imageresult=mysqli_query($connection,$imagequery);
$imagerow=mysqli_fetch_array($imageresult);
$showfirstname=$imagerow['firstname'];
$showlastname=$imagerow['lastname'];
$showimage=$imagerow['profilepic'];
echo '<br><br><br>
<img src="grey.jpg" data-original='.$showimage.' class="lazybodyprofile" style="height:50px;width:50px;border-radius:40px;">
<script>
$(function(){
	$("img.lazybodyprofile").lazyload({
		threshold:200
	})
});
</script>
<b><div id="space1"><a href="profile.php?id='.$addedbyid.'&&page=1" style="color:#003c39">'.$showfirstname.' '.$showlastname.'</a></div></b>';
if($msg==$addedbyid)
{echo '<div id="newbutton"><a href="delete.php?postid='.$mypostid.'"><img src="clipart/remove.png" style="height:20px;width:auto"></a>
</div>
';}
else
{
echo '<div id="newbutton1" class="newbutton'.$mypostid.'">
<script>
$("document").ready(function()
{
	$.post("getfollow.php",{userto:'.$addedbyid.',userfrom:'.$msg.',postid:'.$mypostid.',following:"'.$following.'"},function(data)
		{
			$(".newbutton'.$mypostid.'").html(data);
		})
})
</script>
</div>
';	
}
echo '
<br>
<div id="grey">';
$diff=strtotime($datenow)-strtotime($dateadded);
$newdiff=($diff/86400);
$timediff=$timenow-$databasetime;
$newminute=ceil($timediff/(60));
$newhour=ceil($timediff/(60*60));
if($timediff>0 && $timediff<60)
{
	echo "2s ago";
}
if($timediff>60 && $timediff<3600)
{
echo $newminute."m ago";
}
if($timediff>3600 && $timediff<86400)
{
echo $newhour."h ago";
}
if($timediff>86400 && $newdiff>=1 && $newdiff<=30)
{
	echo $newdiff."d ago";
}
if($newdiff>30 && $timediff>86400)
{
	$newdate=date('j F Y',strtotime($dateadded));
	echo $newdate;
}
echo '</div>
<div id="postbody"><br>&nbsp;'.$body;
if($bodylength>2500)
{echo '<br>
<a href="postnote.php?id='.$mypostid.'">See full post</a>
';}
echo "<br><br></div>";
}
if($imageurl!="" && $body=="")
{
$imagequery="select * from register where id='$addedbyid'";
$imageresult=mysqli_query($connection,$imagequery);
$imagerow=mysqli_fetch_array($imageresult);
$showfirstname=$imagerow['firstname'];
$showlastname=$imagerow['lastname'];
$showimage=$imagerow['profilepic'];
echo '<br><br><br>
<img src="grey.jpg"  data-original='.$showimage.' class="lazyimageprofile" style="height:50px;width:50px;border-radius:40px;">
<script>
$(function()
{
	$("img.lazyimageprofile").lazyload({
		threshold:200
	})
});
</script>
<b><div id="space1"><a href="profile.php?id='.$addedbyid.'&&page=1" style="color:#003c39">
'.$showfirstname.' '.$showlastname.'</a></div></b>';
if($msg==$addedbyid)
{
echo '<div id="newbutton"><a href="delete.php?postid='.$mypostid.'"><img src="clipart/remove.png" style="height:20px;width:auto"></a>
</div>
';}
else
{
echo '<div id="newbutton1" class="newbutton'.$mypostid.'">
<script>
$("document").ready(function()
{
	$.post("getfollow.php",{userto:'.$addedbyid.',userfrom:'.$msg.',postid:'.$mypostid.',following:"'.$following.'"},function(data)
		{
			$(".newbutton'.$mypostid.'").html(data);
		})
})
</script>
</div>
';	
}
echo '<br><div id="grey">';
$diff=strtotime($datenow)-strtotime($dateadded);
$newdiff=($diff/86400);
$timediff=$timenow-$databasetime;
$newminute=ceil($timediff/(60));
$newhour=ceil($timediff/(60*60));
if($timediff>0 && $timediff<60)
{
	echo "2s ago";
}
if($timediff>60 && $timediff<3600)
{
echo $newminute."m ago";
}
if($timediff>3600 && $timediff<86400)
{
echo $newhour."h ago";
}
if($timediff>86400 && $newdiff>=1 && $newdiff<=30)
{
	echo $newdiff."d ago";
}
if($newdiff>30 && $timediff>86400)
{
	$newdate=date('j F Y',strtotime($dateadded));
	echo $newdate;
}
echo '</div><div id="postbody">
&nbsp;<center><img src="grey.jpg" data-original='.$imageurl.' id="imageurl" class="lazyimage">
<script>
$(function(){
	$("img.lazyimage").lazyload({
		threshold:300
	})
})
</script>
</center><br><br></div>';}
else if($body!=="" && $imageurl!=="")
{$imagequery="select * from register where id='$addedbyid'";
$imageresult=mysqli_query($connection,$imagequery);
$imagerow=mysqli_fetch_array($imageresult);
$showfirstname=$imagerow['firstname'];
$showlastname=$imagerow['lastname'];
$showimage=$imagerow['profilepic'];
echo '<br><br><br>
<img src="grey.jpg" data-original='.$showimage.' class="lazyibprofile" style="height:50px;width:50px;border-radius:40px;">
<script>
$(function(){
	$("img.lazyibprofile").lazyload({
		threshold:200
	})
})
</script>
<b><div id="space1">
<a href="profile.php?id='.$addedbyid.'&&page=1" style="color:#003f3c">'.$showfirstname.' '.$showlastname.'</a></div></b>';
if($msg==$addedbyid)
{echo '<div id="newbutton"><a href="delete.php?postid='.$mypostid.'"><img src="clipart/remove.png" style="height:20px;width:auto"></a>
</div>
';}
else
{
echo '<div id="newbutton1" class="newbutton'.$mypostid.'">
<script>
$("document").ready(function()
{
	$.post("getfollow.php",{userto:'.$addedbyid.',userfrom:'.$msg.',postid:'.$mypostid.',following:"'.$following.'"},function(data)
		{
			$(".newbutton'.$mypostid.'").html(data);
		})
})
</script>
</div>
';	
}
echo '<br><div id="grey">';
$diff=strtotime($datenow)-strtotime($dateadded);
$newdiff=($diff/86400);
$timediff=$timenow-$databasetime;
$newminute=ceil($timediff/(60));
$newhour=ceil($timediff/(60*60));
if($timediff>0 && $timediff<60)
{
	echo "2s ago";
}
if($timediff>60 && $timediff<3600)
{
echo $newminute."m ago";
}
if($timediff>3600 && $timediff<86400)
{
echo $newhour."h ago";
}
if($timediff>86400 && $newdiff>=1 && $newdiff<=30)
{
	echo $newdiff."d ago";
}
if($newdiff>30 && $timediff>86400)
{
	$newdate=date('j F Y',strtotime($dateadded));
	echo $newdate;
}
echo '</div><div id="postbody"><br>&nbsp;'.$body;
if($bodylength>2500)
{echo '<br>
<a href="postnote.php?id='.$mypostid.'">See full post</a>
';}
echo "<br><br></div>";
echo '<center><img src="grey.jpg" data-original='.$imageurl.' id="imageurl" class="lazyib">
<script>
$(function()
{
		$("img.lazyib").lazyload({
			threshold:300
		})
});
</script>
</center></div><br><br>';}
echo '<div id="iconbox"><a name="mylikes'.$mypostid.'" id="newlike'.$mypostid.'" class="newlike">';
$checklikequery=mysqli_query($connection,"select * from likes where postid='$mypostid'");
$checklikeresult=mysqli_fetch_array($checklikequery);
$checklikedby=$checklikeresult['addedby'];
$checklikedbyexplode=explode(",",$checklikedby);
if(in_array($msg,$checklikedbyexplode))
{
	echo '<img style="height:25px;width:auto;margin-top:3px" id="stylelike'.$mypostid.'" src="clipart/liked.png"/>';
}
else
{
	echo '<img style="height:25px;width:auto;margin-top:3px" id="stylelike'.$mypostid.'" src="clipart/newlike.png"/>';
}
echo '
</a><a href="likedby.php?postid='.$mypostid.'" style="color:black"><div id="result1'.$mypostid.'" class="likeresult">';
$countmylikesquery=mysqli_query($connection,"select * from likes where postid='$mypostid'") or die(mysqli_error($connection));
$findlike=mysqli_num_rows($countmylikesquery);
$countmylikesresult=mysqli_fetch_array($countmylikesquery);
$countlikes=$countmylikesresult['likes'];
if($findlike==0)
{
	echo "0";
}
else
{
	echo $countlikes;
}
echo '</div></a>
<a name="mydislikes'.$mypostid.'" id="newdislike'.$mypostid.'" class="newdislike">';
$countdislikequery=mysqli_query($connection,"select * from dislike where postid='$mypostid'") or die(mysqli_error($connection));
$countdislikeresult=mysqli_fetch_array($countdislikequery);
$countdislikedby=$countdislikeresult['addedby'];
$countdislikedbyexplode=explode(",",$countdislikedby);
if(in_array($msg,$countdislikedbyexplode))
{
	echo '<img style="height:25px;width:auto;margin-top:3px" id="styledislike'.$mypostid.'" src="clipart/disliked.png">';
}
else
{
	echo '<img style="height:25px;width:auto;margin-top:3px" id="styledislike'.$mypostid.'" src="clipart/newdislike.png">';
}
echo '</a>
<a href="dislikedby.php?postid='.$mypostid.'" style="color:black"><div class="dislikeresult" id="result2'.$mypostid.'">';
$countmydislikesquery=mysqli_query($connection,"select * from dislike where postid='$mypostid'") or die(mysqli_error($connection));
$finddislike=mysqli_num_rows($countmydislikesquery);
$countmydislikesresult=mysqli_fetch_array($countmydislikesquery);
$countdislikes=$countmydislikesresult['dislikes'];
if($finddislike==0)
{
	echo "0";
}
else
{
	echo $countdislikes;
}
echo '</div></a>
<script type="text/javascript" src="jquery.js"></script>
<script>
$("#newlike'.$mypostid.'").click(function()
{
	$.get("checklike.php",{id: '.$mypostid.',like: "mylikes'.$mypostid.'",newid: '.$msg.'},function(data)
		{
			$("#stylelike'.$mypostid.'").attr("src",data);
		})
});
$("#newlike'.$mypostid.'").click(function()
{
	$.post("like.php",{id: '.$mypostid.',like: "mylikes'.$mypostid.'",newid: '.$msg.',postby: "'.$addedbyid.'",type:"like"},function(data)
		{
			$("#result1'.$mypostid.'").html(data);
		})
});
$("#newdislike'.$mypostid.'").click(function()
{
	$.post("dislike.php",{id: '.$mypostid.',dislike: "mydislikes'.$mypostid.'",newid: '.$msg.',postby: "'.$addedbyid.'",type:"dislike"},function(data)
		{
			$("#result2'.$mypostid.'").html(data);
		})
});
$("#newdislike'.$mypostid.'").click(function()
{
	$.get("checkdislike.php",{id: '.$mypostid.',dislike: "mydislikes'.$mypostid.'",newid: '.$msg.'},function(data)
		{
			$("#styledislike'.$mypostid.'").attr("src",data);
		})
});
</script>';
echo '
<a class="seecomment" id="phonecomment" href="postcomments.php?id='.$mypostid.'"><img src="clipart/newcomment.png" style="height:25px;width:auto;margin-top:3px">
<div class="countcomments" id="countcomments1'.$mypostid.'">';
$commentcountquery=mysqli_query($connection,"select * from comments where postid='$mypostid'") or die(mysqli_error($connection));
$commentcountresult=mysqli_num_rows($commentcountquery);
if($commentcountresult==0)
{
	echo "0";
}
else
{
	echo $commentcountresult;
}
echo '</div></a>
<a class="star" id="star'.$mypostid.'" href="tagpeoplepost.php?post='.$mypostid.'"><img src="clipart/newstar.png" id="stylestar'.$mypostid.'" style="height:25px;width:auto;margin-top:3px"></a><br>
</div>
';
}
if($lastnumber!=1)
{
	if($pagenum!=$lastnumber)
	{
		$pagenum=$pagenum+1;
		if(isset($_GET['category']))
		{echo '<center><a href="home.php?category='.$catchoice.'&&page='.$pagenum.'"><div id="fornext" style="display:none"><b>Next page</b></div></a></center>';}
		else
		{
		echo '<center><a href="home.php?page='.$pagenum.'"><div id="fornext" style="display:none"><b>Next page</b></div></a></center>';
		}
	}
}
else
{
	echo "";
}
?>
<br>
</div>
<div id="containloader"></div>
<script>
var timeout;
var number=5;
function autoload()
{
	clearTimeout(timeout);
	timeout=setTimeout(function(){
		var storybox=document.getElementById("storybox");
		var storyheight=storybox.offsetHeight;
		var yoffset=window.pageYOffset;
		var y=yoffset + window.innerHeight;
		if(y>=storyheight-1000)
		{
			number=number+5;
			$("#containloader").append("<center><img src='clipart/loadajax.gif' id='ajaxloader'></center>");
			$.post("homecontent.php",{msg: '<?php echo $msg; ?>',number:number,category:"<?php echo $catchoice; ?>"},function(data)
				{
					$("#storybox").append(data);
					$("#containloader").html("");
				})
			
		}
	},100)
}
function checkuc()
{
	var ucvar=/UCBrowser/;
	var operavar=/Opera Mini/;
	var isuc=ucvar.test(navigator.userAgent);
	var isopera=operavar.test(navigator.userAgent);
	if(isuc==true)
	{
		$("#nextdiv").css("display","none");
		$("#roll").css("display","none");
		$("#rollopera").css("display","block");
	}
	if(isopera==true)
	{
		$("#nextdiv").css("display","none");
		$("#fornext").css("display","block");
		$("#roll").css("display","none");
		$("#rollopera").css("display","block");	
	}
}
window.addEventListener("load",checkuc);
window.addEventListener("scroll",autoload);
</script>
<script src="jquery.js"></script>
<script src="lazyload/jquery.lazyload.js"></script> 
</body>
</html>
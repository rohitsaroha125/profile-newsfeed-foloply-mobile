<?php
include('connection.php');
$id=$_POST['id'];
$inviteid=$_POST['inviteid'];
$fullname=mysqli_real_escape_string($connection,$_POST['name']);
$email=$_POST['email'];
$pos=strpos($fullname," ");
$firstname=mysqli_real_escape_string($connection,substr($fullname,0,$pos));
$lastname=mysqli_real_escape_string($connection,substr($fullname,$pos+1,1000));
$sql=mysqli_query($connection,"select * from invite where id='$inviteid'") or die(mysqli_error($connection));
$sqlresult=mysqli_fetch_array($sql);
$userfrom=$sqlresult['userfrom'];
$query=mysqli_query($connection,"select * from register where email='$email'") or die(mysqli_error($connection));
$countquery=mysqli_num_rows($query);
if($countquery==0)
{
$insertquery=mysqli_query($connection,"insert into register (id,firstname,lastname,email,fullname,profilepic,accounttype,facebookid) values ('','$firstname','$lastname','$email','$fullname','noprofile.png','1','$id')") or die(mysqli_error($connection));
if($insertquery)
{
$newsql=mysqli_query($connection,"select * from mvp where myid='$userfrom'") or die(mysqli_error($connection));
	$countsql=mysqli_num_rows($newsql);
	if($countsql==0)
	{
		$insertsql=mysqli_query($connection,"insert into mvp values ('','$userfrom','20')") or die(mysqli_error($connection));
	}
	else
	{$updatequery=mysqli_query($connection,"update mvp set ratings=ratings+20 where myid='$userfrom'") or die(mysqli_error($connection));}
$selectquery=mysqli_query($connection,"select * from register where email='$email'") or die(mysqli_error($connection));
$selectresult=mysqli_fetch_array($selectquery);
$loginid=$selectresult['id'];
setcookie('id',$loginid,time()+86000);
echo "meme.php?page=1";
}	
}
else
{
$selectquery=mysqli_query($connection,"select * from register where email='$email'") or die(mysqli_error($connection));
$selectresult=mysqli_fetch_array($selectquery);
$loginid=$selectresult['id'];
setcookie('id',$loginid,time()+86000);
echo "meme.php?page=1";
}
?>
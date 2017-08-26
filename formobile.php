<html>
<head>
<title>Login,Signup for free</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<style>
body{background:url('clipart/back.jpg');margin:0px;padding:0px;background-attachment:fixed;color:white;font-family:arial;width:100%;height:auto}
#nav{margin-top:0px;background:#003f3c;width:100%;height:60px}
.element{border-radius:4px 4px 4px 4px;height:30px;font-size:17px;width:250px}
.element:focus{border-color:#8000ff;height:35px;width:300px}
#register{background:#f6f7fa; color:#4d4d4c;font-family:arial;font-size:15px;height:400px;width:450px;border-radius:8px 8px 8px 8px}
#register1{background:#f0f0f0;color:black;border-radius:8px 8px 8px 8px}
button{background:#619f4e;color:white;font-family:arial;border:1px solid #3974c6;font-size:17px;border-radius:4px;width:50%;height:33px}
#left{margin-left:10px}
#select {background:#f0f0f0}
#select ul{list-style:none}
#select ul li{padding:3px; display:inline-block;margin-right:23px}
#button{background:#619f4e;color:white;font-family:arial;border:1px solid #3974c6;font-size:17px;border-radius:2px 2px 2px 2px}
#fn{color:red}
#skip{font-family:arial;border:1px solid #3974c6;font-size:17px;border-radius:4px;background:white;color:black}
#ln{color:red}
#email{color:red}
#pass{color:red}
#pass2{color:red}
#lower{margin-top:370px}
#gendertype{color:red}
#calender{color:red}
#email1{width:70%;height:28px;border-radius:4px 4px 0px 0px;font-size:15px;border:1px solid #eaeaea}
#password1{width:70%;height:28px;border-radius:0px 0px 4px 4px;font-size:15px;border:1px solid #eaeaea}
</style>
</head>
<body><center><div id="nav"><center><img src="clipart/foloply.png" style="height:60px;width:auto"></center></div><br><br><br>
<form action="loginwebsite.php" method="post"><input type="text" name="email1" id="email1" placeholder="Email"><br>
<input type="password" name="password1" id="password1" placeholder="Password"><br><br>
 <BUTTON>Log In</button>
 </form>
 or
<div id="fb-root"></div>
<script src="jquery.js"></script>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '234084077010995', // Set YOUR APP ID
      channelUrl : 'foloply.com', // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true  // parse XFBML
    }); 
    };
 
    function Login()
    {
 
        FB.login(function(response) {
           if (response.authResponse) 
           {
                getUserInfo();
            } else 
            {
             console.log('User cancelled login or did not fully authorize.');
            }
         },{scope: 'email'});
 
    }
  function getUserInfo() {
        FB.api('/me', {fields: 'name,email'},function(response) {
      var name=response.name;
      var id=response.id;
      var email=response.email;
	  $.post("addfbuser.php",{name:name,email:email,id:id},function(data)
		  {
			  window.location.href=data;
		  })
    });
    }
  // Load the SDK asynchronously
  (function(d){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all.js";
     ref.parentNode.insertBefore(js, ref);
   }(document));
</script>
<div id="status">
<img src="clipart/fb_login.png" style="cursor:pointer;width:60%;height:auto;margin-top:-15px" onclick="Login()"/>
</div>
<form action="register.php" method="post">
 <br><b>Are you a new user Signup now?</b><br><button id="skip">
Signup!
 </button>
 </form>
</center>
</body>
</html>
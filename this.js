function validate_email(email)
{
	$.post('email.php',{email: email},function(data)
		{
			$('#email').html(data);
		})
}
$('#first_name').focusout(function()
{
if($('#first_name').val().length==0)
{
	$('#fn').html("please enter your first name");
}
else {
	$('#fn').html("");
}
});
$('#button').click(function()
{
if($('#first_name').val().length==0)
{
	$('#fn').html("please enter your first name");
	return false;
}
});
$('#email_add').focusout(function()
{
if($('#email_add').val().length==0)
{
	$('#email').html("please enter your email address");
}
});
$('#email_add').focusout(function()
{
validate_email($('#email_add').val());
});
$('#button').click(function()
{
	validate_email($('#email_add').val());
});
$('#password').focusout(function()
{
if($('#password').val().length==0)
{
	$('#pass').html("please choose password for your account");
}
else {
	$('#pass').html("");
}
});
$('#button').click(function()
{
if($('#password').val().length==0)
{
	$('#pass').html("please choose password for your account");
	return false;
}
});
$('#password2').focusout(function()
{
if($('#password').val()!==$('#password2').val())
{
	$('#pass2').html("sorry but the password doesn't match");
}
else {
	$('#pass2').html("");
}
});
$('#button').click(function()
{
	if($('#password').val()!==$('#password2').val())
	{
		$('#pass2').html("sorry but the password doesn't match");
		return false;
	}
});
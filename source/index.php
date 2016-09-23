<?PHP
require_once("./include/membersite_config.php");
if($_GET['action'] == 'logout'){
	$fgmembersite->LogOut();
	$isAuthenticated = false;
	$displayMessage = 'You have been logged out.';
} else if($_GET['action'] == 'resetpwd'){
	$isAuthenticated = false;
	if($fgmembersite->ResetPassword()){
		$displayMessage = 'Your new password is sent to your email address.';
	} else {
		$displayMessage = "Error: " .
			$fgmembersite->GetErrorMessage();
	}
} else {
	$isAuthenticated = $fgmembersite->CheckLogin();
	$displayMessage = null;
	if($_GET['action'] == 'message'){
		switch($_GET['message']){
			case 'change-pwd-success':
				$displayMessage = "Your password was changed successfully.";
				break;
			case 'register-success':
				$displayMessage = "Registration saved successfully. A confirmation code will be sent to your email address to complete the registration process.";
				break;
			case 'confirmreg-success':
				$displayMessage = "Registration confirmed and completed. You may now log into your account.";
				break;
			case 'reset-pwd-req-success':
				$displayMessage = "An email is sent to your email address that contains the link to reset the password.";
				break;
		}
	}
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>Home page</title>
      <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css">
</head>
<body>
<div id='fg_membersite_content'>
<?PHP if($displayMessage){ ?>
	<div id="displaymessage">
		<?PHP echo $displayMessage; ?>
	</div>
<?PHP } if($isAuthenticated) { ?>
	<h2>Home Page</h2>
	Welcome back <?= $fgmembersite->UserFullName(); ?>!
	<p><a href='change-pwd.php'>Change password</a></p>
	<p><a href='invitations.php'>Invitations</a></p>
	<br><br><br>
	<p><a href='index.php?action=logout'>Logout</a></p>
<?PHP } else { ?>
	<h2>Home Page</h2>
	Unauthenticated
	<p><a href='login.php'>Login</a></p>
	<p><a href='register.php'>Register</a></p>
<?PHP } ?>
</div>
</body>
</html>

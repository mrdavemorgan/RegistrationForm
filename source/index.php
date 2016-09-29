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
			$displayMessage = 'Error: ' . $fgmembersite->GetErrorMessage();
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

	$content = "<h2>Home Page</h2>\n";
	if($isAuthenticated){
		$content .= "Welcome back " . $fgmembersite->UserFullName() . "!\n";
	} else {
		$content .= "Unauthenticated\n";
	}
	$title = "Home Page";

	require('include/pagetemplate.php');
?>
<?PHP
require_once("./include/membersite_config.php");

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("login.php");
    exit;
}
else if(isset($_POST['submitted']))
{
   $fgmembersite->SubmitInvitation();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>Invitations</title>
      <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css">
</head>
<body>
<div id='fg_membersite_content'>
<h2>Invitations from <?= $fgmembersite->UserFullName() ?></h2>

<?php
	$err = $fgmembersite->GetErrorMessage();
	if(!empty($err)){ 
		echo "<div class=\"invitations\">\n";
		echo "Error: <div class=\"invitation\">" . $err . "</div>\n</div>\n";
	} else if(isset($_POST['submitted'])){
		echo "<div class=\"invitations\">\n";
		echo "Success: <div class=\"invitation\">Invitation has been sent.</div>\n</div>\n";
	}
?>

<?php
	$invites = $fgmembersite->GetInvitationsFromUser($fgmembersite->UserId());
	echo "<div class=\"invitations\">\n<legend>Sent invitations: ";
	echo count($invites) . '/' . $fgmembersite->max_invitations_user . "</legend>\n";
	foreach($invites as $invitation){
		echo "<div class=\"invitation\"><div class=\"invitee\">" . $invitation['invitee'] . "</div>\n";
		if($invitation['accepted']){
			echo " accepted </div>\n";
		} else {
			echo " pending </div>\n";
		}
	}
	echo "</div>\n";
?>

<?php if($fgmembersite->max_invitations_user > count($invites)) { ?>
<div class="invitations">
<form id='invite' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
<legend>New invitation:</legend>
<input type='hidden' name='submitted' id='submitted' value='1'/>
<div class='invitation'>
    <input type='text' name='email' id='email' placeholder="E-mail Address" value='<?php echo $fgmembersite->SafeDisplay('email') ?>' maxlength="50" />
    <span id='register_email_errorloc' class='error'></span>
    <input type='submit' name='Submit' value='Submit' />
</div>
</form>
</div>
<?php } ?>

<p>
<a href='index.php'>Home</a>
</p>
</div>
</body>
</html>

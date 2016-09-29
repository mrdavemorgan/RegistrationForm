<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title><?php echo $title; ?></title>
      <link rel="STYLESHEET" type="text/css" href="style/styles.css">
      <link rel="STYLESHEET" type="text/css" href="style/pwdwidget.css" />
      <script src="scripts/pwdwidget.js" type="text/javascript"></script>
      <script type='text/javascript' src='scripts/gen_validatorv31.js'></script>  
</head>
<body>

<div id="nav" class="nav">
	<a class="nav" href='index.php'>Home</a>
<?php if($isAuthenticated) { ?>
	<a class="nav" href='change-pwd.php'>Change password</a>
	<a class="nav" href='invitations.php'>Invitations</a>
	<a class="nav" href='index.php?action=logout'>Logout</a>
<?php } else { ?>
	<a class="nav" href='login.php'>Login</a>
	<a class="nav" href='register.php'>Register</a>
<?php } ?>
</div>

<?php if($displayMessage) { ?>
<div id="displaymessage" class="displaymessage" onclick="this.style.display='none';">
<?php echo $displayMessage; ?>
</div>
<?php } ?>

<div id="content" class="content">
<?php echo $content; ?>
</div>

</body>
</html>
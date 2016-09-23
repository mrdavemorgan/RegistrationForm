<?PHP
require_once("./include/membersite_config.php");
$isAuthenticated = $fgmembersite->CheckLogin();
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
<?PHP if($isAuthenticated) { ?>
	<h2>Home Page</h2>
	Welcome back <?= $fgmembersite->UserFullName(); ?>!
	<p><a href='change-pwd.php'>Change password</a></p>
	<p><a href='invitations.php'>Invitations</a></p>
	<br><br><br>
	<p><a href='logout.php'>Logout</a></p>
<?PHP } else { ?>
	<h2>Home Page</h2>
	Unauthenticated
	<p><a href='login.php'>Login</a></p>
	<p><a href='register.php'>Register</a></p>
<?PHP } ?>
</div>
</body>
</html>

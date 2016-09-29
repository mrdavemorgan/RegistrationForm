<?PHP
require_once("./include/membersite_config.php");
if(isset($_POST['submitted']))
{
   if($fgmembersite->Login())
   {
        $fgmembersite->RedirectToURL("index.php");
        exit();
   }
}

$title = "Login";

function generateDocumentContent($title, $fgmembersite){
return <<<HTML
	<form id="login" action="{$fgmembersite->GetSelfScript()}" method="post" accept-charset="UTF-8">
		<input type="hidden" name="submitted" id="submitted" value="1"/>
		<h2>{$title}</h2>
		<p class="fineprint">* required fields</p>
		<p class="inlineerror">{$fgmembersite->GetErrorMessage()}</p>
		<div class="formline">
			<label for="username">User Name *:</label>
			<input type="text" name="username" id="username" maxlength="50" value="{$fgmembersite->SafeDisplay('username')}"/>
			<span class="inlineerror" id="login_username_errorloc"></span>
		</div>
		<div class="formline">
			<label for="password">Password *:</label>
			<input type="password" name="password" id="password" maxlength="50"/>
			<span class="inlineerror" id="login_password_errorloc"></span>
		</div>
		<div class="formline">
			<input type="submit" name="Submit" value="Submit"/>
		</div>
	</form>
	<script type="text/javascript">
		// <![CDATA[
	    var frmvalidator  = new Validator('login');
	    frmvalidator.EnableOnPageErrorDisplay();
	    frmvalidator.EnableMsgsTogether();
	    frmvalidator.addValidation('username','req','Please provide your username');
	    frmvalidator.addValidation('password','req','Please provide the password');
		// ]]>
	</script>
HTML;
}

$content = generateDocumentContent($title, $fgmembersite);
require('include/pagetemplate.php');
?>
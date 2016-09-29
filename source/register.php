<?PHP
require_once("./include/membersite_config.php");
if(isset($_POST['submitted']))
{
   if($fgmembersite->RegisterUser())
   {
        $fgmembersite->RedirectToURL("index.php?action=message&message=register-success");
        exit;
   }
}

$title = "Register";

function generateDocumentContent($title, $fgmembersite){
$ret = <<<HTML
	<form id="register" action="{$fgmembersite->GetSelfScript()}" method="post" accept-charset="UTF-8">
        <input type="hidden" name="submitted" id="submitted" value="1"/>
        <input type="text" name="{$fgmembersite->GetSpamTrapInputName()}" style="display: none;"/>
        <h2>{$title}</h2>
        <p class="fineprint">* required fields</p>
        <p class="inlineerror">{$fgmembersite->GetErrorMessage()}</p>
HTML;
if($fgmembersite->max_invitations_total >= 0) {
$ret .= <<<HTML
        <div class="formline">
                <label for="invitation">Invitation Code *:</label>
                <input type="text" name="invitation" id="invitation" maxlength="50" value="{$fgmembersite->SafeDisplayEx('invitation')}"/>
                <span class="inlineerror" id="register_invitation_errorloc"></span>
        </div>
HTML;
}
$ret .= <<<HTML
        <div class="formline">
	        <label for="name">Your Full Name *:</label>
	        <input type="text" name="name" id="name" maxlength="50" value="{$fgmembersite->SafeDisplay('name')}"/>
	        <span class="inlineerror" id="register_name_errorloc"></span>
        </div>
        <div class="formline">
                <label for="email">Email Address *:</label>
                <input type="text" name="email" id="email" maxlength="50" value="{$fgmembersite->SafeDisplay('email')}"/>
                <span class="inlineerror" id="register_email_errorloc"></span>
        </div>
        <div class="formline">
                <label for="username">User Name *:</label>
                <input type="text" name="username" id="username" maxlength="50" value="{$fgmembersite->SafeDisplay('username')}"/>
                <span class="inlineerror" id="login_username_errorloc"></span>
        </div>
        <div class="formline" style="height: 80px;">
                <label for="password">Password *:</label>
                <div class="pwdwidgetdiv" id="thepwddiv">
                </div>
                <noscript>
                        <input type="password" name="password" id="password" maxlength="50"/>
                </noscript>
                <span class="inlineerror" id="register_password_errorloc"></span>
        </div>
        <div class="formline">
                <input type="submit" name="Submit" value="Submit"/>
        </div>
	</form>
	<script type="text/javascript">
        // <![CDATA[
        var pwdwidget = new PasswordWidget('thepwddiv','password');
        pwdwidget.MakePWDWidget();
        var frmvalidator  = new Validator('register');
        frmvalidator.EnableOnPageErrorDisplay();
        frmvalidator.EnableMsgsTogether();
        frmvalidator.addValidation('name','req','Please provide your name');
        frmvalidator.addValidation('email','req','Please provide your email address');
        frmvalidator.addValidation('email','email','Please provide a valid email address');
        frmvalidator.addValidation('username','req','Please provide a username');
        frmvalidator.addValidation('password','req','Please provide a password');
        // ]]>
	</script>
HTML;

return $ret;
}

$content = generateDocumentContent($title, $fgmembersite);
require('include/pagetemplate.php');
?>
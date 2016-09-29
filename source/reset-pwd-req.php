<?PHP
require_once("./include/membersite_config.php");
if(isset($_POST['submitted']))
{
   if($fgmembersite->EmailResetPasswordLink())
   {
        $fgmembersite->RedirectToURL("index.php?action=message&message=reset-pwd-req-success");
        exit;
   }
}

$title = "Reset password request";

function generateDocumentContent($title, $fgmembersite){
return <<<HTML
  <form id="resetreq" action="{$fgmembersite->GetSelfScript()}" method="post" accept-charset="UTF-8">
    <h2>{$title}</h2>
    <input type="hidden" name="submitted" id="submitted" value="1"/>
    <p class="inlineerror">{$fgmembersite->GetErrorMessage()}</p>
    <div class="formline">
      <label for="username">Your Email: </label>
      <input type="text" name="email" id="email" maxlength="50" value="{$fgmembersite->SafeDisplay('email')}"/>
      <span class="inlineerror" id="resetreq_email_errorloc"></span>
    </div>
    <div class="fineprint">A link to reset your password will be sent to the email address.</div>
    <div class="formline">
      <input type="submit" name="Submit" value="Submit"/>
    </div>
  </form>

  <script type="text/javascript">
    // <![CDATA[
    var frmvalidator  = new Validator('resetreq');
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();
    frmvalidator.addValidation('email','req','Please provide the email address used to sign-up');
    frmvalidator.addValidation('email','email','Please provide the email address used to sign-up');
    // ]]>
  </script>
HTML;
}

$content = generateDocumentContent($title, $fgmembersite);
require('include/pagetemplate.php');
?>
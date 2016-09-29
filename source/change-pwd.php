<?PHP
require_once("./include/membersite_config.php");
if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("login.php");
    exit;
}
if(isset($_POST['submitted']))
{
   if($fgmembersite->ChangePassword())
   {
        $fgmembersite->RedirectToURL("index.php?action=message&message=change-pwd-success");
   }
}

$title = "Change password";
$isAuthenticated = true;

function generateDocumentContent($title, $fgmembersite){
return <<<HTML
  <form id="changepwd" action="{$fgmembersite->GetSelfScript()}" method="post" accept-charset="UTF-8">
    <h2>{$title}</h2>
    <input type="hidden" name="submitted" id="submitted" value="1"/>
    <p class="inlineerror">{$fgmembersite->GetErrorMessage()}</p>
    <div class="formline">
      <label for="oldpwd">Old Password: *</label>
      <div class="pwdwidgetdiv pwdwidget" id="oldpwddiv"></div>
      <noscript><input type="password" name="oldpwd" id="oldpwd" maxlength="50"/></noscript>
      <span class="inlineerror" id="changepwd_oldpwd_errorloc"></span>
    </div>
    <div class="formline">
      <label for="newpwd">New Password: *</label>
      <div class="pwdwidgetdiv pwdwidget" id="newpwddiv"></div>
      <noscript><input type="password" name="newpwd" id="newpwd" maxlength="50"/></noscript>
      <span class="inlineerror" id="changepwd_newpwd_errorloc"></span>
    </div>
    <div class="formline">
      <input type="submit" name="Submit" value="Submit"/>
    </div>
    <p class="fineprint">* required fields</p>
  </form>
  <script type="text/javascript">
  // <![CDATA[
      var pwdwidget = new PasswordWidget('oldpwddiv','oldpwd');
      pwdwidget.enableGenerate = false;
      pwdwidget.enableShowStrength=false;
      pwdwidget.enableShowStrengthStr =false;
      pwdwidget.MakePWDWidget();
      var pwdwidget = new PasswordWidget('newpwddiv','newpwd');
      pwdwidget.MakePWDWidget();
      var frmvalidator  = new Validator('changepwd');
      frmvalidator.EnableOnPageErrorDisplay();
      frmvalidator.EnableMsgsTogether();
      frmvalidator.addValidation('oldpwd','req','Please provide your old password');
      frmvalidator.addValidation('newpwd','req','Please provide your new password');
  // ]]>
  </script>
HTML;
}

$content = generateDocumentContent($title, $fgmembersite);
require('include/pagetemplate.php');
?>
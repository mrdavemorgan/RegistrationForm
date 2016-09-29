<?PHP
require_once("./include/membersite_config.php");
if(isset($_GET['code']))
{
   if($fgmembersite->ConfirmUser())
   {
        $fgmembersite->RedirectToURL("index.php?action=message&message=confirmreg-success");
        exit;
   }
}

$title = "Confirm Registration";

function generateDocumentContent($title, $fgmembersite){
$ret = <<<HTML
  <form id="confirm" action="{$fgmembersite->GetSelfScript()}" method="get" accept-charset="UTF-8">
    <h2>{$title}</h2>
    <p class="fineprint">* required fields</p>
    <p class="inlineerror">{$fgmembersite->GetErrorMessage()}</p>
    <div class="formline">
      <label for="name">Confirmation Code *:</label>
      <input type="text" name="code" id="code" maxlength="50" />
      <span class="inlineerror" id="register_code_errorloc"></span>
    </div>
    <div class="formline">
      <input type="submit" name="Submit" value="Submit"/>
    </div>
  </form>
  <script type="text/javascript">
  // <![CDATA[
      var frmvalidator  = new Validator("confirm");
      frmvalidator.EnableOnPageErrorDisplay();
      frmvalidator.EnableMsgsTogether();
      frmvalidator.addValidation("code","req","Please enter the confirmation code");
  // ]]>
  </script>
HTML;
return $ret;
}

$content = generateDocumentContent("Please enter the confirmation code in the box below.", $fgmembersite);
require('include/pagetemplate.php');
?>
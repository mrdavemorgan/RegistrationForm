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

$title = "Invitations";
$isAuthenticated = true;

function generateNewInvitationForm($fgmembersite){
$ret = <<<HTML
  <div class="invitations">
    <form id="invite" action="{$fgmembersite->GetSelfScript()}" method="post" accept-charset="UTF-8">
      <input type="hidden" name="submitted" id="submitted" value="1"/>
      <div class="formline">
          <p>New Invitation:</p>
          <input type="text" name="email" id="email" placeholder="E-mail Address" value="{$fgmembersite->SafeDisplay("email")}" maxlength="50" />
          <span id="register_email_errorloc" class="error"></span>
          <p></p>
          <input type="submit" name="Submit" value="Submit" />
      </div>
    </form>
  </div>
HTML;
return $ret;
}

function generateDocumentContent($title, $fgmembersite, $invites){
  $ret = "<h2>$title</h2>\n";
  if($fgmembersite->GetErrorMessage()){
    $ret .= "<p class=\"inlineerror\">{$fgmembersite->GetErrorMessage()}</p>\n";
  } else if(isset($_POST['submitted'])){
    $ret .= "<h3>Success: Invitation has been sent.</h3>\n";
  }
  $ret .= "<div class=\"formline\">\n<p>Sent Invitations: " . count($invites);
  $ret .= "/{$fgmembersite->max_invitations_user}</p>\n";
  foreach($invites as $invitation){
    $ret .= "<div class=\"invitation\"><div class=\"invitee\">{$invitation['invitee']}</div>\n";
    if($invitation['accepted']){
      $ret .=  " accepted </div>\n";
    } else {
      $ret .=  " pending </div>\n";
    }
  }
  $ret .=  "</div>\n";
  return $ret;
}

$invites = $fgmembersite->GetInvitationsFromUser($fgmembersite->UserId());
$content = generateDocumentContent($title, $fgmembersite, $invites);
if($fgmembersite->max_invitations_user > count($invites)) {
  $content .= generateNewInvitationForm($fgmembersite);
}
require('include/pagetemplate.php');
?>
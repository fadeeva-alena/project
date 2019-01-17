<?php
include_once(getabspath('classes/runnerpage.php'));
require_once(getabspath("classes/cipherer.php"));
/**
 * Class for login page 
 *
 */
class LoginPage extends RunnerPage 
{
	var $auditObj = null;

	var $fromFacebook = false;
	var $ldap_domainName = null;
	var $ldap_serverIP = null;
	var $message = "";
	
	function LoginPage(&$params) 
	{
		// call parent constructor
		parent::RunnerPage($params);
		
		$this->auditObj = GetAuditObject();
	}
	
		
	/**
	* Login method
	*
	*/
	function LogIn($pUsername,$pPassword){
				//	 username and password are hardcoded
		$cUserName = "admin";
		$cPassword = "pzuoi6354";
		
		if (!strcmp($cPassword, $pPassword) && !strcmp($this->pSet->getCaseSensitiveUsername($cUserName), $this->pSet->getCaseSensitiveUsername($pUsername))) {
			$_SESSION["UserID"] = $pUsername;
			$_SESSION["UserName"] = $pUsername;
			$_SESSION["AccessLevel"] = ACCESS_LEVEL_USER;
			if($this->auditObj)
			{
				$this->auditObj->LogLogin($pUsername);
				$this->auditObj->LoginSuccessful();
			}

			if($this->isCaptchaOk)
			{
				$dummy = array();
				SetAuthSessionData($pUsername, $dummy, false, $pPassword);
				return true;
			}	
		}
		else {
			if($this->auditObj)
			{
				$this->auditObj->LogLoginFailed($pUsername);
				$this->auditObj->LoginUnsuccessful($pUsername);
			}
			return false;
		}
	}
	
	/**
	 * Logout
	 *
	 */
	function Logout(){
		if($this->auditObj)
			$this->auditObj->LogLogout();

		session_unset();
		setcookie("username","",time()-365*1440*60);
		setcookie("password","",time()-365*1440*60);
				header("Location: login.php");
		exit();
	}
	
	

}

?>
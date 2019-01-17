<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/styles.css" type="text/css" charset="utf-8" />
<link rel="stylesheet" href="css/date_input.css" type="text/css" charset="utf-8" />
<title><?php echo htmlspecialchars($this->pageTitle) ?></title>
<script type="text/javascript" language="Javascript" src="scripts/jquery-1.4.2.js"></script>
<script type="text/javascript" language="Javascript" src="scripts/livevalidation_standalone.compressed.js"></script>
<script>
$(document).ready(function() {
	window.validMessage = 'Danke.';
	window.failureMessage = 'Bitte ausfüllen.';
	window.confirmFailureMessage = 'Stimmt nicht überein.';
	window.emailMessage = 'Wir benötigen eine gültige Email-Adresse.';
	window.acceptMessage = 'Bitte akzeptieren Sie die allgemeinen Geschäftsbedingungen.';
});
</script>
</head>

<body>

<div id="body">

<div id="header">
	<ul>
		<li><a href="index.php" tabindex="1">Start</a></li>
	<?php if(RoleEntity::ROLE_ADMIN != $this->user->roleId) { ?>
		<li><a href="aboutUs.php" tabindex="1">Über uns</a></li>
		<li><a href="contactUs.php" tabindex="1">Kontakt</a></li>
	<?php } ?>
	<?php switch($this->user->roleId) {
		case RoleEntity::ROLE_VISITOR: ?>
<?php	break; case RoleEntity::ROLE_CLIENT: ?>
		<li><a href="login.php?action=logout" tabindex="1">Abmeldung</a></li>
<?php	break; case RoleEntity::ROLE_PROF: ?>
		<li><a href="login.php?action=logout" tabindex="1">Abmeldung</a></li>
<?php	break; case RoleEntity::ROLE_ADMIN: ?>
		<li><a href="adminUsers.php" tabindex="1">Users</a></li>
		<li><a href="adminSettings.php" tabindex="1">Settings</a></li>
		<li><a href="adminMessages.php" tabindex="1">Messages</a></li>
		<li><a href="adminStatistics.php" tabindex="1">Statistics</a></li>
		<li><a href="login.php?action=logout" tabindex="1">Abmeldung</a></li>
<?php	break;
	} ?>
	</ul>
</div>

<div id="contents">
	<h2><?php echo $this->pageSubtitle ?></h2>

	<?php $this->renderNavigation() ?>

	<hr />

	<?php if(!is_null($this->pageDescription)) { ?><h5><?php echo $this->pageDescription ?></h5><?php } ?>

	<?php if(0 < count($this->errors)) { ?>
	<div class="errorsPanel">
		<?php foreach($this->errors as $error) { ?>
		<div class="errorMessage"><?php echo htmlspecialchars($error) ?></div>
		<?php } ?>
	</div>
	<?php } ?>

	<?php if(0 < count($this->infos)) { ?>
	<div class="infosPanel">
		<?php foreach($this->infos as $info) { ?>
		<div class="infoMessage"><?php echo htmlspecialchars($info) ?></div>
		<?php } ?>
	</div>
	<?php } ?>

	<?php $this->render() ?>

	<hr />
</div>
 
<div id="footer">
	<a href="terms.php" tabindex="32000">Allgemeine Geschäftsbedingungen</a> | <a href="privacy.php" tabindex="32001">Datenschutzbestimmungen</a> | <a href="faq.php" tabindex="32002">Häufige Fragen</a><br />
	Copyright &copy; 2011 David Schläpfer.<br />
	Alle Rechte vorbehalten.
</div>

<script type="text/javascript">
$(document).ready(function() {
	var els = $('#contents');
	els.css({ opacity: 0 });
	els.fadeTo(1000, 1, function() {
		$(this).css('filter', '');
	});
});
</script>

<noscript>
<style type="text/css">
#contents {
	opacity: 1;
	filter: progid:DXImageTransform.Microsoft.Alpha(opacity=100);
}
</style>
</noscript>

</div>

</body>

</html>
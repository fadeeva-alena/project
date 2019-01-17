<form action="login.php?action=login" method="post">
<fieldset>
	<legend>Eingang</legend>
	<table>
		<tr>
			<td><label for="login">Benutzername:</label></td>
			<td><input id="login" name="login" type="text" tabindex="10" value="<?php echo htmlspecialchars($this->login) ?>" /><span class="required">*</span></td>
			<td><a href="forgotLogin.php" tabindex="13">Benutzername vergessen</a></td>
		</tr>
		<tr>
			<td><label for="password">Passwort:</label></td>
			<td><input id="password" name="password" type="password" tabindex="11" /><span class="required">*</span></td>
			<td><a href="forgotPassword.php" tabindex="14">Passwort vergessen</a></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="submit" value="Einloggen" tabindex="12" /></td>
			<td>Noch nicht angemeldet? Melden Sie sich <a href="register.php" tabindex="15">hier</a> an.</td>
		</tr>
	</table>
</fieldset>
</form>

<script type="text/javascript">
$(document).ready(function() {
	var field;
	field = new LiveValidation('login', { validMessage: window.validMessage });
	field.add(Validate.Length, { maximum: 50 });
	field.add(Validate.Presence, { failureMessage: window.failureMessage });

	field = new LiveValidation('password', { validMessage: window.validMessage });
	field.add(Validate.Length, { maximum: 50 });
	field.add(Validate.Presence, { failureMessage: window.failureMessage });
});
</script>

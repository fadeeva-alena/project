<form action="register.php?action=register" method="post">

<fieldset>
<legend>Anmeldeinformationen</legend>
<table>
	<tr>
		<td class="label"><label for="login">Login:</label></td>
		<td><input id="login" name="login" type="text" value="<?php echo htmlspecialchars($this->login) ?>" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td class="label"><label for="email">Email:</label></td>
		<td><input id="email" name="email" type="text" value="<?php echo htmlspecialchars($this->email) ?>" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td class="label"><label for="password">Passwort:</label></td>
		<td><input id="password" name="password" type="password" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td class="label"><label for="confirmPassword">Passwort bestätigen:</label></td>
		<td><input id="confirmPassword" name="confirmPassword" type="password" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td class="label">Du bist ein...:</td>
		<td>
			<input id="clientRoleId" name="roleId" type="radio" <?php echo (((RoleEntity::ROLE_CLIENT == $this->roleId) || !$this->roleId)? 'checked="checked" ': '') ?>value="<?php echo RoleEntity::ROLE_CLIENT ?>" /><label for="clientRoleId">Kunde</label>
			<input id="profRoleId" name="roleId" type="radio" <?php echo ((RoleEntity::ROLE_PROF == $this->roleId)? 'checked="checked" ': '') ?>value="<?php echo RoleEntity::ROLE_PROF ?>" /><label for="profRoleId">Dienstleister</label><span class="required">*</span>
		</td>
	</tr>
	<tr>
		<td class="label">&nbsp;</td>
		<td class="label">
			<input id="newsSubscription" name="newsSubscription" type="checkbox" <?php echo (($this->newsSubscription)? 'checked="checked" ': '') ?>/><label for="newsSubscription">Ja, schicken Sie mir Informationen zu Verbesserungen und Erweiterungen.</label>
		</td>
	</tr>
	<tr>
		<td class="label">&nbsp;</td>
		<td class="label">
			<input id="agreement" name="agreement" type="checkbox" <?php echo (($this->agreement)? 'checked="checked" ': '') ?>/><label for="agreement"><a href="terms.php" target="_blank">Nutzungsbedingungen</a> und <a href="privacy.php" target="_blank">Datenschutzbestimmungen</a> gelesen, verstanden und akzeptiert.</label><span class="required">*</span>
		</td>
	</tr>
</table>
</fieldset>

<div class="submit"><input name="submit" type="submit" value="Anmelden" /></div>

</form>

<script type="text/javascript">
$(document).ready(function() {
	var field;
	field = new LiveValidation('login', { validMessage: window.validMessage });
	field.add(Validate.Length, { maximum: 50 });
	field.add(Validate.Presence, { failureMessage: window.failureMessage });

	var field = new LiveValidation('email', { validMessage: window.validMessage });
	field.add(Validate.Length, { maximum: 100 });
	field.add(Validate.Presence, { failureMessage: window.failureMessage });
	field.add(Validate.Email, { failureMessage: window.emailMessage });

	field = new LiveValidation('password', { validMessage: window.validMessage });
	field.add(Validate.Length, { maximum: 50 });
	field.add(Validate.Presence, { failureMessage: window.failureMessage });

	field = new LiveValidation('confirmPassword', { validMessage: window.validMessage });
	field.add(Validate.Length, { maximum: 50 });
	field.add(Validate.Confirmation, { match: 'password', failureMessage: window.confirmFailureMessage });
	field.add(Validate.Presence, { failureMessage: window.failureMessage });

	field = new LiveValidation('agreement', { validMessage: window.validMessage });
	field.add(Validate.Acceptance, { failureMessage: window.acceptMessage });
});
</script>

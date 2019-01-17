<form action="adminAccount.php?action=update" method="post">
<table>
	<tr>
		<td><label for="login">Login:</label></td>
		<td><input id="login" name="login" type="text" value="<?php echo htmlspecialchars($this->login) ?>" title="Administrator login." /><span class="required">*</span></td>
	</tr>
	<tr>
		<td><label for="email">E-mail:</label></td>
		<td><input id="email" name="email" type="text" value="<?php echo htmlspecialchars($this->email) ?>" title="Administrator e-mail." /><span class="required">*</span></td>
	</tr>
	<tr>
		<td><label for="oldPassword">Old Password:</label></td>
		<td><input id="oldPassword" name="oldPassword" type="password" title="Your old administrator password." /><span class="required">*</span></td>
	</tr>
	<tr>
		<td><label for="password">New Password:</label></td>
		<td><input id="password" name="password" type="password" title="New password." /><span class="required">*</span></td>
	</tr>
	<tr>
		<td><label for="confirmPassword">Confirm Password:</label></td>
		<td><input id="confirmPassword" name="confirmPassword" type="password" title="New password confirmation." /><span class="required">*</span></td>
	</tr>
</table>

<div class="submit"><input id="update" name="update" type="submit" value="Update" /></div>

</form>

<script type="text/javascript">
$(document).ready(function() {
	var field;
	field = new LiveValidation('login', , { validMessage: window.validMessage });
	field.add(Validate.Length, { maximum: 100 });
	field.add(Validate.Presence, { failureMessage: window.failureMessage });

	field = new LiveValidation('email', , { validMessage: window.validMessage });
	field.add(Validate.Length, { maximum: 100 });
	field.add(Validate.Presence, { failureMessage: window.failureMessage });
	field.add(Validate.Email, { failureMessage: window.emailMessage });

	field = new LiveValidation('oldPassword', { validMessage: window.validMessage });
	field.add(Validate.Length, { maximum: 100 });
	field.add(Validate.Presence, { failureMessage: window.failureMessage });

	field = new LiveValidation('password', { validMessage: window.validMessage });
	field.add(Validate.Length, { maximum: 100 });
	field.add(Validate.Presence, { failureMessage: window.failureMessage });

	field = new LiveValidation('confirmPassword', { validMessage: window.validMessage });
	field.add(Validate.Length, { maximum: 100 });
	field.add(Validate.Presence, { failureMessage: failureMessage });
	field.add(Validate.Confirmation, { match: 'password', failureMessage: window.confirmFailureMessage });
});
</script>

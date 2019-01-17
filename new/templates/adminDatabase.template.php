<form action="adminDatabase.php?action=update" method="post">
<table>
	<tr>
		<td><label for="driver">Driver:</label></td>
		<td><input id="driver" name="driver" type="text" value="<?php echo htmlspecialchars($this->driver) ?>" title="Database driver. Currently only MySQL tested, other DBMS may not work." /><span class="required">*</span></td>
	</tr>
	<tr>
		<td><label for="host">Host:</label></td>
		<td><input id="host" name="host" type="text" value="<?php echo htmlspecialchars($this->host) ?>" title="Host where your database is located." /><span class="required">*</span></td>
	</tr>
	<tr>
		<td><label for="database">Database Name:</label></td>
		<td><input id="database" name="database" type="text" value="<?php echo htmlspecialchars($this->database) ?>" title="Database name." /><span class="required">*</span></td>
	</tr>
	<tr>
		<td><label for="databaseUser">Database User:</label></td>
		<td><input id="databaseUser" name="databaseUser" type="text" value="<?php echo htmlspecialchars($this->databaseUser) ?>" title="Database user. Should have SELECT, INSERT, UPDATE and DELETE privileges." /><span class="required">*</span></td>
	</tr>
	<tr>
		<td><label for="password">Database Password:</label></td>
		<td><input id="password" name="password" type="password" title="Database user password." /><span class="required">*</span></td>
	</tr>
	<tr>
		<td><label for="confirmPassword">Confirm Password:</label></td>
		<td><input id="confirmPassword" name="confirmPassword" type="password" title="Database user password confirmation." /><span class="required">*</span></td>
	</tr>
</table>

<div class="submit"><input id="update" name="update" type="submit" value="Update" /></div>

</form>

<script type="text/javascript">
$(document).ready(function() {
	var field;
	field = new LiveValidation('driver', { validMessage: window.validMessage });
	field.add(Validate.Length, { maximum: 100 });
	field.add(Validate.Presence, { failureMessage: window.failureMessage });

	field = new LiveValidation('host', { validMessage: window.validMessage });
	field.add(Validate.Length, { maximum: 100 });
	field.add(Validate.Presence, { failureMessage: window.failureMessage });

	field = new LiveValidation('database', { validMessage: window.validMessage });
	field.add(Validate.Length, { maximum: 100 });
	field.add(Validate.Presence, { failureMessage: window.failureMessage });

	field = new LiveValidation('databaseUser', { validMessage: window.validMessage });
	field.add(Validate.Length, { maximum: 100 });
	field.add(Validate.Presence, { failureMessage: window.failureMessage });

	field = new LiveValidation('password', { validMessage: window.validMessage });
	field.add(Validate.Length, { maximum: 100 });
	field.add(Validate.Presence, { failureMessage: window.failureMessage });

	field = new LiveValidation('confirmPassword', { validMessage: window.validMessage });
	field.add(Validate.Length, { maximum: 100 });
	field.add(Validate.Presence, { failureMessage: window.failureMessage });
	field.add(Validate.Confirmation, { match: 'password', failureMessage: window.confirmFailureMessage });
});
</script>

<?php echo $this->config()->get('contactUs') ?>

<form action="contactUs.php?action=send" method="post">
<table>
	<tr>
		<td><label for="name">Ihr Name:</td>
		<td><input id="name" name="name" type="text" value="<?php echo htmlspecialchars($this->name) ?>" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td><label for="email">E-Mail:</td>
		<td><input id="email" name="email" type="text" value="<?php echo htmlspecialchars($this->email) ?>" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td><label for="message">Nachricht:</td>
		<td><textarea id="message" name="message"><?php echo htmlspecialchars($this->message) ?></textarea><span class="required">*</span></td>
	</tr>
</table>

<div class="submit"><input type="submit" name="submit" value="Vorlegen" /></div>
</form>

<script type="text/javascript">
$(document).ready(function() {
	var field;
	field = new LiveValidation('name', { validMessage: window.validMessage });
	field.add(Validate.Length, { maximum: 100 });
	field.add(Validate.Presence, { failureMessage: window.failureMessage });

	field = new LiveValidation('email', { validMessage: window.validMessage });
	field.add(Validate.Length, { maximum: 100 });
	field.add(Validate.Email, { failureMessage: window.emailMessage });
	field.add(Validate.Presence, { failureMessage: window.failureMessage });

	field = new LiveValidation('message', { validMessage: window.validMessage });
	field.add(Validate.Length, { maximum: 3000 });
	field.add(Validate.Presence, { failureMessage: window.failureMessage });
});
</script>

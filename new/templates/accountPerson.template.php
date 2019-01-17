<form action="accountPerson.php?action=update" method="post">

<fieldset>
<legend>Persönliche Daten: Name und Geburtsdatum</legend>
<table>
	<tr>
		<td>Nachname:</td>
		<td><input id="lastName" name="lastName" type="text" value="<?php echo htmlspecialchars($this->lastName) ?>" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td>Vorname:</td>
		<td><input id="firstName" name="firstName" type="text" value="<?php echo htmlspecialchars($this->firstName) ?>" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td><label for="birthDate">Geb.-Datum:</label></td>
		<td><input id="birthDate" name="birthDate" type="text" size="11" readonly="readonly" value="<?php echo htmlspecialchars($this->birthDate) ?>" title="Dein Geburtstdatum bleibt unser Geheimnis - wir brauchen es trotzdem um sicherzustellen, dass Du uns anrufst, wenn Du mal Hilfe benötigst." /></td>
    </tr>
</table>
</fieldset>

<div class="submit"><input name="submit" type="submit" value="Update" /></div>

</form>

<script type="text/javascript" src="scripts/jquery.date_input-de.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#birthDate').date_input();

	field = new LiveValidation('lastName', { validMessage: window.validMessage });
	field.add(Validate.Length, { maximum: 50 });
	field.add(Validate.Presence, { failureMessage: window.failureMessage });

	field = new LiveValidation('firstName', { validMessage: window.validMessage });
	field.add(Validate.Length, { maximum: 50 });
	field.add(Validate.Presence, { failureMessage: window.failureMessage });
});
</script>

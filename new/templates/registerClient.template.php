<form action="registerClient.php?action=register" method="post">

<fieldset>
<legend>Login Info</legend>
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
		<td class="label"><label for="password">Password:</label></td>
		<td><input id="password" name="password" type="password" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td class="label"><label for="confirmPassword">Confirm Password:</label></td>
		<td><input id="confirmPassword" name="confirmPassword" type="password" /><span class="required">*</span></td>
	</tr>
</table>
</fieldset>

<fieldset>
<legend>Personal Data</legend>
<table>
	<tr>
		<td colspan="2">Anrede / Titel:</td>
		<td colspan="2"><input id="title" name="title" type="text" value="<?php echo htmlspecialchars($this->title) ?>" title="Felder mit *: Diese Angaben brauchen wir. Die anderen sind optional." /></td>
		<td colspan="3" rowspan="3">"Here should be short comment for clients who want to register..."</td>
	</tr>
	<tr>
		<td colspan="2">Nachname:</td>
		<td colspan="2"><input id="lastName" name="lastName" type="text" value="<?php echo htmlspecialchars($this->lastName) ?>" /><span class="required">*</span></td>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2">Vorname:</td>
		<td colspan="2"><input id="firstName" name="firstName" type="text" value="<?php echo htmlspecialchars($this->firstName) ?>" /><span class="required">*</span></td>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td colspan="2"><label for="land">Land:</label>
		<select id="land" name="land">
			<option>---Land---</option>
		</select><span class="required">*</span></td>
		<td><label for="zip">PLZ:</label>
		<select id="zip" name="zip">
			<option>---PLZ---</option>
		</select><span class="required">*</span></td>
		<td><label for="city">Ort:</label>
		<select id="city" name="city">
			<option>---Ort---</option>
		</select><span class="required">*</span></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2">Strasse / Nr.:</td>
		<td colspan="2"><input id="street" name="street" type="text" value="<?php echo htmlspecialchars($this->street) ?>" /><span class="required">*</span></td>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2">Adresszeile 2:</td>
		<td colspan="2"><input id="addressLine2" name="addressLine2" type="text" value="<?php echo htmlspecialchars($this->addressLine2) ?>" /></td>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2"><label for="phoneP">Tel. (p):</label></td>
		<td colspan="2"><input id="phoneP" name="phoneP" type="text" value="<?php echo htmlspecialchars($this->phoneP) ?>" title="Wir brauchen mindestens eine der Nummern - aber am besten die Handynummer. Die Nummern sind sichtbar für die Kunden. Wenn Du keine Handynummer angibst, können wir Dir Benachrichtigungen nur per Email senden - für kurzfristige Absagen ist die Handynummer also von Vorteil." /></td>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2"><label for="phoneG">Tel. (g):</label></td>
		<td colspan="2"><input id="phoneG" name="phoneG" type="text" value="<?php echo htmlspecialchars($this->phoneG) ?>" title="Wir brauchen mindestens eine der Nummern - aber am besten die Handynummer. Die Nummern sind sichtbar für die Kunden. Wenn Du keine Handynummer angibst, können wir Dir Benachrichtigungen nur per Email senden - für kurzfristige Absagen ist die Handynummer also von Vorteil." /></td>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2"><label for="phoneM">Tel. (m):</label></td>
		<td colspan="2"><input id="phoneM" name="phoneM" type="text" value="<?php echo htmlspecialchars($this->phoneM) ?>" /></td>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2"><label for="birthDate">Geb.-Datum:</label></td>
		<td colspan="2"><input id="birthDate" name="birthDate" type="text" size="11" readonly="readonly" value="<?php echo htmlspecialchars($this->birthDate) ?>" title="Dein Geburtstdatum bleibt unser Geheimnis - wir brauchen es trotzdem um sicherzustellen, dass Du uns anrufst, wenn Du mal Hilfe benötigst." /></td>
		<td colspan="3">&nbsp;</td>
    </tr>
</table>
</fieldset>

<fieldset>
<legend>Additional</legend>
<table>
	<tr>
		<td><label for="contactName">Bevorzugte Kontaktnahme:</label></td>
		<td><input id="contactName" name="contactName" type="text" value="<?php echo htmlspecialchars($this->contactName) ?>" title="Hier kannst Du wählen, wie wir Dir Nachrichten schicken - z.B.  kurzfristige Absagen von Sessions oder Seminaren." /><span class="required">*</span></td>
	</tr>
	<tr>
		<td><label for="healthInsurance">Krankenkasse:</label></td>
		<td><input id="healthInsurance" name="healthInsurance" type="text" value="<?php echo htmlspecialchars($this->healthInsurance) ?>" title="Vielleicht willst Du die Behandlungen und Seminaren Deiner Krankenkasse anmelden. Dann kannst Du sie hier eintragen.
Das kannst Du auch später wieder ändern.
Wenn Du darauf verzichtest, dann wähle &quot;Selbstzahler&quot;." /></td>
	</tr>
	<tr>
		<td><label for="newsletter">Newsletter:</label></td>
		<td><input id="newsletter" name="newsletter" type="checkbox" <?php if($this->newsletter) { echo 'checked="checked" '; } ?>title="Wenn es Neuigkeiten gibt, dann möchten wir Dir gerne darüber berichten - dürfen wir?
Du kannst das auch jederzeit wieder ausschalten." /></td>
	</tr>
</table>
</fieldset>

<div class="submit"><input name="submit" type="submit" value="Speichern und weiter zu unseren AGB" /></div>

</form>

<script type="text/javascript" src="scripts/jquery.date_input-de.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#birthDate').date_input();

	var field;
	field = new LiveValidation('login');
	field.add(Validate.Length, { maximum: 50 });
	field.add(Validate.Presence);

	var field = new LiveValidation('email');
	field.add(Validate.Length, { maximum: 100 });
	field.add(Validate.Presence);
	field.add(Validate.Email, { failureMessage: window.emailMessage });

	field = new LiveValidation('password');
	field.add(Validate.Length, { maximum: 50 });
	field.add(Validate.Presence);

	field = new LiveValidation('confirmPassword');
	field.add(Validate.Length, { maximum: 50 });
	field.add(Validate.Confirmation, { match: 'password' });
	field.add(Validate.Presence);

	field = new LiveValidation('title');
	field.add(Validate.Length, { maximum: 100 });

	field = new LiveValidation('lastName');
	field.add(Validate.Length, { maximum: 50 });
	field.add(Validate.Presence);

	field = new LiveValidation('firstName');
	field.add(Validate.Length, { maximum: 50 });
	field.add(Validate.Presence);

	field = new LiveValidation('street');
	field.add(Validate.Length, { maximum: 100 });
	field.add(Validate.Presence);

	field = new LiveValidation('addressLine2');
	field.add(Validate.Length, { maximum: 100 });

	field = new LiveValidation('land');
	field.add(Validate.Presence);

	field = new LiveValidation('zip');
	field.add(Validate.Presence);

	field = new LiveValidation('city');
	field.add(Validate.Presence);

	field = new LiveValidation('phoneP');
	field.add(Validate.Length, { maximum: 15 });

	field = new LiveValidation('phoneG');
	field.add(Validate.Length, { maximum: 15 });

	field = new LiveValidation('phoneM');
	field.add(Validate.Length, { maximum: 15 });

	field = new LiveValidation('contactName');
	field.add(Validate.Presence);
	field.add(Validate.Length, { maximum: 100 });

	field = new LiveValidation('healthInsurance');
	field.add(Validate.Length, { maximum: 100 });
});
</script>

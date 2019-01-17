<form name="registerForm" action="registerProf.php" enctype="application/x-www-form-urlencoded" method="post">

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
		<td colspan="2">Firma:</td>
		<td colspan="2"><input type="text" name="company" maxlength="50" value="<?php echo htmlspecialchars($this->company) ?>" /></td>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td class="label" colspan="2">Anrede / Titel:</td>
		<td colspan="2"><input id="title" name="title" type="text" value="<?php echo htmlspecialchars($this->title) ?>" title="Felder mit *: Diese Angaben brauchen wir. Die anderen sind optional." /></td>
		<td colspan="3" rowspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td class="label" colspan="2">Nachname:</td>
		<td colspan="2"><input id="lastName" name="lastName" type="text" value="<?php echo htmlspecialchars($this->lastName) ?>" /><span class="required">*</span></td>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td class="label" colspan="2">Vorname:</td>
		<td colspan="2"><input id="firstName" name="firstName" type="text" value="<?php echo htmlspecialchars($this->firstName) ?>" /><span class="required">*</span></td>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="label" colspan="2"><label for="land">Land:</label>
		<select id="land" name="land">
			<option>---Land---</option>
		</select><span class="required">*</span></td>
		<td class="label"><label for="zip">PLZ:</label>
		<select id="zip" name="zip">
			<option>---PLZ---</option>
		</select><span class="required">*</span></td>
		<td class="label"><label for="city">Ort:</label>
		<select id="city" name="city">
			<option>---Ort---</option>
		</select><span class="required">*</span></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class="label" colspan="2">Strasse / Nr.:</td>
		<td colspan="2"><input id="street" name="street" type="text" value="<?php echo htmlspecialchars($this->street) ?>" /><span class="required">*</span></td>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td class="label" colspan="2">Adresszeile 2:</td>
		<td colspan="2"><input id="addressLine2" name="addressLine2" type="text" value="<?php echo htmlspecialchars($this->addressLine2) ?>" /></td>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td class="label" colspan="2"><label for="phoneP">Tel. (p):</label></td>
		<td colspan="2"><input id="phoneP" name="phoneP" type="text" value="<?php echo htmlspecialchars($this->phoneP) ?>" title="Wir brauchen mindestens eine der Nummern - aber am besten die Handynummer. Die Nummern sind sichtbar für die Kunden. Wenn Du keine Handynummer angibst, können wir Dir Benachrichtigungen nur per Email senden - für kurzfristige Absagen ist die Handynummer also von Vorteil." /></td>
		<td colspan="3" rowspan="3"><h5>Wir brauchen mindestens eine der Nummern - aber am besten die Handynummer. Die Nummern sind sichtbar für die Kunden. Wenn Du keine Handynummer angibst, können wir Dir Benachrichtigungen nur per Email senden - für kurzfristige Absagen ist die Handynummer also von Vorteil.</h5></td>
	</tr>
	<tr>
		<td class="label" colspan="2"><label for="phoneG">Tel. (g):</label></td>
		<td colspan="2"><input id="phoneG" name="phoneG" type="text" value="<?php echo htmlspecialchars($this->phoneG) ?>" title="Wir brauchen mindestens eine der Nummern - aber am besten die Handynummer. Die Nummern sind sichtbar für die Kunden. Wenn Du keine Handynummer angibst, können wir Dir Benachrichtigungen nur per Email senden - für kurzfristige Absagen ist die Handynummer also von Vorteil." /></td>
	</tr>
	<tr>
		<td class="label" colspan="2"><label for="phoneM">Tel. (m):</label></td>
		<td colspan="2"><input id="phoneM" name="phoneM" type="text" value="<?php echo htmlspecialchars($this->phoneM) ?>" /></td>
	</tr>
	<tr>
		<td class="label" colspan="2"><label for="birthDate">Geb.-Datum:</label></td>
		<td colspan="2"><input id="birthDate" name="birthDate" type="text" size="11" readonly="readonly" value="<?php echo htmlspecialchars($this->birthDate) ?>" title="Dein Geburtstdatum bleibt unser Geheimnis - wir brauchen es trotzdem um sicherzustellen, dass Du uns anrufst, wenn Du mal Hilfe benötigst." /></td>
		<td colspan="3">&nbsp;</td>
    </tr>
</table>
</fieldset>

<fieldset>
<legend>Additional</legend>
<table>
	<tr>
		<td class="label">Web:</td>
		<td><input type="text" name="site" value="<?php echo htmlspecialchars($this->site) ?>" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td class="label">VAT:</td>
		<td><input type="text" name="vat" value="<?php echo htmlspecialchars($this->vat) ?>" /></td>
	</tr>
	<tr>
		<td class="label">Konkordats-nr.:</td>
		<td><input type="text" name="konkordatsNr" value="<?php echo htmlspecialchars($this->konkordatsNr) ?>" /></td>
	</tr>
	<tr>
		<td class="label">Gesundheitsk.-nr.:</td>
		<td><input type="text" name="gesundheitskNr" maxlength="50" value="<?php echo htmlspecialchars($this->gesundheitskNr) ?>" /></td>
	</tr>
	<tr>
		<td class="label">Asca-Nr.:</td>
		<td><input type="text" name="ascaNr" value="<?php echo htmlspecialchars($this->ascaNr) ?>" /></td>
	</tr>
	<tr>
		<td class="label" rowspan="2">Bild:</td>
		<td><input type="file" name="picture" /></td>
	</tr>
	<tr>
		<td><input type="file" name="picture2" /></td>
	</tr>
	<tr>
		<td class="label">Kurzbeschreibung Firma:</td>
		<td><textarea cols="50" rows="3" id="companyDescription" name="companyDescription"><?php echo htmlspecialchars($this->companyDescription) ?></textarea></td>
	</tr>
	<tr>
		<td class="label">Bevorzugte Kontaktnahme:*</td>
		<td><input type="text" id="contactName" name="contactName" value="<?php echo htmlspecialchars($this->contactName) ?>" /><span class="required">*</span></td>
	</tr>
	<tr>
		<td class="label">Rechnungs-Kopf:</td>
		<td><input type="file" id="accountNo" name="accountNo" value="<?php echo htmlspecialchars($this->accountNo) ?>" /></td>
	</tr>
	<tr>
		<td class="label">Rechnungs-Fusszeile:</td>
		<td><input type="file" id="additionalNo" name="additionalNo" value="<?php echo htmlspecialchars($this->additionalNo) ?>" /></td>
	</tr>  
	<tr>
		<td class="label">Newsletter:</td>
		<td><input type="checkbox" id="newsletter" name="newsletter" <?php if($this->newsletter) { echo 'checked="checked"'; } ?>/></td>
	</tr>  
</table>
</fieldset>

<div class="submit"><input id="submit" name="submit" type="submit" value="Submit" /></div>

</form>

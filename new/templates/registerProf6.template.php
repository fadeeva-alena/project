<form id="registerForm" name="registerForm" action="registerProf7.php" enctype="application/x-www-form-urlencoded" method="post">

<table>
<thead>
	<tr>
		<th>Bezeichnung</th>
		<th>Ausdruck Tagesplan</th>
		<th>Sitzungen Verwalten</th>
		<th>Seminaren verwalten</th>
		<th>Monatliche Liste Klienten u. Sitzungen</th>
		<th>Rechnungen Ausdrucken</th>
		<th>Zahlungseingänge</th>
		<th>Preis/Monat</th>
	</tr>
</thead>
<tbody>
	<tr>
		<td>Einfach</td>
		<td><input name="checkbox" type="checkbox" value="checkbox" checked="checked" /></td>
		<td><input name="checkbox2" type="checkbox" value="checkbox" checked="checked" /></td>
		<td><input type="checkbox" name="checkbox3" value="checkbox" /></td>
		<td><input type="checkbox" name="checkbox4" value="checkbox" /></td>
		<td><input type="checkbox" name="checkbox5" value="checkbox" /></td>
		<td><input type="checkbox" name="checkbox6" value="checkbox" /></td>
		<td>1 Fr.</td>
	</tr>
	<tr>
		<td>Einfach mit Seminaren</td>
		<td><input name="checkbox" type="checkbox" value="checkbox" checked="checked" /></td>
		<td><input name="checkbox2" type="checkbox" value="checkbox" checked="checked" /></td>
		<td><input name="checkbox3" type="checkbox" value="checkbox" checked="checked" /></td>
		<td><input type="checkbox" name="checkbox4" value="checkbox" /></td>
		<td><input type="checkbox" name="checkbox5" value="checkbox" /></td>
		<td><input type="checkbox" name="checkbox6" value="checkbox" /></td>
		<td>2 Fr.</td>
	</tr>
	<tr>
		<td>Fortgeschritten</td>
		<td><input name="checkbox" type="checkbox" value="checkbox"  checked="checked" /></td>
		<td><input name="checkbox2" type="checkbox" value="checkbox" checked="checked" /></td>
		<td><input type="checkbox" name="checkbox3" value="checkbox" /></td>
		<td><input name="checkbox4" type="checkbox" value="checkbox" checked="checked" /></td>
		<td><input name="checkbox5" type="checkbox" value="checkbox" checked="checked" /></td>
		<td><input type="checkbox" name="checkbox6" value="checkbox" /></td>
		<td>3 Fr.</td>
	</tr>
	<tr>
		<td>Fortgeschritten mit Seminaren</td>
		<td class="grey"><input name="checkbox" type="checkbox" value="checkbox" checked="checked" /></td>
		<td class="grey"><input name="checkbox2" type="checkbox" value="checkbox" checked="checked" /></td>
		<td class="grey"><input name="checkbox3" type="checkbox" value="checkbox" checked="checked" /></td>
		<td class="grey"><input name="checkbox4" type="checkbox" value="checkbox" checked="checked" /></td>
		<td class="grey"><input type="checkbox" name="checkbox5" value="checkbox" checked="checked" /></td>
		<td class="grey"><input type="checkbox" name="checkbox6" value="checkbox" /></td>
		<td class="grey">4 Fr.</td>
	</tr>
	<tr>
		<td>Professionell</td>
		<td><input name="checkbox" type="checkbox" value="checkbox" checked="checked" /></td>
		<td><input name="checkbox22" type="checkbox" value="checkbox" checked="checked" /></td>
		<td><input type="checkbox" name="checkbox3" value="checkbox" /></td>
		<td><input name="checkbox4" type="checkbox" value="checkbox" checked="checked" /></td>
		<td><input name="checkbox5" type="checkbox" value="checkbox" checked="checked" /></td>
		<td><input type="checkbox" name="checkbox6" value="checkbox" /></td>
		<td>5 Fr.</td>
	</tr>
	<tr>
		<td>Professionell - mit Seminaren</td>
		<td><input name="checkbox" type="checkbox" value="checkbox"  checked="checked" /></td>
		<td><input name="checkbox2" type="checkbox" value="checkbox" checked="checked" /></td>
		<td><input name="checkbox3" type="checkbox" value="checkbox" checked="checked" /></td>
		<td><input name="checkbox4" type="checkbox" value="checkbox" checked="checked" /></td>
		<td><input name="checkbox5" type="checkbox" value="checkbox" checked="checked" /></td>
		<td><input type="checkbox" name="checkbox6" value="checkbox" /></td>
		<td>6 Fr.</td>
	</tr>
	<tr>
		<td>Professionell +</td>
		<td><input name="checkbox8" type="checkbox" value="checkbox" checked="checked" /></td>
		<td><input name="checkbox2" type="checkbox" value="checkbox" checked="checked" /></td>
		<td><input type="checkbox" name="checkbox3" value="checkbox" /></td>
		<td><input name="checkbox4" type="checkbox" value="checkbox" checked="checked" /></td>
		<td><input name="checkbox5" type="checkbox" value="checkbox" checked="checked" /></td>
		<td><input name="checkbox6" type="checkbox" value="checkbox" checked="checked" /></td>
		<td>7 Fr.</td>
	</tr>
	<tr>
		<td>Professionell + mit Seminaren</td>
		<td><input name="checkbox8" type="checkbox" checked="checked" /></td>
		<td><input name="checkbox2" type="checkbox" checked="checked" /></td>
		<td><input type="checkbox" name="checkbox3" checked="checked" /></td>
		<td><input name="checkbox4" type="checkbox" checked="checked" /></td>
		<td><input name="checkbox5" type="checkbox" checked="checked" /></td>
		<td><input name="checkbox6" type="checkbox" checked="checked" /></td>
		<td>8 Fr.</td>
	</tr>
</tbody>
</table>

<table>
	<tr>
		<td>Zahlungsmethode:</td>
		<td><select name="select2">
			<option>-Zahlungsmethode-</option>
		</select></td>
		<td>Ablaufdatum:</td>
		<td><input name="textfield" type="text" size="15" /></td>
	</tr>
	<tr>
		<td>Kreditkartennr:</td>
		<td><input name="textfield3" type="text" size="20" /></td>
		<td>CCV-Code:</td>
		<td><input name="textfield2" type="text" size="15" /></td>
	</tr>
	<tr>
		<td>Name wie auf der Kreditkarte:</td>
		<td><input name="textfield32" type="text" size="20" /></td>
		<td colspan="2">&nbsp;</td>
	</tr>
</table>

<div class="submit"><input type="submit" name="submit" value="Speichern und weiter zu den Geschäftsbedingungen" /></div>

</form>

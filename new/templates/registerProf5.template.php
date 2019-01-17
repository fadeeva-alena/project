<form id="registerForm" name="registerForm" action="registerProf6.php" enctype="application/x-www-form-urlencoded" method="post">

<table>
<tbody>
	<tr>
		<td>Seminar-Titel*:</td>
		<td colspan="3"><input type="text" name="textfield" class="inputtxt" title="Titel: z.B. Familienstellen" /></td>
	</tr>
	<tr>
		<td>Untertitel:</td>
		<td colspan="3"><input type="text" name="textfield3" class="inputtxt" title="Untertitel: Ein Satz - das ist optional." /></td>
	</tr>
	<tr>
		<td>Seminar-Beschreibung</td>
		<td colspan="3"><textarea name="textarea" rows="6" class="inputtxt" title="Seminar-Beschreibung: Hier kannst Du etwas ausführlicher beschreiben, was Deine Teilnehmenden erwarten können."></textarea></td>
	</tr>
	<tr>
		<td>Startdatum*:</td>
		<td><input name="textfield2" type="text" size="10" title="Startdatum: Wann beginnt das Seminar?" /></td>
		<td>Beginn um*:</td>
		<td><input name="textfield23" type="text" size="10" title="Beginn um: Wann beginnt Ihr?"/></td>
	</tr>
	<tr>
		<td>Enddatum*:</td>
		<td><input name="textfield22" type="text" size="10" title="Enddatum: Wann endet das Seminar?"/></td>
		<td>Abschluss um*:</td>
		<td><input name="textfield24" type="text" size="10" title="Abschluss um: Wann (Uhrzeit) ist das Seminar zu Ende?"/></td>
	</tr>
	<tr>
		<td colspan="4">Diese Bedingungen müssen Teilnehmer erfüllen:</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td colspan="3"><input type="text" name="textfield32"  class="inputtxt"  title="Bedingungen Teilnehmer: 
Vielleicht müssen Deine Teilnehmer Vorerfahrungen haben. Oder schon andere Seminare besucht haben. Hier kannst Du das eintragen."/></td>
	</tr>
	<tr>
		<td colspan="4">Bemerkungen zur Unterkunft:</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td colspan="3"><textarea name="textarea2" rows="3" class="inputtxt" title="Bemerkungen zur Unterkunft:
Buchen die Teilnehmer selbst eine Unterkunft? Oder ist die Unterkunft in der Buchung inbegriffen?"></textarea></td>
	</tr>
	<tr>
		<td>Seminarzeiten:</td>
		<td colspan="3"><input type="text" name="textfield322" class="inputtxt" title="Seminarzeiten:
Hier kannst Du die Seminarzeiten beschreiben - das ist optional." /></td>
	</tr>
	<tr>
		<td>Über die Leitung:</td>
		<td colspan="3"><table>
          <tr>
            <td width="51%" rowspan="2"><textarea name="textarea3" cols="25" rows="8" title="Über die Leitung:
Hier kannst Du die Leitung beschreiben - Qualifikationen vielleicht. Vorerfahrung. Solche Dinge. 
Und Du kannst ein Bild hinterlegen."></textarea></td>
            <td width="49%" height="25">Leitung:</td>
          </tr>
          <tr>
            <td><select name="select" size="6">
                <option>---------</option>
              </select>
            </td>
          </tr>
      </table></td>
    </tr>
	<tr>
		<td>Preis*:</td>
		<td colspan="3"><input name="textfield4" type="text" size="8" title="Preis:
Was kostet die Teilnahme? Falls Du MwSt-pflichtig bist: Der Preis inkl. MwSt - so wie der Buchende ihn bezahlt."/> Fr.</td>
	</tr>
	<tr>
		<td>Zertifikat:</td>
		<td colspan="3"><input type="text" name="textfield3222"  class="inputtxt" title="Zertifikat:
Wenn Teilnehmende Zertifikate erhalten, kannst Du das hier erwähnen."/></td>
	</tr>
	<tr>
		<td>Bei einer Absage bis</td>
		<td colspan="3"><table>
          <tr>
            <td width="28"><input name="textfield43" type="text" size="4" title="Bei einer Absage bis"  /></td>
            <td width="279">Tage vor Seminarbeginn kostet die Absage: </td>
            <td width="33"><input name="textfield432" type="text" size="4" title="Tage vor Seminarbeginn kostet die Absage: " /></td>
            <td width="146">Fr.</td>
          </tr>
		</table></td>
	</tr>
	<tr>
		<td>Bei einer Absage bis</td>
		<td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="28"><input name="textfield433" type="text" size="4" title="Bei einer Absage bis" /></td>
            <td width="278">Tage vor Seminarbeginn kostet die Absage: </td>
            <td width="36"><input name="textfield4322" type="text" size="4" title="Tage vor Seminarbeginn kostet die Absage:" /></td>
            <td width="144">Fr.</td>
          </tr>
		</table></td>
	</tr>
	<tr>
		<td>Max. Anz. Teilnehmer:</td>
		<td colspan="3"><input name="textfield42" type="text" size="8"  title="Absagefristen und Kostenfolgen:
Hier kannst Du 2 Stufen definieren. 
So kann eine Absage später als 10 Tage vor Beginn z.B. 50 Fr. Bearbeitungskosten generieren. 
Oder eine Absage weniger als 3 Tage vorher zur vollen Kostenfolge führen."/></td>
	</tr>
</tbody>
</table>

<div class="submit"><input type="submit" name="submit" value="Submit" /></div>

</form>

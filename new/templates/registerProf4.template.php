<form id="registerForm" name="registerForm" action="registerProf5.php" enctype="application/x-www-form-urlencoded" method="post">

<table>
<thead>
	<tr>
		<th>Name*:</th>
		<th>Dauer*:</th>
		<th>Pause:</th>
		<th>Farbe*:</th>
		<th>Absagefrist:</th>
		<th>Preis*:</th>
	</tr>
</thead>
<tbody>
	<tr>
		<td><input type="text" title="Name: (z.B. Ayurveda-Massage)" size="14" /></td>
		<td><input type="text" title="Dauer: (Falls eine Sitzung z.B. 30 oder 60min lang sein kann, dann mach für jede Dauer eine Zeile." size="6" />min</td>
		<td><input type="text" title="Pause: Falls Du nach der SItzung eine Pause brauchst - für Dich oder zum Nach-/Vorbereiten" size="6" />min</td>
		<td><select title="Farbe: Jede Sitzung hat eine eigene Farbe - hier kannst Du sie wählen.">
			<option>Hellrot</option>
			<option>Dunkelrot</option>
			<option>Hellblau</option>
			<option>Dunkelblau</option>
			<option>Hellgrün</option>
			<option>Dunkelgrün</option>
			<option>Violett</option>
			<option>Grau</option>
		</select></td>
		<td><input type="text" title="Absagefrist: Ab dieser Anzahl Stunden Absage vor der Sitzung wird der volle Betrag fällig.." size="6" /> Std.</td>
		<td><input type="text" title="Preis: Der Preis einer Sitzung - falls Du MwSt. bezahlen musst: inkl. MwSt." size="6" /> Fr.</td>
	</tr>
	<tr>
		<td colspan="6">Genauere Beschreibung dieser Sitzung:</td>
	</tr>
	<tr>
		<td colspan="4"><textarea title="Beschreibung: Ein kurzer Text, damit Dein Kunde weiss, was er bucht." cols="50" rows="4"></textarea></td>
		<td>&nbsp;</td>
		<td><input type="button" value="Neue Sitzung" /></td>
	</tr>
</tbody>
</table>

<div class="submit"><input type="submit" name="submit" value="Speichern und weiter zum Hinterlegen von Seminaren" /></div>

</form>

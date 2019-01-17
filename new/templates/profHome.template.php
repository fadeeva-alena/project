<div class="panel">
	<h4>Konto</h4>
	<h5>Manage account settings.</h5>
	<ul>
		<li><a href="accountPerson.php">Persönliche Daten</a> <?php if(!$this->user()->personId) echo '<span class="important">EMPTY!</span>' ?></li>
		<li><a href="accountAddress.php">Adresse</a> <?php if(!$this->user()->addressId) echo '<span class="important">EMPTY!</span>' ?></li>
		<li><a href="removeAccount.php" style="color: #F00">[Remove account - TESTING]</a></li>
	</ul>
</div>

<table>
	<tr>
		<td><a href="profSettings.php">Einstellungen</a></td>
		<td><a href="profTasks.php">Aufgaben</a></td>
		<td><a href="profDownloads.php">Drucken und Downloads</a></td>
		<td><a href="profRejects.php">Abo-kündigen</a></td>
	</tr>
</table>

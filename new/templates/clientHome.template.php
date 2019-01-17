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
		<td><a href="clientSettings.php">Einstellungen</a></td>
		<td><a href="clientOrders.php">Sitzungen buchen</a></td>
		<td><a href="clientSeminars.php">Seminar buchen</a></td>
		<td><a href="clientRejects.php">Abo-kündigen</a></td>
	</tr>
</table>

<?php $ips = IpDAC::getInstance()->get(); if($ips) { ?>
<table>
<thead>
	<tr>
		<th>IP</th>
		<th>Status</th>
		<th>Actions</th>
	</tr>
</thead>
<tbody>
	<?php foreach($ips as $ip) { ?>
	<tr>
		<td><?php echo htmlspecialchars($ip->getIp()) ?></td>
		<td><?php echo ($ip->isBlocked)? 'Locked': 'Normal' ?></td>
		<td>
			<a href="adminIps.php?action=<?php echo ($ip->isBlocked)? 'unlock': 'lock' ?>&id=<?php echo htmlspecialchars($ip->id) ?>"><?php echo ($ip->isBlocked)? 'Unlock': 'Lock' ?></a> |
			<a href="adminIps.php?action=remove&id=<?php echo htmlspecialchars($ip->id) ?>">Remove</a>
		</td>
	</tr>
	<?php } ?>
</tbody>
</table>
<?php } ?>

<fieldset>
<legend>Lock IP</legend>
<form action="adminIps.php?action=add" method="post">
<table>
	<tr>
		<td class="label"><label for="ipAddress">IP Address:</label></td>
		<td><input id="ipAddress" name="ipAddress" type="text" value="<?php echo htmlspecialchars($this->ipAddress) ?>" title="IP address, in <xxx.xxx.xxx.xxx> format." /><span class="required">*</span></td>
	</tr>
</table>

<div class="submit"><input id="store" name="store" type="submit" value="Store" /></div>

</form>
</fieldset>

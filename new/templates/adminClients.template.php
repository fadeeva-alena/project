<table>
<thead>
	<tr>
		<th>Login</th>
		<th>Title</th>
		<th>Land / City</th>
		<th>Actions</th>
	</tr>
</thead>
<tbody>
	<?php foreach($this->clientHash as $clientId => $client) { ?>
	<tr>
		<td><a href="adminClientInfo.php?id=<?php echo htmlspecialchars($clientId) ?>"><?php echo htmlspecialchars($client->user->login) ?></a></td>
		<td><?php echo htmlspecialchars($client->title) ?></td>
		<td><?php echo htmlspecialchars($client->address->land . ' / ' . $client->address->city) ?></td>
		<td>
			<a href="adminClients.php?action=<?php echo ($client->user->isHold)? 'unhold': 'hold' ?>&id=<?php echo htmlspecialchars($clientId) ?>"><?php echo ($client->user->isHold)? 'Unhold': 'Hold' ?></a> |
			<a href="adminClients.php?action=remove&id=<?php echo htmlspecialchars($clientId) ?>">Remove</a>
		</td>
	</tr>
	<?php } ?>
</tbody>
</table>

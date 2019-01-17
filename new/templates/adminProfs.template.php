<table>
<thead>
	<tr>
		<th>Login<th>
		<th>Title<th>
		<th>Company<th>
		<th>Land<th>
		<th>Actions<th>
	</tr>
</thead>
<tbody>
	<?php foreach($this->profHash as $profId => $prof) { ?>
	<tr>
		<td><a href="adminProfInfo.php?id=<?php echo htmlspecialchars($profId) ?>"><?php echo htmlspecialchars($prof->login) ?></a></td>
		<td><?php echo htmlspecialchars($prof->title) ?></td>
		<td><?php echo htmlspecialchars($prof->company) ?></td>
		<td><?php echo htmlspecialchars($prof->address->land) ?></td>
		<td>
			<a href="adminProfs.php?action=<?php echo ($prof->isHold)? 'unhold': 'hold' ?>&id=<?php echo htmlspecialchars($profId) ?>"><?php echo ($prof->isHold)? 'Unhold': 'Hold' ?></a> |
			<a href="adminProfs.php?action=remove&id=<?php echo htmlspecialchars($profId) ?>">Remove</a>
		</td>
	</tr>
	<?php } ?>
</tbody>
</table>

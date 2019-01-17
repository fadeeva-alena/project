<form action="adminEmailsRegisterProf.php?action=update" method="post">
<table>
	<tr>
		<td><label for="subject">Subject:</label></td>
		<td><input id="subject" name="subject" value="<?php echo htmlspecialchars($this->subject) ?>" size="40" /><span class="required">*</span></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><label for="css">CSS:</label></td>
		<td colspan="2"><textarea id="css" name="css" rows="7" cols="72"><?php echo $this->css ?></textarea></td>
	</tr>
	<tr>
		<td><label for="body">Body:</label></td>
		<td><textarea id="body" name="body" rows="15" cols="59"><?php echo $this->body ?></textarea><span class="required">*</span></td>
		<td>
			Variables:
			<ul>
				<li><b>{email}</b></li>
				<li><b>{date}</b></li>
				<li><b>{login}</b></li>
				<li><b>{password}</b></li>
				<li><b>{code}</b></li>
			</ul>
		</td>
	</tr>
</table>

<div class="submit"><input id="update" name="update" type="submit" value="Update" /></div>

</form>

<h5>Some additional information. Confirmation link should look like &lt;a href=&quot;http://somewhere.com/confirm.php?code={code}&quot;&gt;here&lt;/a&gt;,
Registration / subscription reject link should look like &lt;a href=&quot;http://somewhere.com/confirm.php?action=reject&amp;code={code}&quot;&gt;this link&lt;/a&gt;</h5>

<script type="text/javascript">
$(document).ready(function() {
	var field;
	field = new LiveValidation('subject', { validMessage: window.validMessage });
	field.add(Validate.Length, { maximum: 100 });
	field.add(Validate.Presence, { failureMessage: window.failureMessage });

	field = new LiveValidation('body', { validMessage: window.validMessage });
	field.add(Validate.Presence, { failureMessage: window.failureMessage });
});
</script>

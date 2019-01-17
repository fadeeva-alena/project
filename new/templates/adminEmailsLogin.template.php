<form action="adminEmailsLogin.php?action=update" method="post">
<table>
	<tr>
		<td><label for="subject">Subject:</label></td>
		<td><input id="subject" name="subject" value="<?php echo htmlspecialchars($this->subject) ?>" size="40" title="No tags and other special chars here; they all be removed. Only text here please." /><span class="required">*</span></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><label for="css">CSS:</label></td>
		<td colspan="2"><textarea id="css" name="css" rows="7" cols="72" title="No tags here, only clean CSS with no background images and other external things."><?php echo $this->css ?></textarea></td>
	</tr>
	<tr>
		<td><label for="body">Body:</label></td>
		<td><textarea id="body" name="body" rows="15" cols="59" title="No <html>, <body>, <script> etc. Only clean XHTML (strict or transitional) as like between <body> and </body>. All XHTML headers will be added when sending mails."><?php echo $this->body ?></textarea><span class="required">*</span></td>
		<td>
			Variables:
			<ul>
				<li><b>{email}</b></li>
				<li><b>{login}</b></li>
				<li><b>{date}</b></li>
			</ul>
		</td>
	</tr>
</table>

<div class="submit"><input id="update" name="update" type="submit" value="Update" /></div>

</form>

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

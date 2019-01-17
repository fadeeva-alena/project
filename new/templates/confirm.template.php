<p>
<?php if(!$this->hasErrors()) { ?>
	<?php if('reject' == $this->action()) { ?>
	Your registration information removed.
	<?php } else { ?>
	Congratulations! You completed registration process. You can <a href="login.php">log in</a> now to access your account.
	<?php } ?>
<?php } ?>
</p>

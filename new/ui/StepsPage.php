<?php

require_once('Page.php');

class StepsPage
	extends Page
{

	public function __construct($title, $subtitle = null, $description = null, $roleId = RoleEntity::ROLE_VISITOR) {
		parent::__construct($title, $subtitle, $description, $roleId);
	}

	protected function getStepsCount() {
		return 0;
	}

	protected function getStep() {
		return null;
	}

	protected function renderNavigation() {
		if(is_null($this->getStep())) {
			return;
		} ?>
		<ul class="steps">
			<?php for($i = 1; $i <= $this->getStepsCount(); $i++) { ?>
			<li<?php echo ($this->getStep() == $i)? ' class="selected"': '' ?>><?php echo $i ?></li>
			<?php if($i != $this->getStepsCount()) { ?><li class="divider">&raquo;</li><?php } ?>
			<?php } ?>
		</ul>
<?php
	}

}

?>
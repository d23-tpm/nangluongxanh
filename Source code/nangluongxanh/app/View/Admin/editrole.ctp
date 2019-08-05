
<div class="users editrole form-admin form">
		<?php echo $this->Form->create('Role'); ?>
		<h3>Thay Đổi Thông Tin Quyền</h3>
		<?php
		echo $this->Form->input('role_name',array('label' => 'Quyền','required'=>'required'));
		echo $this->Form->end(__('Lưu')); ?>
</div>



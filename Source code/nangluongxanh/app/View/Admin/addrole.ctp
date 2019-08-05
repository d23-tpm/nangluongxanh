
<div class="users addrole form-admin form">
		<?php echo $this->Form->create('Role'); ?>
		<h3>Thêm Quyền</h3>
		<?php echo $this->Form->input('role_name',array('label' => 'Quyền','required'=>'required'));
		echo $this->Form->end(__('Lưu')); ?>
</div>



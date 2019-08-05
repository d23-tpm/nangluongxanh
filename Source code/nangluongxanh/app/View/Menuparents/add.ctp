
<div class="users add-menu-parent form-admin form">
		<?php echo $this->Form->create('Menuparent'); ?>
		<h3>Thêm Menu Cấp 1</h3>
		<?php echo $this->Form->input('menuname',array('label' => 'Tên Menu','required'=>'required'));
		echo $this->Form->input('icon',array('label' => 'Icon','required'=>'required'));
		echo $this->Form->end(__('Lưu')); ?>
</div>



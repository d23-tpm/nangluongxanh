
<div class="users editstatus form-admin form">
		<?php echo $this->Form->create('Status'); ?>
		<h3>Thay Đổi Thông Tin Trạng Thái</h3>
		<?php
		echo $this->Form->input('name_status',array('label' => 'Tên Trạng Thái','required'=>'required'));
		echo $this->Form->input('type_status',array('label' => 'Loại Trạng Thái','required'=>'required'));
		echo $this->Form->end(__('Lưu')); ?>
</div>



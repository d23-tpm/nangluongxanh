
<div class="users edithsx form-admin form">
		<?php echo $this->Form->create('Hangsx'); ?>
		<h3>Thay Đổi Thông Tin Hãng Sản Xuất</h3>
		<?php
		echo $this->Form->input('MaHangSX',array('label' => 'Mã HSX','required'=>'required'));
		echo $this->Form->input('TenHangSX',array('label' => 'Tên HSX','required'=>'required'));
		echo $this->Form->input('XuatXu',array('label' => 'Xuất Xứ','required'=>'required'));
		echo $this->Form->end(__('Lưu')); ?>
</div>



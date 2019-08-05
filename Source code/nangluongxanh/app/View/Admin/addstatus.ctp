
<div class="users addstatus form-admin form">
		<?php echo $this->Form->create('Status'); ?>
		<h3>Nhập Trạng Thái</h3>
		<?php echo $this->Form->input('name_status',array('label' => 'Tên Trạng Thái','required'=>'required'));
		echo $this->Form->input('type_status',array('options' =>array('trang thai user'=>'Trạng thái user','trang thai don hang'=>'Trạng thái đơn hàng','trang thai san pham'=>'Trạng thái sản phẩm'),'label' => 'Loại Trạng Thái'));
		echo $this->Form->end(__('Lưu')); ?>
</div>



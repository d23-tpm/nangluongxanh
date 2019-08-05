<div class="row">
	<div class="users form col-md-6 col-md-offset-3">
		<?php echo $this->Form->create('User'); ?>
		<h3>Thay Đổi Thông Tin Cá Nhân</h3>
		<?php echo $this->Form->input('fullname',array('label' => 'Họ Tên','required'=>'required'));
		echo $this->Form->input('sex',array('options' =>array('nam'=>'Nam','nu'=>'Nữ'),'label' => 'Giới Tính'));
		echo $this->Form->input('birthday',
			array(
				'class'=>'datepicker',
				'type'=>'text',
				'label' => 'Ngày Sinh',
				'required'=>'required'
				)
			);
		echo $this->Form->input('address',array('label' => 'Địa Chỉ','required'=>'required'));
		echo $this->Form->input('numberphone',array('label' => 'Số Điện Thoại','required'=>'required'));
		echo $this->Form->input('email',array('label'=>'Email','type'=>'email','required'=>'required'));
		echo $this->Form->end(__('Lưu')); ?>
	</div>
</div>

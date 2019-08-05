<div class="row">
	<div class="users form col-md-6 col-md-offset-3">
		<?php echo $this->Form->create('User'); ?>
		<h3>Đăng Ký</h3>
		<?php echo $this->Form->input('fullname',array('label' => 'Họ Tên <span style="margin-left:15px;color:red;">*</span>','required'=>'required'));
		echo $this->Form->input('sex',array('options' =>array('nam'=>'Nam','nu'=>'Nữ'),'label' => 'Giới Tính <span style="margin-left:15px;color:red;">*</span>'));
		echo $this->Form->input('birthday',
			array(
				'class'=>'datepicker',
				'type'=>'text',
				'label' => 'Ngày Sinh',
				'required'=>'required'
				)
			);
		echo $this->Form->input('address',array('label' => 'Địa Chỉ <span style="margin-left:15px;color:red;">*</span>','required'=>'required'));
		echo $this->Form->input('numberphone',array('label' => 'Số Điện Thoại <span style="margin-left:15px;color:red;">*</span>','required'=>'required'));
		echo $this->Form->input('email',array('label'=>'Email <span style="margin-left:15px;color:red;">*</span>','type'=>'email','required'=>'required'));
		echo $this->Form->input('username',array('label' => 'Tên Đăng Nhập <span style="margin-left:15px;color:red;">*</span>','required'=>'required'));
		echo $this->Form->input('password',array('label' => 'Mật Khẩu <span style="margin-left:15px;color:red;">*</span>','required'=>'required'));
		echo $this->Form->input('config-pass',array('label' => 'Nhập Lại Mật Khẩu <span style="margin-left:15px;color:red;">*</span>','required'=>'required','type'=>'password'));
		echo $this->Form->end(__('Đăng Ký')); ?>
	</div>
</div>

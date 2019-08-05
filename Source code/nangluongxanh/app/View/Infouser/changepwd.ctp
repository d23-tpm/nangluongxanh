<div class="row">
	<div class="users form col-md-6 col-md-offset-3">
		<?php echo $this->Form->create('User'); ?>
		<h3>Đổi Mật Khẩu</h3>
		<?php
		echo $this->Form->input('password',array('label' => 'Mật Khẩu Cũ','required'=>'required'));
		echo $this->Form->input('password-new',array('label' => 'Mật Khẩu Mới','required'=>'required','type'=>'password'));
		echo $this->Form->input('config-pass',array('label' => 'Nhập Lại Mật Khẩu','required'=>'required','type'=>'password'));
		echo $this->Form->end(__('Lưu')); ?>
	</div>
</div>

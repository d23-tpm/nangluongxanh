<div class="row">
	<div id="login" class="users form col-md-6 col-md-offset-3">
		<?php echo $this->Session->flash('auth'); ?>
		<?php echo $this->Form->create('User'); ?>
		<h3>Đăng Nhập</h3>	
		<?php echo $this->Form->input('username',array('label' => 'Tên Đăng Nhập <span style="margin-left:15px;color:red;">*</span>'));
		echo $this->Form->input('password',array('label' => 'Mật Khẩu <span style="margin-left:15px;color:red;">*</span>'));
		?>

		<?php echo $this->Form->end(__('Đăng Nhập ')); ?>
	</div>
</div>
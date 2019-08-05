<div class="users editparents product form-admin form">
	<?php echo $this->Form->create('Menuparent'); ?>
	<h3>Cập Nhật Menu Cấp 1</h3>

	<?php 
	echo $this->Form->input('menuname',array('label' => 'Tên Menu','required'=>'required'));
    echo $this->Form->input('icon',array('label' => 'Icon','required'=>'required'));
	?>
	<div class="status-menu">
	<?php
	$options = array('2' => 'Deactive', '1' => 'Active');
	$attributes = array('legend' => false);
	echo $this->Form->radio('status',$options, $attributes);
	?>
	</div>
	<?php
	echo $this->Form->end('Lưu');
	?>
</div>




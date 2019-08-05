<div class="users replycontact contact form-admin form">
	<?php echo $this->Form->create('Contact'); ?>
	<h3>Phản Hồi Liên Hệ</h3>
	

	<?php 
	echo $this->Form->input('email',array('label' => 'To','required'=>'required','readonly'=>'readonly'));
    echo $this->Form->input('messagereply', array('rows' => '5','label'=>'Nội dung','required'=>'required'));
	?>
	<?php
	echo $this->Form->end('Gửi');
	?>
</div>




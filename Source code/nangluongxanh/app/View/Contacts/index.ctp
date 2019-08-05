<div class="row">
	<div class="users form col-md-10 col-md-offset-1 contact">
	<h3>Liên Hệ</h3>
		<?php
		echo $this->Form->create('Contact');
		echo $this->Form->input('name',array('label' => 'Họ & tên','required' =>'required'));
		echo $this->Form->input('email',array('label' => 'Email','required' =>'required','value'=>$getemail,'disabled' => 'disabled'));
		echo $this->Form->input('message', array('rows' => '5','label'=>'Nội dung','required'=>'required'));
		echo $this->Form->end('Gửi');

		?>
	</div>
</div>	
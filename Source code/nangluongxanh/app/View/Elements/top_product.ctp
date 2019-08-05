<div class="slide-top-product">
	<?php
	foreach ($list_product as $key) {
		echo '<div class="slide">';
		echo $this->Html->image('uploads/products/'.$key['JProduct']['HinhAnh1'],
			array('style'=>'width:auto;height:180px;'));
		echo '<h3>'.$this->Html->link(
			$key['JProduct']['TenPhone'],
			array('action' => 'view', $key['JProduct']['id']),
			array('class'=>'title-sp'));'</h3>';
		echo '<span>'.number_format($key['JProduct']['GiaBan']).' VNĐ</span>';	 
        echo '</div>';
	}
	?>
</div>
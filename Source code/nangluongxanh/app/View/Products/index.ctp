<div id="block_products" class="product_list grid row blocknewproducts tab-pane active">
	

	<?php foreach ($fillernsx as $product): ?>
		<div class="row-product col-xs-12 col-sm-6 col-md-4">
			<div class="product-container">
				<div class="left-block">
					<?php
					echo '<div class="image-sp" style="text-align: center;">'.$this->Html->image('uploads/products/'.$product['Product']['HinhAnh1'], array('alt'=> __('image product', true), 'style'=>'height:210px;','border' => '0')).'</div>';
					if($product['Product']['status_id']==1)
						echo '<span class="status-pro status-pro-new">New</span>';
					else if($product['Product']['SoLuong']==0){
						echo '<span class="status-pro status-pro-het">Hết Hàng</span>';
					}
					if($product['Product']['GiamGia']>0){
						echo '<span class="giamgia">&#45;'.$product['Product']['GiamGia'].'&#37;</span>';
					}
					if($product['Product']['Description_CauHinh']!=null)
						echo $this->Html->link('<span class="description_ch">'.$product['Product']['Description_CauHinh'].'</span>',array('action' => 'view', $product['Product']['id']),array('escape'=>false));    
					?>
				</div>
				<div class="right-block">
					<?php
					echo $this->Html->link(
						$product['Product']['TenPhone'],
						array('action' => 'view', $product['Product']['id']),
						array('class'=>'title-sp'));
					$dongia = number_format($product['Product']['GiaBan']);
					echo '<div class="dongia">'.$dongia.'<span> VNĐ</span></div>';
					echo $this->Html->link('',array('action' => 'view', $product['Product']['id']),array('class'=>'btn-more'));
					//echo $this->Form->submit('Add to Cart',array('class'=>'add-to-card'));
					echo $this->Form->create('Cart',array('id'=>'add-form','class'=>'add-product-form','url'=>array('controller'=>'carts','action'=>'add')));
					echo $this->Form->hidden('product_id',array('value'=>$product['Product']['id']));
					echo $this->Form->submit('Mua Hàng',array('class'=>'add-to-card'));
					
					echo $this->Form->end();
					?>
				</div>
			</div>
		</div>
	<?php endforeach; ?>	
</div>
<div id="success">Sản phẩm đã được thêm vào giỏ hàng</div>
<script>
	$(document).ready(function(){
		
		$('.add-product-form').submit(function(e){
		
			e.preventDefault();
			var tis = $(this);
			$.post(tis.attr('action'),tis.serialize(),function(data){
				$('#cart-counter').text(data);
			});
		});
	});
</script>

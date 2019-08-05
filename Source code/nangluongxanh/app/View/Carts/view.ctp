<?php echo $this->Form->create('Cart',array('url'=>array('action'=>'update')));?>
<div class="row">
    <h3>Thông Tin Giỏ Hàng</h3>
	<div class="col-lg-12">
		<table class="table info-shopping-cart">
			<thead>
				<tr>
                    <th>Hình Ảnh</th>
					<th>Tên Sản Phẩm</th>
					<th>Giá Bán</th>
                    <th>Giảm Giá</th>
					<th>Số Lượng</th>
					<th>Đơn Giá</th>
                    <th></th>
				</tr>
			</thead>
			<tbody>
				<?php $total=0;?>
				<?php foreach ($products as $product):?>
				<tr>
                    <td class="image-product">
                        <?php
                            echo $this->Html->image('uploads/products/'.$product['Product']['HinhAnh1'], array('alt'=> __('', true), 'border' => '0', 'style'=>'width:40px;height:78px;'));
                        ?>
                    </td>
					<td><?php echo $product['Product']['TenPhone'];?></td>
					<td><?php echo number_format($product['Product']['GiaBan']);?> VNĐ
					</td>
                    <td>
                        <?php echo number_format((($product['Product']['GiaBan']*$product['Product']['GiamGia'])/100));?> VNĐ
                    </td>
					<td><div class="col-xs-3">
							<?php echo $this->Form->hidden('product_id.',array('value'=>$product['Product']['id']));?>
							<?php echo $this->Form->input('count.',array('type'=>'text', 'label'=>false,
									'class'=>'form-control input-sm', 'value'=>$product['Product']['count']));?>
						</div></td>
					<td><?php echo number_format($product['Product']['count']*($product['Product']['GiaBan']-(($product['Product']['GiaBan']*$product['Product']['GiamGia'])/100))); ?> VNĐ
					</td>
                    <td class="trash-gio-hang">
                        <?php echo $this->Html->link('',array('action'=>'delete',$product['Product']['id']),array('class'=>'fa fa-trash-o'));?>
                    </td>
				</tr>
				<?php $total = $total + ($product['Product']['count']*($product['Product']['GiaBan']-(($product['Product']['GiaBan']*$product['Product']['GiamGia'])/100)));?>
				<?php endforeach;?>

				<tr class="success">
					<td colspan=4 style="text-align: right;color: #333;font-family: helvetica;font-size: 15px;">Tổng Tiền:</td>
					<td><?php echo number_format($total);?> VNĐ
					</td>
				</tr>
			</tbody>
		</table>
        <?php echo $this->Html->link(__('Tiếp tục mua hàng'), array('controller'=>'products','action'=>'index'), array('class' => 'back-product btn btn-primary')); ?>
		<p class="text-right">
			<?php echo $this->Form->submit('Cập nhật',array('class'=>'btn btn-warning','div'=>false));?>
			
            <?php echo $this->Html->link('Thanh Toán',array('controller'=>'carts','action'=>'orders#OrderOrdersForm'),array('class'=>'btn btn-success')) ?>    
		</p>

	</div>
</div>
<?php echo $this->Form->end();?>

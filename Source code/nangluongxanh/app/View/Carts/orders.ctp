<div class="row">
	<div class="users form form-thanh-toan col-md-8 col-md-offset-3">
		<?php echo $this->Form->create('Order'); ?>
		<h3>Thanh Toán</h3>
        <fieldset>
        <legend>Thông tin giỏ hàng:</legend>
        <table class="table info-shopping-cart info-thanh-toan">
			<thead>
				<tr>
					<th>Tên Sản Phẩm</th>
					<th>Giá Bán</th>
                    <th>Giảm Giá</th>
					<th>Số Lượng</th>
					<th>Đơn Giá</th>
				</tr>
			</thead>
			<tbody>
				<?php $total=0;?>
				<?php foreach ($products as $product):?>
				<tr>
                    
					<td><?php echo $product['Product']['TenPhone'];?></td>
					<td><?php echo number_format($product['Product']['GiaBan']);?> VNĐ
					</td>
                    <td>
                        <?php echo $product['Product']['GiamGia']; ?>&#37;
                    </td>
					<td><div class="col-xs-3">
							<?php echo $this->Form->hidden('product_id.',array('value'=>$product['Product']['id']));?>
							<?php echo $product['Product']['count'];?>
						</div></td>
					<td><?php echo number_format($product['Product']['count']*($product['Product']['GiaBan']-(($product['Product']['GiaBan']*$product['Product']['GiamGia'])/100))); ?> VNĐ
					</td>
				</tr>
				<?php $total = $total + ($product['Product']['count']*($product['Product']['GiaBan']-(($product['Product']['GiaBan']*$product['Product']['GiamGia'])/100)));?>
				<?php endforeach;?>

				<tr class="success">
					<td colspan=3 style="text-align: right;color: #333;font-family: helvetica;font-size: 15px;">Tổng Tiền:</td>
					<td class="total-thanh-toan"><?php echo number_format($total);?> VNĐ
					</td>
				</tr>
			</tbody>
		</table>
        </fieldset>
        <fieldset>
        <legend>Thông khách hàng:</legend>
		<?php
         echo $this->Form->input('fullname',array('label' => 'Họ Tên','value'=>$fullname,'disabled','required'=>'required'));
		
            echo $this->Form->input('NgayGiaoHang',
			array(
				'class'=>'datepicker',
				'type'=>'text',
				'label' => 'Ngày Giao Hàng',
				'required'=>'required'
				)
			);
		echo $this->Form->input('HinhThucThanhToan',array('label' => 'Hình Thức Thanh Toán','options'=>array('','chuyển khoản'=>'Chuyển Khoản','tiền mặt'=>'Tiền mặt'),'required'=>'required'));
		echo $this->Form->input('DiaChiNguoiNhan',array('label' => 'Địa Chỉ Người Nhận','required'=>'required'));
		echo $this->Form->input('DienThoaiNguoiNhan',array('label'=>'Điện Thoại Người Nhận','required'=>'required'));
        echo '</fieldset>';
		echo $this->Form->end(__('Thanh Toán')); ?>
	</div>
</div>


	<div class="users manage-status form-admin form">
		<h3>Chi Tiết Đơn Hàng Đã Giải Quyết</h3>
        
      <div class="table-responsive">  
		<table class="table table-bordered table-hover">
            <tr class="first">
                <th>Ngày Lập Đơn Hàng</th>
                <th>Ngày Giao Hàng</th>
                <th>Khách Hàng</th>
                <th>Sản Phẩm</th>
                <th>Số Lượng</th>
                <th>Tổng Tiền</th>
                
            </tr>
        
            <!-- Here is where we loop through our $posts array, printing out post info -->
            <?php $total=0;?>
            <?php foreach ($orderduyet as $items): ?>
            <tr>
                <td><?php echo DateTime::createFromFormat('Y-m-d',$items['fk_orders']['NgayLap'])->format('d/m/Y'); ?></td>
                <td>
                    <?php echo DateTime::createFromFormat('Y-m-d',$items['fk_orders']['NgayGiaoHang'])->format('d/m/Y'); ?>
                </td>
                <td>
                    <?php echo $items['fk_users']['fullname'];?>
                </td>
                <td>
                    <?php echo $items['fk_products']['TenPhone'];?>
                </td>
                <td>
                    <?php echo $items['Orderdetail']['SoLuong'];?>
                </td>
                <td>
                    <?php echo number_format(($items['Orderdetail']['SoLuong']*$items['fk_products']['GiaBan'])-(($items['fk_products']['GiaBan']*$items['fk_products']['GiamGia'])/100)).' VNĐ'; ?>
                </td>
               
            </tr>
            <?php $total = $total + ($items['Orderdetail']['SoLuong']*$items['fk_products']['GiaBan'])-(($items['fk_products']['GiaBan']*$items['fk_products']['GiamGia'])/100);?>
            <?php endforeach; ?>
            <tr class="success">
					<td colspan=5 style="text-align: right;color: #000;font-family: helvetica;font-size: 15px;">Tổng Tiền:</td>
					<td style="color: #f1a827;font-size: 16px;text-shadow: none !important;"><?php echo number_format($total);?> VNĐ
					</td>
				</tr>
            <?php unset($items); ?>
        </table>
        <?php echo $this->Html->link(__('Quay lại'), array('controller'=>'admin','action'=>'orderduyet'), array('class' => 'back-product btn btn-primary')); ?>
        </div>
	</div>


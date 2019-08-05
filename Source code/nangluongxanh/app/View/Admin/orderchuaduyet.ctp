
	<div class="users manage-status form-admin form">
		<h3>Ðơn Hàng Chưa Xử Lý</h3>
        
      <div class="table-responsive">  
		<table class="table table-bordered table-hover">
            <tr class="first">
                <th>Ngày Lập Đơn Hàng</th>
                <th>Ngày Giao Hàng</th>
                <th>Khách Hàng</th>
                <th>Hình Thức Thanh Toán</th>
                <th>Địa Chỉ Người Nhận</th>
                <th>Điện Thoại Người Nhận</th>
                <th style="width:100px;"></th>
                
            </tr>
            <?php if($orderduyet == NULL)
                        echo '<tr><td colspan="7" style="text-align: center;">Không đơn đặt hàng</td></tr>';
                  else{      
            ?>
            <!-- Here is where we loop through our $posts array, printing out post info -->
            
            <?php foreach ($orderduyet as $items): ?>
            <tr>
                <td><?php echo DateTime::createFromFormat('Y-m-d',$items['Order']['NgayLap'])->format('d/m/Y'); ?></td>
                <td>
                    <?php echo DateTime::createFromFormat('Y-m-d',$items['Order']['NgayGiaoHang'])->format('d/m/Y'); ?>
                </td>
                <td>
                    <?php echo $items['fk_users']['fullname'];?>
                </td>
                <td>
                    <?php echo $items['Order']['HinhThucThanhToan'];?>
                </td>
                <td>
                    <?php echo $items['Order']['DiaChiNguoiNhan'];?>
                </td>
                <td>
                    <?php echo $items['Order']['DienThoaiNguoiNhan'];?>
                </td>
               <td class="control-form">
                    
                    <?php
                        echo $this->Html->link('', array('controller' => 'admin','action' => 'duyet', $id=$items['Order']['id']),array('class'=>'fa fa-check-square-o tip-top','title'=>'Duyệt Đơn Hàng'));
                        echo $this->Html->link('', array('controller' => 'admin','action' => 'view_order_no_duyet', $id=$items['Order']['id']),array('class'=>'fa fa-edit tip-top','title'=>'Chi Tiết'));
                    ?>
                </td>
            </tr>
            <?php endforeach; }?>
            <?php unset($items); ?>
        </table>
        </div>
	</div>


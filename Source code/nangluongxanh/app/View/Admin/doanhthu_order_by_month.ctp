

	<div class="users manage-status form-admin form">
		<h3>Doanh Thu Bán Hàng Theo Tháng</h3>
       
        <form class="form-inline" style="margin-bottom: 20px;" action="doanhthu_order_by_month" method="GET">
        <label>Nhập Tháng - Năm: </label>
        <?php
            echo '<select class="thang form-control" name="thang">';
                echo '<option value="0">tháng</option>';
            for($thang=1;$thang<=12;$thang++)
            {
                if($thang < 10)
                    echo '<option value="0'.$thang.'">'.$thang.'</option>'; 
                else
                    echo '<option value='.$thang.'>'.$thang.'</option>';     
            }
            echo '</select>';
            echo ' - ';
            echo '<select class="nam form-control" name="nam">';
            echo '<option value="0">năm</option>';
            for($nam=date('Y')-5;$nam<=date('Y')+5;$nam++)
            {
                echo '<option value='.$nam.'>'.$nam.'</option>'; 
            }
            echo '</select>';
        ?>
        <!--<input class="month_year" name="month_year" type="text" /> --->
        <input class="btn btn-primary" type="submit" value="Submit"/>
         </form>
         
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
            <?php foreach ($doanhthu as $items): ?>
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
        
        </div>
	</div>


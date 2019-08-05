
	<div class="users manage-hsx form-admin form">
		<h3>Danh Sách Sản Phẩm Sắp Hết</h3>
      <div class="table-responsive">  
		<table class="table table-bordered table-hover">
            <tr class="first">
                <th style="text-align: center;">Mã Sản Phẩm</th>
                <th style="text-align: center;">Tên Sản Phẩm</th>
                <th style="text-align: center;">Hình Ảnh</th>
                <th style="text-align: center;">Số Lượng</th>
                <th></th>
            </tr>
        
            <!-- Here is where we loop through our $posts array, printing out post info -->
        
            <?php foreach ($nhacnho as $item): ?>
            <tr>
                <td style="text-align: center;vertical-align: middle;"><?php echo $item['Product']['MaPhone']; ?></td>
                <td style="text-align: center;vertical-align: middle;">
                    <?php echo $item['Product']['TenPhone']; ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $this->Html->image('uploads/products/'.$item['Product']['HinhAnh1'], array('alt'=> __('', true), 'border' => '0', 'style'=>'width:40px;height:78px;')); ?>
                </td>
                <td style="text-align: center;font-size: 18px;vertical-align: middle;"><?php echo $item['Product']['SoLuong']; ?></td>
                <td class="control-form" style="text-align: center;">
                    <?php
                        echo $this->Html->link('', array('controller' => 'admin','action' => 'editproduct', $id=$item['Product']['id']),array('class'=>'fa fa-edit tip-top','title'=>'Cập nhật'));
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php unset($HangSX); ?>
        </table>
        </div>
	</div>


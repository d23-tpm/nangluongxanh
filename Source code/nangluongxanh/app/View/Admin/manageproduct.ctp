
<div class="users manage-product form-admin form">
  <h3>Danh Sách Sản Phẩm</h3>
  <div class="table-responsive">  
      <table class="table table-bordered table-hover">
        <tr class="first">
            <th>Mã sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Hình 1</th>
            <th>Hình 2</th>
            <th>Hình 3</th>
            <th>Mã HSX</th>
            <th>Giá Bán</th>
            <th>Số Lượng</th>
            <th>Giảm Giá</th>
            <th>Trạng Thái</th>
            <th>Ngày Nhập</th>
            <th></th>
        </tr>
        
        <!-- Here is where we loop through our $posts array, printing out post info -->
       
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?php echo $product['Product']['MaPhone']; ?></td>
                <td>
                    <?php echo $product['Product']['TenPhone']; ?>
                </td>
                <td>
                    <?php
                    echo $this->Html->image('uploads/products/'.$product['Product']['HinhAnh1'], array('alt'=> __('', true), 'border' => '0', 'style'=>'width:40px;height:78px;'));
                    ?>
                </td>
                <td>
                    <?php
                    echo $this->Html->image('uploads/products/'.$product['Product']['HinhAnh2'], array('alt'=> __('', true), 'border' => '0', 'style'=>'width:40px;height:78px;'));
                    ?>
                </td>
                <td>
                    <?php
                    echo $this->Html->image('uploads/products/'.$product['Product']['HinhAnh3'], array('alt'=> __('', true), 'border' => '0', 'style'=>'width:40px;height:78px;'));
                    ?>
                </td>
                <td>
                    <?php echo $product['Product']['MaHangSX']; ?>
                </td>
                <td>
                    <?php echo $product['Product']['GiaBan']; ?>
                </td>
                <td>
                    <?php echo $product['Product']['SoLuong']; ?>
                </td>
                <td>
                    <?php echo $product['Product']['GiamGia']; ?>
                </td>
                <td>
                    <?php if($product['Product']['status_id'] == 1)
                        echo 'Hàng mới';
                    ?>
                </td>
                <td>
                    <?php echo $product['Product']['created']; ?>
                </td>
                <td class="control-form">
                    <?php
                    echo $this->Html->link('', array('controller' => 'admin','action' => 'editproduct', $id=$product['Product']['id']),array('class'=>'fa fa-edit'));
                    ?>
                    <?php
                    echo $this->Form->postLink('', array(
                        'controller' => 'admin',
                        'action' => 'deleteproduct',
                        $product['Product']['id']),
                        array('class'=>'fa fa-trash-o'),
                        array('confirm' => 'Are you sure?'));
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php unset($product); ?>
        </table>
        <?php   
            $paginator = $this->Paginator; 
                // pagination section
            echo "<div class='paging'>";
         
                // the 'first' page button
                echo $paginator->first("First",array('class'=>'btn btn-default control-default'));
                 
                // 'prev' page button,
                // we can check using the paginator hasPrev() method if there's a previous page
                // save with the 'next' page button
                if($paginator->hasPrev()){
                    echo $paginator->prev("Prev",array('class'=>'btn btn-default control-default'));
                }
                 
                // the 'number' page buttons
                echo $paginator->numbers(array('modulus' => 2,'class'=>'btn btn-default'));
                 
                // for the 'next' button
                if($paginator->hasNext()){
                    echo $paginator->next("Next",array('class'=>'btn btn-default control-default'));
                }
                 
                // the 'last' page button
                echo $paginator->last("Last",array('class'=>'btn btn-default control-default'));
             
            echo "</div>";
       ?>     
    </div>
</div>


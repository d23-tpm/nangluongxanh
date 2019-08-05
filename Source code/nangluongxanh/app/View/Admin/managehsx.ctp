
	<div class="users manage-hsx form-admin form">
		<h3>Danh Sách Hãng Sản Xuất</h3>
      <div class="table-responsive">  
		<table class="table table-bordered table-hover">
            <tr class="first">
                <th>Mã HSX</th>
                <th>Tên HSX</th>
                <th>Xuất Xứ</th>
                <th></th>
            </tr>
        
            <!-- Here is where we loop through our $posts array, printing out post info -->
        
            <?php foreach ($HangSX as $HangSX): ?>
            <tr>
                <td><?php echo $HangSX['Hangsx']['MaHangSX']; ?></td>
                <td>
                    <?php echo $HangSX['Hangsx']['TenHangSX']; ?>
                </td>
                <td>
                    <?php echo $HangSX['Hangsx']['XuatXu']; ?>
                </td>
                <td class="control-form">
                    <?php
                        echo $this->Html->link('', array('controller' => 'admin','action' => 'edithsx', $id=$HangSX['Hangsx']['id']),array('class'=>'fa fa-edit'));
                    ?>
                    <?php
                        echo $this->Form->postLink('', array(
                            'controller' => 'admin',
                            'action' => 'deletehsx',
                            $HangSX['Hangsx']['id']),
                            array('class'=>'fa fa-trash-o'),
                            array('confirm' => 'Are you sure?'));
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php unset($HangSX); ?>
        </table>
        </div>
	</div>



	<div class="users manage-status form-admin form">
		<h3>Danh Sách Trạng Thái</h3>
      <div class="table-responsive">  
		<table class="table table-bordered table-hover">
            <tr class="first">
                <th>Id</th>
                <th>Tên Trạng Thái</th>
                <th>Loại Trạng Thái</th>
                <th></th>
                
            </tr>
        
            <!-- Here is where we loop through our $posts array, printing out post info -->
            
            <?php foreach ($status as $sta): ?>
            <tr>
                <td><?php echo $sta['Status']['id']; ?></td>
                <td>
                    <?php echo $sta['Status']['name_status']; ?>
                </td>
                <td>
                    <?php echo $sta['Status']['type_status'];?>
                </td>
                <td class="control-form">
                    <?php echo $this->Html->link('', array('controller' => 'admin','action' => 'editstatus', $id=$sta['Status']['id']),array('class'=>'fa fa-edit'));?>
                    <?php
                        
                        echo $this->Form->postLink(
                            '',
                            array('controller'=>'admin','action' => 'deletestatus', $id=$sta['Status']['id']),
                            array('class'=>'fa fa-trash-o'),
                            array('confirm' => 'Are you sure?')
                        );
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php unset($sta); ?>
        </table>
        </div>
	</div>


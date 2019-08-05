
	<div class="users manage-role form-admin form">
		<h3>Danh Sách Quyền</h3>
      <div class="table-responsive">  
		<table class="table table-bordered table-hover">
            <tr class="first">
                <th>Id</th>
                <th>Quyền</th>
                <th style="width: 110px;"></th>
                
            </tr>
        
            <!-- Here is where we loop through our $posts array, printing out post info -->
            
            <?php foreach ($roles as $ps): ?>
            <tr>
                <td><?php echo $ps['Role']['id']; ?></td>
                <td>
                    <?php echo $ps['Role']['role_name']; ?>
                </td>
                <td class="control-form">
                    <?php echo $this->Html->link('', array('controller' => 'admin','action' => 'editrole', $id=$ps['Role']['id']),array('class'=>'fa fa-edit tip-top','title'=>'Sửa thông tin quyền'));?>
                    <?php echo '<a class="fa fa-lock tip-top" href="../Menuchildrengroups/add_permission_by_group?role_id='.$ps['Role']['id'].'" title="Phân quyền"></a>'?>
                    <?php
                        
                        echo $this->Form->postLink(
                            '',
                            array('controller'=>'admin','action' => 'deleterole', $id=$ps['Role']['id']),
                            array('class'=>'fa fa-trash-o tip-top','title'=>'Xóa quyền'),
                            array('confirm' => 'Are you sure?')
                        );
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php unset($ps); ?>
        </table>
        </div>
        <?php echo $this->Html->link(__('Thêm Quyền'), array('controller'=>'admin','action'=>'addrole'), array('class' => 'add-role btn btn-primary')); ?>
	</div>


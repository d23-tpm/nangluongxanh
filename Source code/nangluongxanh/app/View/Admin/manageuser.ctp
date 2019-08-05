
    <div class="users manage-user form-admin form">
        <h3>Danh Sách Thành Viên</h3>
      <div class="table-responsive">  
        <table class="table table-bordered table-hover">
            <tr class="first">
                <th>Id</th>
                <th>Họ và tên</th>
                <th>Giới tính</th>
                <th>Ngày sinh</th>
                <th>Ðịa chỉ</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Tên đăng nhập</th>
                <th>Quyền</th>
                <th>Trạng thái</th>
                <th></th>
                <th>Ngày tạo</th>
            </tr>
        
            <!-- Here is where we loop through our $posts array, printing out post info -->
            
            <?php foreach ($trangthai as $user): ?>
            <tr>
                <td><?php echo $user['JUser']['id']; ?></td>
                <td>
                    <?php echo $user['JUser']['fullname']; ?>
                </td>
                <td>
                    <?php echo $user['JUser']['sex'];?>
                </td>
                <td>
                    <?php
                        echo $user['JUser']['birthday'];
                    ?>
                </td>
                <td>
                    <?php
                        echo $user['JUser']['address'];
                    ?>
                </td>
                <td>
                    <?php
                        echo $user['JUser']['numberphone'];
                    ?>
                </td> 
                <td>
                    <?php
                        echo $user['JUser']['email'];
                    ?>
                </td>
                <td>
                    <?php
                        echo $user['JUser']['username'];
                    ?>
                </td>
                
                <td>
                    <?php
                        echo $user['JRole']['role_name'];
                    ?>
                </td>
                <td class="active-user">
                    <?php
                        if($user['JUser']['status_user'] == 1)
                            $temp = '<i class="fa fa-check"></i>';
                        else
                            $temp = '<i class="fa fa-remove"></i>';
                        echo $temp;
                        
                    ?>
                </td>
                <td class="control-form">
                    <?php echo $this->Html->link('', array('controller' => 'admin','action' => 'edituser', $id=$user['JUser']['id']),array('class'=>'fa fa-edit'));?>
                    <?php
                        
                        echo $this->Form->postLink(
                            '',
                            array('controller'=>'admin','action' => 'deleteuser', $id=$user['JUser']['id']),
                            array('class'=>'fa fa-trash-o'),
                            array('confirm' => 'Are you sure?')
                        );
                    ?>
                </td>
                <td><?php echo $user['JUser']['created']; ?></td>
            </tr>
            <?php endforeach; ?>
            <?php unset($user); ?>
        </table>
        </div>
    </div>



<div class="users manage-contact form-admin form">
	<h3>Danh Sách Liên Hệ</h3>
	
	<div class="table-responsive">  
		<table class="table table-bordered table-hover">
			<tr class="first">
				<th style="text-align: center;">ID</th>
				<th style="text-align: center;">Họ Tên</th>
				<th style="text-align: center;">Email</th>
				<th style="text-align: center;">Nội Dung</th>
				<th style="text-align: center;">Trạng Thái</th>
				<th style="width:80px;"></th>
			</tr>

			<!-- Here is where we loop through our $posts array, printing out post info -->
            <?php if($contacts == NULL)
                        echo '<tr><td colspan="6" style="text-align: center;">Không có liên hệ</td></tr>';
                  else{      
            ?>
			<?php foreach ($contacts as $menuitem): ?>
				<tr>
                    
					<td style="text-align: center;"><?php echo $menuitem['Contact']['id']; ?></td>
					<td>
						<?php echo $menuitem['Contact']['name']; ?>
					</td>
					<td>
						<?php echo $menuitem['Contact']['email']; ?>
					</td>
					<td>
						<?php echo $menuitem['Contact']['message']; ?>
					</td>
					<td class="active-user">
						<?php
						$temp = '<i class="fa fa-ban"></i>';
						echo $temp;
						?>
					</td>
					<td class="control-form">
						<?php
						echo $this->Html->link('', array('controller' => 'admin','action' => 'replycontact', $id=$menuitem['Contact']['id']),array('class'=>'fa fa-mail-reply tip-top','title'=>'Phản hồi'));
						?>
						<?php
						echo $this->Form->postLink('', array(
							'controller' => 'admin',
							'action' => 'deletecontact',
							$menuitem['Contact']['id']),
						array('class'=>'fa fa-trash-o tip-top','title'=>'Xóa'),
						array('confirm' => 'Are you sure?'));
						?>
					</td>
				</tr>
			<?php endforeach; }?>
			<?php unset($menuitem); ?>
		</table>     
	</div>
</div>


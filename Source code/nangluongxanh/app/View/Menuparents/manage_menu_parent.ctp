
<div class="users manage-menuparent form-admin form">
	<h3>Danh Sách Menu Cấp 1</h3>
	<?php
	echo $this->Html->link('Thêm Menu Cấp 1', array('controller' => 'menuparents','action' => 'add'),array('class'=>'btn btn-primary add-menu-second','title'=>'Thêm Menu Cấp 1'));
	?>
	<div class="table-responsive">  
		<table class="table table-bordered table-hover">
			<tr class="first">
				<th style="text-align: center;">ID</th>
				<th style="text-align: center;">Tên Menu</th>
				<th style="text-align: center;">Icon</th>
				<th style="text-align: center;">Trạng Thái</th>
				<th style="width:80px;"></th>
			</tr>

			<!-- Here is where we loop through our $posts array, printing out post info -->

			<?php foreach ($menuparents as $menuitem): ?>
				<tr>
					<td style="text-align: center;"><?php echo $menuitem['Menuparent']['id']; ?></td>
					<td>
						<?php echo $menuitem['Menuparent']['menuname']; ?>
					</td>
					<td style="text-align: center;font-size: 18px;">
                       <?php
						echo '<i class="fa '.$menuitem['Menuparent']['icon'].'"></i>';
					   ?>
					</td>
					<td class="active-user">
						<?php
						if($menuitem['Menuparent']['status'] == 1)
							$temp = '<i class="fa fa-check"></i>';
						else
							$temp = '<i class="fa fa-ban"></i>';
						echo $temp;

						?>
					</td>
					<td class="control-form">
						<?php
						echo $this->Html->link('', array('controller' => 'menuparents','action' => 'editmenuparent', $id=$menuitem['Menuparent']['id']),array('class'=>'fa fa-edit tip-top','title'=>'Sửa'));
						?>
						<?php
						echo $this->Form->postLink('', array(
							'controller' => 'menuparents',
							'action' => 'deletemenuparent',
							$menuitem['Menuparent']['id']),
						array('class'=>'fa fa-trash-o tip-top','title'=>'Xóa'),
						array('confirm' => 'Are you sure?'));
						?>
					</td>
				</tr>
			<?php endforeach; ?>
			<?php unset($menuitem); ?>
		</table>     
	</div>
</div>


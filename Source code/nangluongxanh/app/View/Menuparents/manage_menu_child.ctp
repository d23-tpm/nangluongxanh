
<div class="users manage-menuchilds form-admin form">
	<h3>Danh Sách Menu Cấp 2</h3>
	<?php
	echo $this->Html->link('Thêm Menu Cấp 2', array('controller' => 'menuparents','action' => 'add_menu_item'),array('class'=>'btn btn-primary add-menu-second','title'=>'Thêm Menu Cấp 2'));
	?>
	<div class="table-responsive">  
		<table class="table table-bordered table-hover">
			<tr class="first">
				<th>ID</th>
				<th>Menu Cha</th>
				<th>Menu Con</th>
				<th>Controller</th>
				<th>Action</th>
				<th>Trạng Thái</th>
				<th style="width:80px;"></th>
			</tr>

			<!-- Here is where we loop through our $posts array, printing out post info -->

			<?php foreach ($menuchilds as $menuitem): ?>
				<tr>
					<td><?php echo $menuitem['Menuchild']['id']; ?></td>
					<td>
						<?php echo $menuitem['JMenuparent']['menuname']; ?>
					</td>
					<td>
						<?php
						echo $menuitem['Menuchild']['menuname'];
						?>
					</td>
					<td>
						<?php
						echo $menuitem['Menuchild']['controller'];
						?>
					</td>
					<td>
						<?php
						echo $menuitem['Menuchild']['action'];
						?>
					</td>
					<td class="active-user">
						<?php
						if($menuitem['Menuchild']['status'] == 1)
							$temp = '<i class="fa fa-check"></i>';
						else
							$temp = '<i class="fa fa-ban"></i>';
						echo $temp;

						?>
					</td>
					<td class="control-form">
						<?php
						echo $this->Html->link('', array('controller' => 'menuparents','action' => 'editmenuchild', $id=$menuitem['Menuchild']['id']),array('class'=>'fa fa-edit tip-top','title'=>'Sửa'));
						?>
						<?php
						echo $this->Form->postLink('', array(
							'controller' => 'menuparents',
							'action' => 'deletemenuchild',
							$menuitem['Menuchild']['id']),
						array('class'=>'fa fa-trash-o tip-top','title'=>'Xóa'),
						array('confirm' => 'Are you sure?'));
						?>
					</td>
				</tr>
			<?php endforeach; ?>
			<?php unset($menuitem); ?>
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


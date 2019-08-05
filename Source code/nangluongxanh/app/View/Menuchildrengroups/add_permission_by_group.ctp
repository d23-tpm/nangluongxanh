
<script language="javascript" type="text/javascript">

	//this will move selected items from source list to destination list			
	function move_list_items(sourceid, destinationid)
	{
		$("#"+sourceid+"  option:selected").appendTo("#"+destinationid);
	}

	//this will move all selected items from source list to destination list
	function move_list_items_all(sourceid, destinationid)
	{
		$("#"+sourceid+" option").appendTo("#"+destinationid);
		$("#"+destinationid+" option").attr({
			selected: 'selected'
		});
	}
	

</script>
<div class="users add-permission-by-group form-admin form">
	
	<?php echo $this->Form->create('Menuchildrengroup'); ?>
	<h3>Phân Quyền</h3>

	<span class="col-md-12" style="padding: 0;font-size: 16px;margin-bottom: 20px;"><strong>Vai trò:</strong> <?php echo $name_role[0]['Role']['role_name'];?></span>
	<?php
	// $psa =array();
	// foreach ($getroles as $key) {
	// 	foreach ($key as $item) {
	// 		if($item['id']!=2){
	// 			$tenrole = $item['role_name'];
	// 			$id_role = $item['id'];
	// 			$psa[$id_role]=$tenrole;
	// 		}	
	// 	}
	// }
	// echo $this->Form->input('role_id', array(
	// 	'options' => $psa,'label' => 'Quyền'
	// 	));
	$roleid = $_GET['role_id'];
	echo $this->Form->input('role_id', array('type'=>'hidden','value'=>$roleid,'label' => false));

	
	?> 
	<div class="chuc-nang-hien_co col-md-5">
		<label>Chức năng hiện có</label>
		<select id="from_select_list" multiple="multiple" name="from_select_list" style="width: 100%;min-height: 200px;"> 
			<?php
			if($options!=NULL){
				foreach ($listchild as $value) {
					$term1 [$value['Menuchild']['id']] = $value['Menuchild']['menuname'];
				}
				foreach ($options as $value) {
					$term2 [$value['JMenuchilds']['id']] = $value['JMenuchilds']['menuname'];
				}
				$listhienco = array_diff($term1, $term2);
				foreach ($listhienco as $key1=>$value1) {		
					$menuname = $value1;
					$id_child_menu = $key1;
					echo '<option value="'.$id_child_menu.'">'.$menuname.'</option>';

				}
			}else{
				foreach ($listchild as $value_iterm) {		
					$menuname = $value_iterm['Menuchild']['menuname'];
					$id_child_menu = $value_iterm['Menuchild']['id'];
					echo '<option value="'.$id_child_menu.'">'.$menuname.'</option>';

				}
			}
			

			?>
		</select>
	</div>
	<ul class="control col-md-2" style="text-align: center;">
		<li>
			<input id="moveright" type="button" class="btn btn-default" value=">" onclick="move_list_items('from_select_list','MenuchildrengroupMenuChildId');" />
		</li>
		<li>
			<input id="moverightall" type="button" class="btn btn-default" value=">>" onclick="move_list_items_all('from_select_list','MenuchildrengroupMenuChildId');" />
		</li>
		<li>
			<input id="moveleft" type="button" class="btn btn-default" value="<" onclick="move_list_items('MenuchildrengroupMenuChildId','from_select_list');" />
		</li>
		<li>
			<input id="moveleftall" type="button" class="btn btn-default" value="<<" onclick="move_list_items_all('MenuchildrengroupMenuChildId','from_select_list');" />
		</li>
	</ul>
	<div class="chuc_nang_duoc_chon col-md-5">
		<label>Chức năng được chọn</label>
		<?php

		$list = array();
		foreach($options as $item_active){

			$id = $item_active['JMenuchilds']['id'];
			$namemenu = $item_active['JMenuchilds']['menuname'];
			$list[$id]=$namemenu;
		}	

		echo $this->Form->input('menu_child_id', array(
			'options' => $list,'label' => false,'multiple'=>true
			));
			?>
		</div>

		<?php echo $this->Form->end('Lưu'); ?>


	</div>
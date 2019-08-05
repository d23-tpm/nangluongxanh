
<div class="users editmenuchilds product form-admin form">
	<?php echo $this->Form->create('Menuchild'); ?>
	<h3>Cập Nhật Menu Cấp 2</h3>

	<?php 
	$nsx =array();
	foreach ($menu_parents as $key){
		$tenmenu = $key['Menuparent']['menuname'];
		$idmenu = $key['Menuparent']['id'];
		$nsx[$idmenu]=$tenmenu;
	}
	echo $this->Form->input('menu_parent_id', array(
		'options' => $nsx,'label' => 'Menu Cha'
		));
	echo $this->Form->input('menuname',array('label' => 'Menu Con','required'=>'required'));
	?>
	<div class="controller input select">
	<label>Controller</label>
	<?php
	echo '<select name="data[Menuchild][controller]" id="MenuchildController">';
	foreach ($listcontrol as $key => $value) {
		if($get_ctrl_ac !=NULL)
		{
			if($get_ctrl_ac[0]['Menuchild']['controller']==strtolower(substr($key,0,-10))){
				echo '<option selected value="'.strtolower(substr($key,0,-10)).'">'.strtolower(substr($key,0,-10)).'</option>';
			}
		}
		echo '<option value="'.strtolower(substr($key,0,-10)).'">'.strtolower(substr($key,0,-10)).'</option>';
		
	}
	echo '</select>';
	?>
	</div>
	<div class="action input select">
	<label>Action</label>
	<?php	
	echo '<select name="data[Menuchild][action]" id="MenuchildAction">';
	foreach ($listcontrol as $key => $value) {
		foreach ($value as $value1) {
			if($get_ctrl_ac !=NULL){
				if($get_ctrl_ac[0]['Menuchild']['action']==$value1){
					echo '<option selected value="'.$value1.'" class="'.strtolower(substr($key,0,-10)).'">'.$value1.'</option>';
				}
			}
			echo '<option value="'.$value1.'" class="'.strtolower(substr($key,0,-10)).'">'.$value1.'</option>';
		}

	}
	echo '</select>';
	?>
	</div>
	<div class="status-menu">
	<?php
	$options = array('2' => 'Deactive', '1' => 'Active');
	$attributes = array('legend' => false);
	echo $this->Form->radio('status',$options, $attributes);
	?>
	</div>
	<?php
	echo $this->Form->end('Lưu');
	?>
</div>
<script>
	$("#MenuchildAction").chained("#MenuchildController");
</script>



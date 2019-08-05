
<div class="users add-menu-item form-admin form">
	<?php echo $this->Form->create('Menuchild'); ?>
	<h3>Thêm Menu Cấp 2</h3>
	<?php
	$name_first =array();
	foreach ($listmenuparent as $key){
		$name_cate_first = $key['Menuparent']['menuname'];
		$id_cate_first = $key['Menuparent']['id'];
		$name_first[$id_cate_first]=$name_cate_first;
	}
	echo $this->Form->input('id', array(
		'options' => $name_first,'label' => 'Menu Cấp 1'
		));
		?>
		<div class="cate_second" style="overflow: hidden;">
			<div class="input_fields_wrap">
			
				<?php echo $this->Form->input('menuname',array('placeholder'=>'Menu Name','label'=>false,'required'=>'required'));
				//echo $this->Form->input('controller'.$i,array('placeholder'=>'Controller','label'=>false,'required'=>'required'));
				echo '<select name="data[Menuchild][controller]" id="MenuchildController">';
				echo '<option value="">--Controller--</option>';	
				foreach ($listcontrol as $key => $value) {
					echo '<option value="'.strtolower(substr($key,0,-10)).'">'.strtolower(substr($key,0,-10)).'</option>';
				}
				echo '</select>';	
				echo '<select name="data[Menuchild][action]" id="MenuchildAction">';
				echo '<option value="">--Action--</option>';
				foreach ($listcontrol as $key => $value) {
					foreach ($value as $value1) {
						echo '<option value="'.$value1.'" class="'.strtolower(substr($key,0,-10)).'">'.$value1.'</option>';
					}
					
				}
				echo '</select>';
				//echo $this->Form->input('action'.$i,array('placeholder'=>'Action','label'=>false,'required'=>'required'));
				?>
			</div>
		</div>
		<?php echo $this->Form->end(__('Lưu')); ?>
	</div> 
    <script>
        $("#MenuchildAction").chained("#MenuchildController");
    </script>


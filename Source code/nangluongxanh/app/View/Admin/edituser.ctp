
<div class="users form col-md-6 col-md-offset-3">
	<?php echo $this->Form->create('User'); ?>
	<h3>Thay Đổi Thông Tin Cá Nhân</h3>
	<?php echo $this->Form->input('fullname',array('label' => 'Họ Tên <span style="margin-left:15px;color:red;">*</span>','required'=>'required'));
	echo $this->Form->input('sex',array('options' =>array('nam'=>'Nam','nu'=>'Nữ'),'label' => 'Giới Tính <span style="margin-left:15px;color:red;">*</span>'));
	echo $this->Form->input('birthday',
		array(
			'class'=>'datepicker',
			'dateFormat' => 'DMY', 
			'type'=>'text',
			'label' => 'Ngày Sinh <span style="margin-left:15px;color:red;">*</span>',
			'required'=>'required'
			)
		);
	echo $this->Form->input('address',array('label' => 'Địa Chỉ <span style="margin-left:15px;color:red;">*</span>','required'=>'required'));
	echo $this->Form->input('numberphone',array('label' => 'Số Điện Thoại <span style="margin-left:15px;color:red;">*</span>','required'=>'required'));
	echo $this->Form->input('email',array('label'=>'Email <span style="margin-left:15px;color:red;">*</span>','type'=>'email','required'=>'required'));
	echo '<div class="input select"><label for="UserRoleId">Quyền</label><select name="data[User][role_id]" id="UserRoleId">';
	foreach($rolename as $key){
		$tenrole = $key['role_name'];
		$id_role = $key['id'];
		if($id_role == $getidactive[0]['JRole']['id']){
			echo '<option selected value="'.$id_role.'">'.$tenrole.'</option>';
		}else{
			echo '<option value="'.$id_role.'">'.$tenrole.'</option>';
		}
	}
	echo '</select></div>';

	$options = array('2' => 'Deactive', '1' => 'Active');
	$attributes = array('legend' => false);
	echo $this->Form->radio('status_user',$options, $attributes);
	echo $this->Form->end(__('Lưu')); ?>

</div>


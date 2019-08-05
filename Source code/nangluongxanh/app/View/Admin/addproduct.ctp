
<div class="users addproduct product form-admin form">
	<?php echo $this->Form->create('Product',array('enctype' => 'multipart/form-data')); ?>
	<h3>Nhập Sản Phẩm</h3>
	<?php echo $this->Form->input('MaPhone',array('label' => 'Mã sản phẩm','required'=>'required'));
	echo $this->Form->input('TenPhone',array('label' => 'Tên sản phẩm','required'=>'required'));
	for ($i=1; $i<4; $i++) 
		{ ?>
	<div  id="attachment<?php echo $i;?>">
		<div>
			<?php echo $this->Form->input('HinhAnh'.$i,array('type'=>'file','label' => 'Hình'.$i,'div' => false));?>
		</div>

	</div>
	<?php }
	$nsx =array();
	foreach ($namehsx as $key){
		$tennsx = $key['TenHangSX'];
		$idnsx = $key['MaHangSX'];
		$nsx[$idnsx]=$tennsx;
	}
	echo $this->Form->input('MaHangSX', array(
		'options' => $nsx,'label' => 'Hãng Sản Xuất'
		));
	echo $this->Form->input('ThongTin', array('rows' => '4','label'=>'Thông tin'));
	echo '<script type="text/javascript" language="javascript"> CKEDITOR.replace( "ProductThongTin" );</script>  ';
	echo $this->Form->input('Description_CauHinh', array('rows' => '10','label'=>'Tóm tắt thông số'));
	echo '<script type="text/javascript" language="javascript"> CKEDITOR.replace( "ProductDescriptionCauHinh" );</script>  ';
	echo $this->Form->input('CauHinh', array('rows' => '25','label'=>'Thông số kỹ thuật','required'=>'required'));
	echo '<script type="text/javascript" language="javascript"> CKEDITOR.replace( "ProductCauHinh" );</script>  ';
	echo $this->Form->input('MauSac',array('label' => 'Màu Sắc','required'=>'required'));
	echo $this->Form->input('GiaBan',array('label' => 'Giá Bán','required'=>'required'));
	echo $this->Form->input('SoLuong',array('label' => 'Số Lượng','required' =>'required'));
	echo $this->Form->input('GiamGia',array('label' => 'Giảm Giá','required' =>'required'));

	echo $this->form->input('status_id', 
		array(
			'label'=>'Sản phẩm mới', 
			'type'=>'checkbox',
			'value'=>'1',
			));
	echo $this->Form->end('Lưu');
	?>
</div>



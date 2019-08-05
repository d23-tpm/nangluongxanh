<?php
	/**
	* 
	*/
	class Order extends AppModel
	{
		
		
		public $vadilate = array(
			
			'NgayLap' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'Ngày lập không được để trống'
					)
				),
            'NgayGiaoHang' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'Ngày giao hàng không được để trống'
					)
				),
            'HinhThucThanhToan'=>array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'Hình thức thanh toán không được để trống'
					)
				),
            'DiaChiNguoiNhan'=>array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'Địa chỉ người nhận không được để trống'
					)
				),
             'DienThoaiNguoiNhan'=>array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'Điện thoại người nhận không được để trống'
					)
				)               
			);
            		      
		
	

	
	public $useTable = 'orders';
}	
?>
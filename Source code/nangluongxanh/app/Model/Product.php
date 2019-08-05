<?php
App::uses('AppModel', 'Model');
	/**
	* 
	*/
	class Product extends AppModel
	{
		
		
		public $vadilate = array(
			'MaPhone' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A MaPhone is required'
					)
				),
			'TenPhone' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A TenPhone is required'
					)
				),
			'HinhAnh1'	=> array('Uploader.FileValidation'),
			'HinhAnh2'	=> array('Uploader.FileValidation'),
            'HinhAnh3'	=> array('Uploader.FileValidation'), 
            'MaHangSX'	=> array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A MaHangSX is required'
					)
				),
            'Description_CauHinh' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A Tóm tắt cấu hình is required'
					)
				),    
			'CauHinh' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A CauHinh is required'
					)
				),
			'MauSac' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A MauSac is required'
					)
				),
			'GiaBan' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A GiaBan is required'
					)
				),
            'SoLuong' => array(
				'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A SoLuong is required'
					)
				)				      
			);
            		      
	

	
	public $useTable = 'products';
}	
?>
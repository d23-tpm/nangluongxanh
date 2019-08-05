<?php
	/**
	* 
	*/
	class Hangsx extends AppModel
	{
		
		
		public $vadilate = array(
			'MaHangSX' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A MaHangSX is required'
					)
				),
			'TenHangSX' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A TenHangSX is required'
					)
				),
			'XuatXu' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A XuatXu is required'
					)
				)
                    
			);
	

	
	public $useTable = 'hangsxs';

}
?>
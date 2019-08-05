<?php
	/**
	* 
	*/
	class Menuparent extends AppModel
	{
		
		public $vadilate = array(
			'namemenu' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A Tên menu is required'
					)
				),
			'icon' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A icon is required'
					)
				),
		);	
	

	
	public $useTable = 'menuparents';

}
?>
<?php
	/**
	* 
	*/
	class Menuchild extends AppModel
	{
		
		public $vadilate = array(
			'menu_parent_id' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A Menu cha is required'
					)
				),
			'menuname' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A Tên menu is required'
					)
				),
			'controller' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A controller is required'
					)
				),
			'action' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A action is required'
					)
				),
		);	
	

	
	public $useTable = 'menuchilds';

}
?>
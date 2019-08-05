<?php
	/**
	* 
	*/
	class Menuchildrengroup extends AppModel
	{
		
		public $vadilate = array(
			'role_id' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A quyền is required'
					)
				),
			'menu_child_id' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A permission is required'
					)
				),
		);	
	

	
	public $useTable = 'menuchildrengroups';

}
?>
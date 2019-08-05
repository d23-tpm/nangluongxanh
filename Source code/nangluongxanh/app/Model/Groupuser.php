<?php
	/**
	* 
	*/
	class Groupuser extends AppModel
	{
		
		
		public $vadilate = array(
			
			'role_id' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A id role is required'
					)
				),
			'user_id' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A id user is required'
					)
				)          
			);

		



		public $useTable = 'groupusers';
	}	
	?>
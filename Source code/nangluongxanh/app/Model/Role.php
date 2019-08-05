<?php
	/**
	* 
	*/
	class Role extends AppModel
	{
		
		
		public $vadilate = array(
			
			'role_name' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A Quyền is required'
					)
				)     
			);
            		      
		
	

	
	public $useTable = 'roles';
}	
?>
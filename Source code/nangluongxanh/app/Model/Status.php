<?php
	/**
	* 
	*/
	class Status extends AppModel
	{
		
		
		public $vadilate = array(
			
			'name_status' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A status is required'
					)
				),
             'type_status' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A Type status is required'
					)
				)     
			);
            		      
		
	

	
	public $useTable = 'status';
}	
?>
<?php
	/**
	* 
	*/
	App::uses('AppModel', 'Model');
	App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
	class User extends AppModel
	{
		
		
		public $vadilate = array(
			'fullname' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A fullname is required'
					)
				),
			'birthday' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A birthday is required'
					)
				),
			'email' => array(
				'email' => array(
					'rule' => 'email',
					'message' => 'Please provide a valid email address.',
					),
				'isUnique' => array(
					'rule' => 'isUnique',
					'message' => 'Email address already in use.',
					),
				),
			'username' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A username is required'
					)
				),
			'password' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A password is required'
					)
				),
            'password-new' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A password is required'
					)
				),
            'config-pass' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A password is required'
					)
				),    
                    
			);
	

	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$passwordHasher = new SimplePasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash(
				$this->data[$this->alias]['password']
				);
		}
		return true;
	}
	public $useTable = 'users';

}
?>
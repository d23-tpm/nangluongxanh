<!-- Model: Model/Contact.php -->

<?php
App::uses('AppModel', 'Model');
class Contact extends AppModel {
 var $name = 'Contacts';
    public $useTable = 'contacts';  // Not using the database, of course.

    var $validate = array(
        'name' => array(
            'rule' => '/.+/',
            'allowEmpty' => false,
            'required' => true,
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
        );



}
?>
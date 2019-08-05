<?php
App::uses('AppController', 'Controller');
class ContactsController extends AppController
{
	var $helpers = array('Html', 'Form');
	var $components = array('Email', 'Session');
	public $uses = array('Contact');
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->deny('index');
		$this->set('getemail',$this->get_email());
	}

	public function get_email(){
		$getemail = $this->Auth->user('email');
		return $getemail;
	}
	public function index() {
		
		if($this->request->is('post')){
			$this->Contact->create();
			
			$data_new = array(
				'user_id'=>$this->Auth->user('id'),
				'name'=>$this->request->data['Contact']['name'],
				'email'=>$this->Auth->user('email'),
				'message'=>$this->request->data['Contact']['message']
				);
			$this->Contact->save($data_new);	
			if(isset($this->data['Contact'])) {
			
				$userEmail = $this->Auth->user('email');
				$userMessage = $this->request->data['Contact']['message'];

				$email = new CakeEmail();
				$email->from(array($userEmail));
				$email->to('td030409@gmail.com');
				$email->subject('Thông tin phản hồi');
				$email->send($userMessage);
				if ($email->reset($userMessage)) {
					$this->Session->setFlash('Cảm ơn bạn đã liên hệ với chúng tôi','default', array('class' => 'notice success'));
				} 
				else {
					$this->Session->setFlash('Lỗi gửi mail','default', array('class' => 'cake-error'));
				}
			}	
		}
		

	}


}
?>

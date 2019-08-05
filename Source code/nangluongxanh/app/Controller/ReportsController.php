<?php
App::uses('AppController', 'Controller');
App::uses('AdminController', 'Controller');
class ReportsController extends AppController {
	
	var $helpers = array('Html', 'Form','Csv'); 
	public $uses = array('Product','Menuparent','Menuchild','Groupuser','Role','User');

	public function beforeFilter() {

		$this->Auth->allow('index', 'view');

		$this->layout = 'pageadmin';

		$this->set('username', AuthComponent::user('username'));

		$this->set('id', AuthComponent::user('id'));

		$this->layout = 'pageadmin';

		$this->set('username', $this->_usersUsername());

		$this->Auth->deny('report_hang_ton_kho','report_ton_kho');
		$this->set('countsl',$this->get_count_sl_product()); 
		$this->set('showsp_het',$this->show_sp_het());
		$this->set('listmenuparent',$this->getmenuparent());
		$this->set('listmenu',$this->getmenu());
		$this->set('getps',$this->getpermission());
    	$this->set('getpr',$this->getparentpermission());
        $this->set('getrolelogin',$this->getrolelogin());
	}
    public function getrolelogin(){
            $id_user = $this->Auth->user('id');  
            $getiterm = $this->Groupuser->find('all',array(
        
            'joins'=>array(
              array(
        
                'table' => 'users',
                'alias' => 'JUser',
                'type' =>  'LEFT',
                'foreignKey' => 'user_id',
                'conditions' => array(
                  'Groupuser.user_id = JUser.id'
                  )   
                ),
        
              array(
                'table' => 'roles',
                'alias' => 'JRole',
                'type' =>  'LEFT',
                'foreignKey' => 'role_id',
                'conditions' => array(
                  'Groupuser.role_id = JRole.id'
                  )   
                )
              ),
            'conditions'=>array(
              'JUser.id'=>$id_user
              ),
            'fields'=>array(
              'JRole.id'
              )
            )
          );
          return $getiterm;
        }
	public function getmenuparent(){
		$getmenu = $this->Menuparent->find('all');
		return $getmenu;
	}
	public function getmenu(){
		$getmn = $this->Menuchild->find('all',array(
			'joins'=>array(
				array(
					'table' => 'menuparents',
					'alias' => 'JMenuparent',
					'type' =>  'LEFT',
					'foreignKey' => 'id',
					'conditions' => array(
						'Menuchild.menu_parent_id = JMenuparent.id'
						)
					)    
				),
			'fields' => array('JMenuparent.*','Menuchild.*')
			));
		return $getmn;
	}
	public function getparentpermission(){
		$id_user = $this->Auth->user('id');
		$getmn = $this->Menuchild->find('all',array(
			'joins'=>array(
				array(
					'table' => 'menuparents',
					'alias' => 'JMenuparent',
					'type' =>  'LEFT',
					'foreignKey' => 'id',
					'conditions' => array(
						'Menuchild.menu_parent_id = JMenuparent.id'
						)
					),  
				array(
					'table' => 'menuchildrengroups',
					'alias' => 'JMenuchildrengroup',
					'type' =>  'LEFT',
					'foreignKey' => 'id',
					'conditions' => array(
						'JMenuchildrengroup.menu_child_id = Menuchild.id'
						)
					),
				array(
					'table' => 'roles',
					'alias' => 'JRole',
					'type' =>  'LEFT',
					'foreignKey' => 'id',
					'conditions' => array(
						'JMenuchildrengroup.role_id = JRole.id'
						)
					),
				array(
					'table' => 'groupusers',
					'alias' => 'JGroupuser',
					'type' =>  'LEFT',
					'foreignKey' => 'id',
					'conditions' => array(
						'JGroupuser.role_id = JRole.id'
						)
					),
				array(
					'table' => 'users',
					'alias' => 'JUser',
					'type' =>  'LEFT',
					'foreignKey' => 'id',
					'conditions' => array(
						'JGroupuser.user_id = JUser.id'
						)
					)
				),
'conditions'=>array('JUser.id'=>$id_user),
'group'=>array('JMenuparent.id'),
'fields'=>array('JMenuparent.id')
));
return $getmn;
}
public function getpermission(){
	$id_user = $this->Auth->user('id');
	$getps = $this->Menuchild->find('all',array(
		'joins'=>array(

			array(
				'table' => 'menuchildrengroups',
				'alias' => 'JMenuchildrengroup',
				'type' =>  'LEFT',
				'foreignKey' => 'id',
				'conditions' => array(
					'JMenuchildrengroup.menu_child_id = Menuchild.id'
					)
				),
			array(
				'table' => 'roles',
				'alias' => 'JRole',
				'type' =>  'LEFT',
				'foreignKey' => 'id',
				'conditions' => array(
					'JMenuchildrengroup.role_id = JRole.id'
					)
				),
			array(
				'table' => 'groupusers',
				'alias' => 'JGroupuser',
				'type' =>  'LEFT',
				'foreignKey' => 'id',
				'conditions' => array(
					'JGroupuser.role_id = JRole.id'
					)
				),
			array(
				'table' => 'users',
				'alias' => 'JUser',
				'type' =>  'LEFT',
				'foreignKey' => 'id',
				'conditions' => array(
					'JGroupuser.user_id = JUser.id'
					)
				)
			),
		'conditions'=>array('JUser.id'=>$id_user),
		'fields'=>array('Menuchild.id','Menuchild.action')
		));
	return $getps;
}
function _usersUsername(){

	$users_username = NULL;

	if($this->Auth->user()){

		$users_username = $this->Auth->user('username');

	}

	return $users_username;

}
public function get_count_sl_product(){
	$getsl = $this->Product->find('all', array('conditions'=>array('SoLuong<=3'),'fields'=>array('count(id) as items')));
	return $getsl;
}
public function show_sp_het(){
	$show_sp = $this->Product->find('all', array('conditions'=>array('SoLuong<=3'),'fields'=>array('id','TenPhone','SoLuong','HinhAnh1')));
	return $show_sp;
}
public function testiduser($id=null){
	$getiterm = $this->Groupuser->find('all',array(
		'joins'=>array(
			array(

				'table' => 'users',
				'alias' => 'JUser',
				'type' =>  'LEFT',
				'foreignKey' => 'user_id',
				'conditions' => array(
					'Groupuser.user_id = JUser.id'
					)   
				),

			array(
				'table' => 'roles',
				'alias' => 'JRole',
				'type' =>  'LEFT',
				'foreignKey' => 'role_id',
				'conditions' => array(
					'Groupuser.role_id = JRole.id'
					)   
				)
			),
		'conditions'=>array(
			'JUser.id'=>$id
			),
		'fields'=>array(
			'JRole.id'
			)
		)
	);
	return $getiterm;
}
function report_hang_ton_kho(){
    $id_user = $this->Auth->user('id');
	$getrole = $this->testiduser($id_user);
    $getps = $this->getpermission();
	if($getrole != NULL){
		if($getrole[0]['JRole']['id'] == 2)
			$this->redirect(array('controller'=>'products','action'=>'index'));
		else{
		  if($getps != NULL){
                $count=0;
                foreach ($getps as $value) {
                  if($value['Menuchild']['action']=='report_hang_ton_kho'){
                    $count++;
                    $this->set('products', $this->Product->find('all'));
                  }
                }
                if($count<1)
                    $this->redirect(array('controller'=>'admin','action'=>'index'));
            }
        }
    }
}
function report_ton_kho(){
	$id_user = $this->Auth->user('id');
	$getrole = $this->testiduser($id_user);
    $getps = $this->getpermission();
	if($getrole != NULL){
		if($getrole[0]['JRole']['id'] == 2)
			$this->redirect(array('controller'=>'products','action'=>'index'));
		else{
		  if($getps != NULL){
                $count=0;
                foreach ($getps as $value) {
                  if($value['Menuchild']['action']=='report_ton_kho'){
                    $count++;
            			$this->set('report_product', $this->Product->find('all',array('fields'=>array('MaPhone','TenPhone','MaHangSX','GiaBan','SoLuong','created'))));
            			$this->layout = null;
            			$this->autoLayout = false;
            			Configure::write('debug','0');
                      }
                  }
                  if($count<1)
                    $this->redirect(array('controller'=>'admin','action'=>'index'));
            }
		}	
	}
}

}
?>
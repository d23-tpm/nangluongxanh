<?php
App::uses('AppController', 'Controller');
App::uses('AdminController', 'Controller');
	/**
	* 
	*/
	class MenuparentsController extends AppController
	{
		var $helpers = array('Html', 'Form');
		public $uses = array('Menuparent','Menuchild','Role','Groupuser','User');
        public $components = array('ControllerList');
		public function beforeFilter() {
			parent::beforeFilter();
			$this->layout = 'pageadmin';
			$this->Auth->deny('add','add_menu_item');
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
public function add(){
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
                  if($value['Menuchild']['action']=='add'){
                    $count++;
                    if ($this->request->is('post')) {
        				$this->Menuparent->create();
        				if ($this->Menuparent->save($this->request->data)) {
        					$this->Session->setFlash('Thêm quyền thành công','default',array('class' => 'notice success'));
        					return $this->redirect(array('action' => 'add'));
        				}
        				$this->Session->setFlash('Lỗi!. Không thể lưu','default',array('class' => 'cake-error'));
        			}    
                  }
                }
                if($count<1)
                    $this->redirect(array('controller'=>'admin','action'=>'index'));
            }
		}
	}
}
public function add_menu_item(){
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
					if($value['Menuchild']['action']=='add_menu_item'){
						$count++;
                        $this->set('listcontrol',$this->ControllerList->get());
						if ($this->request->is('post')) {
								$datanew = array(
									'menu_parent_id'=>$this->request->data['Menuchild']['id'],
									'menuname'=>$this->request->data['Menuchild']['menuname'],
									'controller'=>$this->request->data['Menuchild']['controller'],
									'action'=>$this->request->data['Menuchild']['action'],
									);
								$this->Menuchild->create();
								if ($this->Menuchild->save($datanew)) {
									$this->Session->setFlash('Thêm menu lưu thành công!','default', array('class' => 'notice success'));
								} else {
									$this->Session->setFlash('Lỗi. Không thể lưu','default', array('class' => 'cake-error'));
								}
							return $this->redirect(array('action' => 'add_menu_item'));
							
						}
					}
				}
				if($count<1)
					$this->redirect(array('controller'=>'admin','action'=>'index'));
			}
		}	
	}
	
}

public function manage_menu_child(){
	$id_user = $this->Auth->user('id');
	$getrole = $this->testiduser($id_user);
	$getps = $this->getpermission();
	if($getrole!=NULL){
		if($getrole[0]['JRole']['id']==2)
			$this->redirect(array('controller'=>'products','action'=>'index'));
		else	
			if($getps != NULL){
				$count=0;
				foreach ($getps as $value) {
					if($value['Menuchild']['action']=='manage_menu_child'){
						$count++;
						//$this->set('menuparents', $this->Menuparent->find('all'));
						
						$this->paginate=array('joins'=>array(
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
						'limit' => 20,
						'fields' => array('Menuchild.id','JMenuparent.menuname','Menuchild.menuname','Menuchild.controller','Menuchild.action','Menuchild.status')
						);
						$this->set('menuchilds',$this->paginate('Menuchild'));
						//$this->set('menuchilditem', $menuchilds);
					}
				}
				if($count<1)
					$this->redirect(array('controller'=>'admin','action'=>'index'));
			}  
		}      
	}

	public function editmenuchild($id=null){
		$id_user = $this->Auth->user('id');
		$getrole = $this->testiduser($id_user);
		$getps = $this->getpermission();
		if($getrole!=NULL){
			if($getrole[0]['JRole']['id'] == 2)
				$this->redirect(array('controller'=>'products','action'=>'index'));
			else{
				if($getps != NULL){
					$count=0;
					foreach ($getps as $value) {
						if($value['Menuchild']['action']=='editmenuchild'){
							$count++;
                            $this->set('listcontrol',$this->ControllerList->get());
							$this->set('menu_parents', $this->Menuparent->find('all'));
							$this->set('get_ctrl_ac',$this->Menuchild->find('all',array(
								'conditions'=>array('id'=>$id),
								'fields' => array('controller','action')
								)));
							if (!$id) {
								throw new NotFoundException(__('Invalid post'));
							}
							$menu_child = $this->Menuchild->findById($id);
							if (!$id) {
								throw new NotFoundException(__('Invalid post'));
							}
							if ($this->request->is(array('post', 'put'))) {
								$this->Menuchild->id = $id;
								if ($this->Menuchild->save($this->request->data)) {
									$this->Session->setFlash('Cập nhật thành công !', 'default', array('class' =>
										'notice success'));
									return $this->redirect(array('action' => 'manage_menu_child'));
								}
								$this->Session->setFlash('Cập nhật không thành công. Vui lòng nhập lại',
									'default', array('class' => 'cake-error'));
							}
							if (!$this->request->data) {
								$this->request->data = $menu_child;
							}
						}
					}
					if($count<1)
						$this->redirect(array('controller'=>'admin','action'=>'index'));
				}
			}
		}	
	}
    public function deletemenuchild($id=null){
        $id_user = $this->Auth->user('id');
          $getrole = $this->testiduser($id_user);
          $getps = $this->getpermission();
          if($getrole!=NULL){
            if($getrole[0]['JRole']['id'] == 2)
              $this->redirect(array('controller'=>'products','action'=>'index'));
            else{
              if($getps != NULL){
                $count=0;
                foreach ($getps as $value) {
                  if($value['Menuchild']['action']=='deletemenuchid'){
                    $count++;
                    $this->request->onlyAllow('post');
                    $this->Menuchild->id = $id;
                    if (!$this->Menuchild->exists()) {
                      throw new NotFoundException(__('Invalid user'));
                    }
                    if ($this->Menuchild->delete()) {
                      $this->Session->setFlash('Menu đã xóa thành công !','default',array('class' => 'notice success'));
                      return $this->redirect(array('action' => 'manage_menu_child'));
                    }
                    $this->Session->setFlash('Menu không thể xóa !','default',array('class' => 'cake-error'));
                    return $this->redirect(array('action' => 'manage_menu_child'));
                  }
                }
                if($count<1)
                    $this->redirect(array('controller'=>'admin','action'=>'index'));
              }
            }	
          }
    }
    public function manage_menu_parent(){
        $id_user = $this->Auth->user('id');
    	$getrole = $this->testiduser($id_user);
    	$getps = $this->getpermission();
    	if($getrole!=NULL){
    		if($getrole[0]['JRole']['id']==2)
    			$this->redirect(array('controller'=>'products','action'=>'index'));
    		else	
    			if($getps != NULL){
    				$count=0;
    				foreach ($getps as $value) {
    					if($value['Menuchild']['action']=='manage_menu_parent'){
    						$count++;
    						$this->set('menuparents', $this->Menuparent->find('all'));
    					}
    				}
    				if($count<1)
    					$this->redirect(array('controller'=>'admin','action'=>'index'));
    			}  
    		}      
    }
    public function editmenuparent($id=null){
        $id_user = $this->Auth->user('id');
		$getrole = $this->testiduser($id_user);
		$getps = $this->getpermission();
		if($getrole!=NULL){
			if($getrole[0]['JRole']['id'] == 2)
				$this->redirect(array('controller'=>'products','action'=>'index'));
			else{
				if($getps != NULL){
					$count=0;
					foreach ($getps as $value) {
						if($value['Menuchild']['action']=='editmenuparent'){
							$count++;
							if (!$id) {
								throw new NotFoundException(__('Invalid post'));
							}
							$menu_parent = $this->Menuparent->findById($id);
							if (!$id) {
								throw new NotFoundException(__('Invalid post'));
							}
							if ($this->request->is(array('post', 'put'))) {
								$this->Menuparent->id = $id;
								if ($this->Menuparent->save($this->request->data)) {
									$this->Session->setFlash('Cập nhật thành công !', 'default', array('class' =>
										'notice success'));
									return $this->redirect(array('action' => 'manage_menu_parent'));
								}
								$this->Session->setFlash('Cập nhật không thành công. Vui lòng nhập lại',
									'default', array('class' => 'cake-error'));
							}
							if (!$this->request->data) {
								$this->request->data = $menu_parent;
							}
						}
					}
					if($count<1)
						$this->redirect(array('controller'=>'admin','action'=>'index'));
				}
			}
		}	
    }
    public function deletemenuparent($id=null){
        $id_user = $this->Auth->user('id');
          $getrole = $this->testiduser($id_user);
          $getps = $this->getpermission();
          if($getrole!=NULL){
            if($getrole[0]['JRole']['id'] == 2)
              $this->redirect(array('controller'=>'products','action'=>'index'));
            else{
              if($getps != NULL){
                $count=0;
                foreach ($getps as $value) {
                  if($value['Menuchild']['action']=='deletemenuparent'){
                    $count++;
                    $this->request->onlyAllow('post');
                    $this->Menuparent->id = $id;
                    if (!$this->Menuparent->exists()) {
                      throw new NotFoundException(__('Invalid user'));
                    }
                    if ($this->Menuparent->delete()) {
                      $this->Session->setFlash('Menu đã xóa thành công !','default',array('class' => 'notice success'));
                      return $this->redirect(array('action' => 'manage_menu_child'));
                    }
                    $this->Session->setFlash('Menu không thể xóa !','default',array('class' => 'cake-error'));
                    return $this->redirect(array('action' => 'manage_menu_child'));
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
<?php
App::uses('AppController', 'Controller');
App::uses('AdminController', 'Controller');
	/**
	* 
	*/
	class MenuchildrengroupsController extends AppController
	{

		var $helpers = array('Html','Form','Ajax','Javascript');
		var $components=array('RequestHandler');
		public $uses = array('Menuparent','Menuchild','Menuchildrengroup','Role','Groupuser','User');
		public function beforeFilter() {
			parent::beforeFilter();
			$this->layout = 'pageadmin';
			$this->Auth->deny('add','add_menu_item');
			$this->set('countsl',$this->get_count_sl_product()); 
			$this->set('showsp_het',$this->show_sp_het());
			$this->set('listmenuparent',$this->getmenuparent());
			$this->set('listmenu',$this->getmenu());
			$this->set('getroles',$this->get_role_id());
			$this->set('listchild',$this->getmenuchild());
			$this->set('options',$this->getlist_choose());
			$this->set('name_role',$this->getnamerole());
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
		public function getnamerole(){
			$id = $_GET['role_id'];
			$getnamerole = $this->Role->find('all',array('conditions'=>array('id'=>$id),'fields'=>array('role_name')));
			return $getnamerole;
		} 
		public function getmenuparent(){
			$getmenu = $this->Menuparent->find('all');
			return $getmenu;
		}
		public function getmenuchild(){
			$getmnchild = $this->Menuchild->find('all');
			return $getmnchild;
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
public function get_role_id(){
	$getrl = $this->Role->find('all');
	return $getrl;
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
public function add_permission_by_group(){

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
                  if($value['Menuchild']['action']=='add_permission_by_group'){
                    $count++;
                    if ($this->request->is('post')) {
        				$this->Menuchildrengroup->query('delete from menuchildrengroups where role_id='.$this->request->data['Menuchildrengroup']['role_id']);		
        				$count = $this->request->data['Menuchildrengroup']['menu_child_id'];
        				foreach ($count as $value) {
        
        					$datanew = array(
        						'role_id' => $this->request->data['Menuchildrengroup']['role_id'],
        						'menu_child_id'=> $value,
        						);
        					$this->Menuchildrengroup->create();
        					if ($this->Menuchildrengroup->save($datanew)) {
        						$this->Session->setFlash('Phân quyền lưu thành công!','default', array('class' => 'notice success'));
        					} else {
        						$this->Session->setFlash('Lỗi. Không thể lưu','default', array('class' => 'cake-error'));
        					}
        				}
        
        				return $this->redirect(array('action' => 'add_permission_by_group?role_id='.$this->request->data['Menuchildrengroup']['role_id']));	
        
        			}  
                  }
                }
                if($count<1)
                    $this->redirect(array('controller'=>'admin','action'=>'index'));
            }
		}

	}
}

function getlist_choose(){
	
	$id = $_GET['role_id'];
	$list_active = array();
	$list_active = 	$this->Menuchildrengroup->find('all',
		array(
			'joins'=>array(
				array(
					'table' => 'menuchilds',
					'alias' => 'JMenuchilds',
					'type' =>  'LEFT',
					'foreignKey' => 'id',
					'conditions' => array(
						'Menuchildrengroup.menu_child_id = JMenuchilds.id'
						)
					)    
				),
			'conditions'=>array('Menuchildrengroup.role_id'=>$id),
			'fields' => array('JMenuchilds.id','JMenuchilds.menuname')
			)
		);
	return $list_active;
	
}

}
?>
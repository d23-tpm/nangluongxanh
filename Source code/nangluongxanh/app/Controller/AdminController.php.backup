<?php
App::uses('AppController', 'Controller');


class AdminController  extends AppController{

	var $helpers = array('Html', 'Form');
  var $components = array('Email', 'Session');
  public $uses = array('Hangsx','User','Product','Role','Status','Order','Orderdetail','Menuparent','Menuchild','Groupuser','Menuchildrengroup','Contact');

  public function beforeFilter() {

    $this->Auth->allow('index', 'view');

    $this->layout = 'pageadmin';

    $this->set('username', AuthComponent::user('username'));

    $this->set('id', AuthComponent::user('id'));

    $this->layout = 'pageadmin';

    $this->set('username', $this->_usersUsername());

    $this->Auth->deny('addhsx','index','indexhsx','manageuser','managehsx','addproduct','manageproduct');

    $this->set('namehsx', $this->gethsx());
    $this->set('rolename', $this->getrole());
    $this->set('trangthai', $this->get_status_by_id());
    $this->set('users', $this->User->find('all'));
    $this->set('countsl',$this->get_count_sl_product()); 
    $this->set('showsp_het',$this->show_sp_het());
    $this->set('listmenu',$this->getmenu());
    $this->set('listmenuparent',$this->getmenuparent());
    $this->set('getrolelogin',$this->getrolelogin());
    $this->set('getps',$this->getpermission());
    $this->set('getpr',$this->getparentpermission());

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
public function index() {
 $id_user = $this->Auth->user('id');
 $getrole = $this->testiduser($id_user);
 $this->set('count_da_duyet',$this->Order->find('all',array('conditions'=>array('status_id'=>6),'fields'=>array('count(id) as dem'))));
 $this->set('count_chua_duyet',$this->Order->find('all',array('conditions'=>array('status_id'=>5),'fields'=>array('count(id) as dem'))));
 $this->set('count_user',$this->User->find('all',array('conditions'=>array('status_user'=>2),'fields'=>array('count(id) as dem'))));
 $this->set('count_contact',$this->Contact->find('all',array('conditions'=>array('status'=>2),'fields'=>array('count(id) as dem'))));
 if($getrole!=NULL){
  if($getrole[0]['JRole']['id'] == 2)
    $this->redirect(array('controller'=>'products','action'=>'index'));
}
}

public function manageuser() {
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
          if($value['Menuchild']['action']=='manageuser'){
            $count++;
            $this->set('users', $this->User->find('all'));
          }
        }
        if($count<1)
          $this->redirect(array('controller'=>'admin','action'=>'index'));
      }  
    }      
  }
  public function addhsx(){

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
          if($value['Menuchild']['action']=='addhsx'){
            $count++;
            if ($this->request->is('post')) {
              $this->Hangsx->create();
              $hangsx = $this->Hangsx->find('all');
              if($this->request->data['Hangsx']['MaHangSX']!=$hangsx[0]['Hangsx']['MaHangSX'] ){
               if($this->request->data['Hangsx']['TenHangSX']!=$hangsx[0]['Hangsx']['TenHangSX']){
                if ($this->Hangsx->save($this->request->data)) {
                 $this->Session->setFlash('Hãng sản xuất lưu thành công!','default', array('class' => 'notice success'));
                 return $this->redirect(array('action' => 'addhsx'));
               }
               $this->Session->setFlash('Lỗi. Không thể lưu','default', array('class' => 'cake-error'));
             }else
             $this->Session->setFlash('Tên HSX đã tồn tài. Vui lòng nhập lại!','default', array('class' => 'cake-error'));
           }
           else
             $this->Session->setFlash('Mã HSX đã tồn tài. Vui lòng nhập lại!','default', array('class' => 'cake-error'));
         }
       }
     }
     if($count<1)
      $this->redirect(array('controller'=>'admin','action'=>'index'));
  }  
}
}
}

public function managehsx() {
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
        if($value['Menuchild']['action']=='managehsx'){
          $count++;
          $this->set('HangSX', $this->Hangsx->find('all')); 
        }
      }
      if($count<1)
        $this->redirect(array('controller'=>'admin','action'=>'index'));
    }
  }        
}


}
public function edithsx($id=null){
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
        if($value['Menuchild']['action']=='edithsx'){
          $count++;
          if (!$id) {
            throw new NotFoundException(__('Invalid post'));
          }
          $HangSX = $this->Hangsx->findById($id);
          if (!$id) {
            throw new NotFoundException(__('Invalid post'));
          }
          if ($this->request->is(array('post', 'put'))) {
            $this->Hangsx->id = $id;
            if ($this->Hangsx->save($this->request->data)) {
              $this->Session->setFlash('Cập nhật thành công !', 'default', array('class' =>
                'notice success'));
              return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash('Cập nhật không thành công. Vui lòng nhập lại',
              'default', array('class' => 'cake-error'));
          }
          if (!$this->request->data) {
            $this->request->data = $HangSX;
          }
        }
      }
      if($count<1)
        $this->redirect(array('controller'=>'admin','action'=>'index'));
    }
  }
}	
}
public function deletehsx($id = null){
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
          if($value['Menuchild']['action']=='deletehsx'){
            $count++;
            $this->request->onlyAllow('post');
            $this->Hangsx->id = $id;
            if (!$this->Hangsx->exists()) {
              throw new NotFoundException(__('Invalid user'));
            }
            if ($this->Hangsx->delete()) {
              $this->Session->setFlash('Hãng Sản Xuất đã xóa thành công !','default',array('class' => 'notice success'));
              return $this->redirect(array('controller'=>'admin','action' => 'index'));
            }
            $this->Session->setFlash('Hãng Sản Xuất không thể xóa !','default',array('class' => 'cake-error'));
            return $this->redirect(array('controller'=>'admin','action' => 'managehsx'));
          }
        }
        if($count<1)
          $this->redirect(array('controller'=>'admin','action'=>'index'));
      }
    }	
  }
}
function gethsx(){
  $hsx = array();
  $hangsx = $this->Hangsx->find('all');
  foreach ($hangsx as $key=>$value) {
   $hsx[]=array(
    "MaHangSX"=>$value['Hangsx']['MaHangSX'],
    "TenHangSX"=>$value['Hangsx']['TenHangSX']
    );
 }
 return $hsx;
}
public function addproduct(){
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
        if($value['Menuchild']['action']=='addproduct'){
          $count++;
          if ($this->request->is('post')) {
           $this->Product->create();
           for($i=1;$i<4;$i++)
           {
            if(empty($this->data['Product']['HinhAnh'.$i]['name'])){
              unset($this->request->data['Product']['HinhAnh'.$i]);
            }
            if(!empty($this->data['Product']['HinhAnh'.$i]['name']))
            {
              $file=$this->data['Product']['HinhAnh'.$i];
                        $ary_ext=array('jpg','jpeg','gif','png'); //array of allowed extensions
                        $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                        if(in_array($ext, $ary_ext))
                        {
                          move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/uploads/products/' . time().$file['name']);
                          $this->request->data['Product']['HinhAnh'.$i] = time().$file['name'];
                        }
                      }
                    }
                    if ($this->Product->save($this->request->data)) {
                      $this->Session->setFlash('Thêm sản phẩm thành công','default',array('class' => 'notice success'));
                      return $this->redirect(array('action' => 'index'));
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
      public function manageproduct(){

        $id_user = $this->Auth->user('id');
        $getrole = $this->testiduser($id_user);
        $getps = $this->getpermission();
        if($getrole!=NULL)
        {
          if($getrole[0]['JRole']['id'] == 2)
           $this->redirect(array('controller'=>'products','action'=>'index'));
          else{
            if($getps != NULL){
              $count=0;
              foreach ($getps as $value) {
                if($value['Menuchild']['action']=='manageproduct'){
                  $count++;
                  $this->paginate = array(
                   'limit' => 6,
                   'order' => array('Product.created' => 'desc'),
                   'fields' => array('Product.*'));
                  $products = $this->paginate('Product');
                  $this->set('products', $products);
                }
              }
              if($count<1)
               $this->redirect(array('controller'=>'admin','action'=>'index'));   
           }  
       }	
     }       
   }

   public function editproduct($id = null){
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
          if($value['Menuchild']['action']=='editproduct'){
            $count++;
            if (!$id) {
              throw new NotFoundException(__('Invalid post'));
            }
            $product = $this->Product->findById($id);
            if (!$product) {
              throw new NotFoundException(__('Invalid post'));
            }
            if ($this->request->is(array('post', 'put'))) {
              $this->Product->id = $id;
              for($i=1;$i<4;$i++)
              {
                if(empty($this->data['Product']['HinhAnh'.$i]['name'])){
                  unset($this->request->data['Product']['HinhAnh'.$i]);
                }
                if(!empty($this->data['Product']['HinhAnh'.$i]['name']))
                {
                 if(file_exists("img/uploads/products/".$this->data['Product']['HinhAnh'.$i])){
                  unlink("img/uploads/products/".$this->data['Product']['HinhAnh'.$i]);
                }
                $file=$this->data['Product']['HinhAnh'.$i];
                        $ary_ext=array('jpg','jpeg','gif','png'); //array of allowed extensions
                        $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                        if(in_array($ext, $ary_ext))
                        {
                          move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/uploads/products/' . time().$file['name']);
                          $this->request->data['Product']['HinhAnh'.$i] = time().$file['name'];
                        }
                      }
                    }
                    if ($this->Product->save($this->request->data)) {
                      $this->Session->setFlash('Cập nhật thành công.','default',array('class' => 'notice success'));
                      return $this->redirect(array('action' => 'manageproduct'));
                    }
                    $this->Session->setFlash('Cập nhật không thành công.','default',array('class' => 'cake-error'));
                  }
                  if (!$this->request->data) {
                   $this->request->data = $product;
                 }
               }
             }
             if($count<1)
              $this->redirect(array('controller'=>'admin','action'=>'index'));
          }
        }
      } 	
    }

    public function deleteproduct($id = null)
    {
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
            if($value['Menuchild']['action']=='deleteproduct'){
              $count++;
              $this->request->onlyAllow('post');
              $this->Product->id = $id;
              if (!$this->Product->exists()) {
                throw new NotFoundException(__('Invalid user'));
              }
              if ($this->Product->delete()) {
                $this->Session->setFlash('Sản phẩm đã xóa thành công !','default',array('class' => 'notice success'));
                return $this->redirect(array('controller'=>'admin','action' => 'index'));
              }
              $this->Session->setFlash('Sản phẩm không thể xóa !','default',array('class' => 'cake-error'));
              return $this->redirect(array('controller'=>'admin','action' => 'manageproduct'));
            }
          }
          if($count<1)
            $this->redirect(array('controller'=>'admin','action'=>'index'));
        }
      }
    }
  }
  function getrole(){
    $ps = array();
    $role = $this->Role->find('all');
    foreach ($role as $key=>$value) {
     $ps[]=array(
      "id"=>$value['Role']['id'],
      "role_name"=>$value['Role']['role_name']
      );
   }
   return $ps;
 }

 function get_status_by_id(){
  $th = $this->Groupuser->find('all', array(
    'joins' => array(
      array(
        'table' => 'roles',
        'alias' => 'JRole',
        'type' =>  'LEFT',
        'foreignKey' => 'id',
        'conditions' => array(
          'Groupuser.role_id = JRole.id'
          )    
        ),
      array(
        'table' => 'users',
        'alias' => 'JUser',
        'type' =>  'LEFT',
        'foreignKey' => 'id',
        'conditions' => array(
          'Groupuser.user_id = JUser.id'
          )    
        )),
    'fields' => array('JRole.role_name','JUser.*')
    ));
  return $th;
}
public function edituser($id = null)
{
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
          if($value['Menuchild']['action']=='edituser'){
            $count++;
            $this->User->id = $id;
            if (!$this->User->exists()) {
              throw new NotFoundException(__('Invalid user'));
            }
            if ($this->request->is('post') || $this->request->is('put')) {
              $users = $this->User->find('all');
              $this->Groupuser->query('update groupusers set role_id='.$this->request->data['User']['role_id'].' WHERE user_id='.$id);
              $ngaysinh = $this->request->data['User']['birthday'];
              //$newday = DateTime::createFromFormat('d/m/Y', $ngaysinh)->format('Y-m-d');
              $datanew = array(
                'fullname' => $this->request->data['User']['fullname'],
                'sex' => $this->request->data['User']['sex'],
                'birthday' => $ngaysinh,
                'address' => $this->request->data['User']['address'],
                'numberphone' => $this->request->data['User']['numberphone'],
                'email' => $this->request->data['User']['email'],
                'status_user'=>$this->request->data['User']['status_user']);
              if ($this->User->save($datanew)) {
                $this->Session->setFlash('Cập nhật thành công !', 'default', array('class' =>
                  'notice success'));
                return $this->redirect(array('action' => 'manageuser'));
              }
              $this->Session->setFlash('Cập nhật không thành công. Vui lòng nhập lại',
                'default', array('class' => 'cake-error'));
            } else {
              $this->request->data = $this->User->read(null, $id);
              unset($this->request->data['User']['password']);
            }
            $this->set('getidactive',$this->Groupuser->find('all', array(
              'joins' => array(
                array(
                  'table' => 'roles',
                  'alias' => 'JRole',
                  'type' =>  'LEFT',
                  'foreignKey' => 'id',
                  'conditions' => array(
                    'Groupuser.role_id = JRole.id'
                    )    
                  ),
                array(
                  'table' => 'users',
                  'alias' => 'JUser',
                  'type' =>  'LEFT',
                  'foreignKey' => 'id',
                  'conditions' => array(
                    'Groupuser.user_id = JUser.id'
                    )    
                  )),
              'conditions'=>array('JUser.id'=>$id),
              'fields' => array('JRole.id')
              )));
          }
        }
        if($count<1)
          $this->redirect(array('controller'=>'admin','action'=>'index'));
      } 
    } 
  }     
}
public function deleteuser($id = null)
{
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
        if($value['Menuchild']['action']=='deleteuser'){
          $count++;
          $this->request->onlyAllow('post');
          $this->User->id = $id;
          if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
          }
          if ($this->User->delete()) {
            $this->Session->setFlash('User đã xóa thành công !','default',array('class' => 'notice success'));
            return $this->redirect(array('controller'=>'admin','action' => 'manageuser'));
          }
          $this->Session->setFlash('User không thể xóa !','default',array('class' => 'cake-error'));
          return $this->redirect(array('controller'=>'admin','action' => 'manageuser'));
        }
      }
      if($count<1)
        $this->redirect(array('controller'=>'admin','action'=>'index'));
    }
  }	
}
}
public function addstatus() {
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
          if($value['Menuchild']['action']=='addstatus'){
            $count++;
            if ($this->request->is('post')) {
              $this->Status->create();
              if ($this->Status->save($this->request->data)) {
                $this->Session->setFlash('Thêm trạng thái thành công','default',array('class' => 'notice success'));
                return $this->redirect(array('action' => 'addstatus'));
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
public function managestatus() {
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
          if($value['Menuchild']['action']=='managestatus'){
            $count++;
            $this->set('status', $this->Status->find('all'));
          }
        }
        if($count<1)
          $this->redirect(array('controller'=>'admin','action'=>'index'));
      }    
    }		          
  }
}
public function editstatus($id=null){

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
        if($value['Menuchild']['action']=='editstatus'){
          $count++;
          if (!$id) {
            throw new NotFoundException(__('Invalid post'));
          }
          $Status = $this->Status->findById($id);
          if (!$id) {
            throw new NotFoundException(__('Invalid post'));
          }
          if ($this->request->is(array('post', 'put'))) {
            $this->Status->id = $id;
            if ($this->Status->save($this->request->data)) {
              $this->Session->setFlash('Cập nhật thành công !', 'default', array('class' =>
                'notice success'));
              return $this->redirect(array('action' => 'managestatus'));
            }
            $this->Session->setFlash('Cập nhật không thành công. Vui lòng nhập lại',
              'default', array('class' => 'cake-error'));
          }
          if (!$this->request->data) {
            $this->request->data = $Status;
          }
        } 
      }
      if($count<1)
        $this->redirect(array('controller'=>'admin','action'=>'index'));
    }
  }
}	
}
public function deletestatus($id = null){
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
        if($value['Menuchild']['action']=='deletestatus'){
          $count++;
          $this->request->onlyAllow('post');
          $this->Status->id = $id;
          if (!$this->Status->exists()) {
            throw new NotFoundException(__('Invalid user'));
          }
          if ($this->Status->delete()) {
            $this->Session->setFlash('Trạng thái đã xóa thành công !','default',array('class' => 'notice success'));
            return $this->redirect(array('controller'=>'admin','action' => 'managestatus'));
          }
          $this->Session->setFlash('Trạng thái không thể xóa !','default',array('class' => 'cake-error'));
          return $this->redirect(array('controller'=>'admin','action' => 'managestatus'));
        }
      }
      if($count<1)
        $this->redirect(array('controller'=>'admin','action'=>'index')); 
    }
  }	
}
}
public function managerole() {
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
          if($value['Menuchild']['action']=='managerole'){
            $count++;
            $this->set('roles', $this->Role->find('all'));  
          }
        }
        if($count<1)
          $this->redirect(array('controller'=>'admin','action'=>'index'));
      }
    }
  }      
}
public function addrole() {
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
          if($value['Menuchild']['action']=='addrole'){
            $count++;
            if ($this->request->is('post')) {
              $this->Role->create();
              if ($this->Role->save($this->request->data)) {
                $this->Session->setFlash('Thêm quyền thành công','default',array('class' => 'notice success'));
                return $this->redirect(array('action' => 'addrole'));
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
public function editrole($id=null){
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
        if($value['Menuchild']['action']=='editrole'){
          $count++;
          if (!$id) {
            throw new NotFoundException(__('Invalid post'));
          }
          $Role = $this->Role->findById($id);
          if (!$id) {
            throw new NotFoundException(__('Invalid post'));
          }
          if ($this->request->is(array('post', 'put'))) {
            $this->Role->id = $id;
            if ($this->Role->save($this->request->data)) {
              $this->Session->setFlash('Cập nhật thành công !', 'default', array('class' =>
                'notice success'));
              return $this->redirect(array('action' => 'managerole'));
            }
            $this->Session->setFlash('Cập nhật không thành công. Vui lòng nhập lại',
              'default', array('class' => 'cake-error'));
          }
          if (!$this->request->data) {
            $this->request->data = $Role;
          }
        }
      }
      if($count<1)
        $this->redirect(array('controller'=>'admin','action'=>'index'));
    }
  }	
}
}
public function deleterole($id = null)
{
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
        if($value['Menuchild']['action']=='deleterole'){
          $count++;
          $this->request->onlyAllow('post');
          $this->Role->id = $id;
          if (!$this->Role->exists()) {
            throw new NotFoundException(__('Invalid user'));
          }
          if ($this->Role->delete()) {
            $this->Session->setFlash('Trạng thái đã xóa thành công !','default',array('class' => 'notice success'));
            return $this->redirect(array('controller'=>'admin','action' => 'managerole'));
          }
          $this->Session->setFlash('Trạng thái không thể xóa !','default',array('class' => 'cake-error'));
          return $this->redirect(array('controller'=>'admin','action' => 'managerole'));
        }
      }
      if($count<1)
        $this->redirect(array('controller'=>'admin','action'=>'index'));
    }
  }	
}
}

public function orderduyet(){
  $id_user = $this->Auth->user('id');
  $getrole = $this->testiduser($id_user);
  $getps = $this->getpermission();
  if($getrole!=NULL){
    if($getrole[0]['JRole']['id'] == 2)
     $this->redirect(array('controller'=>'products','action'=>'index'));
   else{
    if($getps != NULL){
      $count = 0;  
      foreach ($getps as $value) {
        if($value['Menuchild']['action']=='orderduyet'){
          $count++;
          $this->set('orderduyet', $this->Order->find('all',array(
            'joins' => array(
              array(
               'table' => 'users',
               'alias' => 'fk_users',
               'type' => 'LEFT',
               'foreignKey'=>true,
               'conditions' => array(
                'fk_users.id = Order.user_id'
                )
               )
              ),
            'conditions'=>array(
              'Order.status_id'=>6
              ),
            'fields' => array(
              'Order.NgayLap',
              'Order.id',
              'Order.NgayGiaoHang',
              'fk_users.fullname',
              'Order.HinhThucThanhToan',
              'Order.DiaChiNguoiNhan',
              'Order.DienThoaiNguoiNhan'
              )       
            )));  
        }
      }
      if($count<1)
        $this->redirect(array('controller'=>'admin','action'=>'index'));
    }
  }  
}    
}
public function deleteorderduyet($id = null){

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
        if($value['Menuchild']['action']=='deleteorderduyet'){
          $count++;  
          $this->request->onlyAllow('post');
          $this->Orderdetail->id = $id;
          $order_id = $this->Orderdetail->find('all',array(
            'joins'=>array(

              array(
                'table' => 'orders',
                'alias' => 'fk_orders',
                'type' => 'LEFT',
                'foreignKey'=>'order_id',
                'conditions' => array(
                  'fk_orders.id = Orderdetail.order_id'
                  ) 
                )
              ),
            'conditions'=>array(
              'Orderdetail.id'=>$id
              ),
            'fields'=>array('fk_orders.id')
            ));
                //print_r($order_id);die();
          $this->Order->id = $order_id[0]['fk_orders']['id'];
          if (!$this->Orderdetail->exists()) {
            throw new NotFoundException(__('Invalid user'));
          }
          if ($this->Orderdetail->delete()) {
            $this->Order->delete();
            $this->Session->setFlash('Đơn hàng đã xóa thành công !','default',array('class' => 'notice success'));
            return $this->redirect(array('controller'=>'admin','action' => 'orderduyet'));
          }
          $this->Session->setFlash('Đơn hàng không thể xóa !','default',array('class' => 'cake-error'));
          return $this->redirect(array('controller'=>'admin','action' => 'orderduyet'));
        }
      }
      if($count<1)
        $this->redirect(array('controller'=>'admin','action'=>'index'));
    }
  }  
}  
}
public function orderchuaduyet(){
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
        if($value['Menuchild']['action']=='orderchuaduyet'){
          $count++;
          $this->set('orderduyet', $this->Order->find('all',array(
            'joins' => array(
              array(
                'table' => 'users',
                'alias' => 'fk_users',
                'type' => 'LEFT',
                'foreignKey'=>true,
                'conditions' => array(
                  'fk_users.id = Order.user_id'
                  )
                )
              ),
            'conditions'=>array(
              'Order.status_id'=>5
              ),
            'fields' => array(
              'Order.NgayLap',
              'Order.id',
              'Order.NgayGiaoHang',
              'fk_users.fullname',
              'Order.HinhThucThanhToan',
              'Order.DiaChiNguoiNhan',
              'Order.DienThoaiNguoiNhan'
              )       
            ))); 
        }
      }
      if($count<1)
        $this->redirect(array('controller'=>'admin','action'=>'index'));
    }
  }
}       
}
public function duyet($id = null){
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
        if($value['Menuchild']['action']=='duyet'){
          $count++;
          $this->Order->updateAll(array('status_id' => '6'),array('id' => $this->Order->id=$id)); 
          $this->Session->setFlash('Đơn hàng đã duyệt !','default',array('class' => 'notice success'));
          return $this->redirect(array('controller'=>'admin','action' => 'orderchuaduyet'));
        }
      }
      if($count<1)
        $this->redirect(array('controller'=>'admin','action'=>'index'));
    }
  }
}    
}
public function view_order_duyet($id=null){
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
        if($value['Menuchild']['action']=='view_order_duyet'){
          $count++;
          $this->set('orderduyet', $this->Orderdetail->find('all',array(
            'joins' => array(
              array(
                'table' => 'orders',
                'alias' => 'fk_orders',
                'type' => 'LEFT',
                'foreignKey'=>'order_id',
                'conditions' => array(
                  'fk_orders.id = Orderdetail.order_id'
                  )
                ),
              array(
                'table' => 'products',
                'alias' => 'fk_products',
                'type' => 'LEFT',
                'foreignKey'=>'product_id',
                'conditions' => array(
                  'fk_products.id = Orderdetail.product_id'
                  )
                ),
              array(
                'table' => 'users',
                'alias' => 'fk_users',
                'type' => 'LEFT',
                'foreignKey'=>true,
                'conditions' => array(
                  'fk_users.id = fk_orders.user_id'
                  )
                )
              ),
            'conditions'=>array(
              'fk_orders.status_id'=>6,
              'fk_orders.id'=> $this->Order->id=$id
              ),
            'fields' => array(
              'Orderdetail.id',
              'fk_orders.NgayLap',
              'fk_orders.NgayGiaoHang',
              'fk_users.fullname',
              'fk_products.TenPhone',
              'fk_products.GiaBan',
              'fk_products.GiamGia',
              'Orderdetail.SoLuong',
              )       
            ))); 
}
}
if($count<1)
  $this->redirect(array('controller'=>'admin','action'=>'index'));  
}   
}          
}
}
public function view_order_no_duyet($id = null){
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
        if($value['Menuchild']['action']=='view_order_no_duyet'){
          $count++;
          $this->set('orderduyet', $this->Orderdetail->find('all',array(
            'joins' => array(
              array(
                'table' => 'orders',
                'alias' => 'fk_orders',
                'type' => 'LEFT',
                'foreignKey'=>'order_id',
                'conditions' => array(
                  'fk_orders.id = Orderdetail.order_id'
                  )
                ),
              array(
                'table' => 'products',
                'alias' => 'fk_products',
                'type' => 'LEFT',
                'foreignKey'=>'product_id',
                'conditions' => array(
                  'fk_products.id = Orderdetail.product_id'
                  )
                ),
              array(
                'table' => 'users',
                'alias' => 'fk_users',
                'type' => 'LEFT',
                'foreignKey'=>true,
                'conditions' => array(
                  'fk_users.id = fk_orders.user_id'
                  )
                )
              ),
            'conditions'=>array(
              'fk_orders.status_id'=>5,
              'fk_orders.id'=> $this->Order->id=$id
              ),
            'fields' => array(
              'Orderdetail.id',
              'fk_orders.NgayLap',
              'fk_orders.NgayGiaoHang',
              'fk_users.fullname',
              'fk_products.TenPhone',
              'fk_products.GiaBan',
              'fk_products.GiamGia',
              'Orderdetail.SoLuong',
              )       
            )));  
}
}
if($count<1)
  $this->redirect(array('controller'=>'admin','action'=>'index'));
}
}   
}         
}
public function order_by_month(){
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
        if($value['Menuchild']['action']=='order_by_month'){
          $count++;
          if(isset($_GET['thang'])&&isset($_GET['nam'])&&$_GET['thang']!=0&&$_GET['nam']!=0){
            $month = $_GET['thang'];
            $year = $_GET['nam'];
            $month_date = $month.'-'.$year;

            $this->set('orderduyet', $this->Orderdetail->find('all',array(
              'joins' => array(
                array(
                  'table' => 'orders',
                  'alias' => 'fk_orders',
                  'type' => 'LEFT',
                  'foreignKey'=>'order_id',
                  'conditions' => array(
                    'fk_orders.id = Orderdetail.order_id'
                    )

                  ),
                array(
                  'table' => 'products',
                  'alias' => 'fk_products',
                  'type' => 'LEFT',
                  'foreignKey'=>'product_id',
                  'conditions' => array(
                    'fk_products.id = Orderdetail.product_id'
                    )
                  ),
                array(
                  'table' => 'users',
                  'alias' => 'fk_users',
                  'type' => 'LEFT',
                  'foreignKey'=>true,
                  'conditions' => array(
                    'fk_users.id = fk_orders.user_id'
                    )
                  )
                ),
              'conditions'=>array(
                'fk_orders.status_id'=>6,
                'DATE_FORMAT(fk_orders.NgayLap,"%m-%Y")'=> $month_date
                ),
              'fields' => array(
                'Orderdetail.id',
                'fk_orders.NgayLap',
                'fk_orders.NgayGiaoHang',
                'fk_users.fullname',
                'fk_products.TenPhone',
                'fk_products.GiaBan',
                'fk_products.GiamGia',
                'Orderdetail.SoLuong',
                )       
              )));           
}
else      
 $this->set('orderduyet', $this->Orderdetail->find('all',array(
  'joins' => array(
    array(
      'table' => 'orders',
      'alias' => 'fk_orders',
      'type' => 'LEFT',
      'foreignKey'=>'order_id',
      'conditions' => array(
        'fk_orders.id = Orderdetail.order_id'
        )

      ),
    array(
      'table' => 'products',
      'alias' => 'fk_products',
      'type' => 'LEFT',
      'foreignKey'=>'product_id',
      'conditions' => array(
        'fk_products.id = Orderdetail.product_id'
        )
      ),
    array(
      'table' => 'users',
      'alias' => 'fk_users',
      'type' => 'LEFT',
      'foreignKey'=>true,
      'conditions' => array(
        'fk_users.id = fk_orders.user_id'
        )
      )
    ),
  'conditions'=>array(
    'fk_orders.status_id'=>6,
    ),
  'fields' => array(
    'Orderdetail.id',
    'fk_orders.NgayLap',
    'fk_orders.NgayGiaoHang',
    'fk_users.fullname',
    'fk_products.TenPhone',
    'fk_products.GiaBan',
    'fk_products.GiamGia',
    'Orderdetail.SoLuong',
    )       
  ))); 
}
}
if($count<1)
  $this->redirect(array('controller'=>'admin','action'=>'index'));
}
} 
}          
}
public function doanhthu_order_by_month(){
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
        if($value['Menuchild']['action']=='doanhthu_order_by_month'){
          $count++;
          if(isset($_GET['thang'])&&isset($_GET['nam'])&&$_GET['thang']!=0&&$_GET['nam']!=0){
            $month = $_GET['thang'];
            $year = $_GET['nam'];
            $month_date = $month.'-'.$year;
            $this->set('doanhthu', $this->Orderdetail->find('all',array(
              'joins' => array(
                array(
                  'table' => 'orders',
                  'alias' => 'fk_orders',
                  'type' => 'LEFT',
                  'foreignKey'=>'order_id',
                  'conditions' => array(
                    'fk_orders.id = Orderdetail.order_id'
                    )

                  ),
                array(
                  'table' => 'products',
                  'alias' => 'fk_products',
                  'type' => 'LEFT',
                  'foreignKey'=>'product_id',
                  'conditions' => array(
                    'fk_products.id = Orderdetail.product_id'
                    )
                  ),
                array(
                  'table' => 'users',
                  'alias' => 'fk_users',
                  'type' => 'LEFT',
                  'foreignKey'=>true,
                  'conditions' => array(
                    'fk_users.id = fk_orders.user_id'
                    )
                  )
                ),
              'conditions'=>array(
                'fk_orders.status_id'=>6,
                'DATE_FORMAT(fk_orders.NgayLap,"%m-%Y")'=> $month_date
                ),
              'fields' => array(
                'Orderdetail.id',
                'fk_orders.NgayLap',
                'fk_orders.NgayGiaoHang',
                'fk_users.fullname',
                'fk_products.TenPhone',
                'fk_products.GiaBan',
                'fk_products.GiamGia',
                'Orderdetail.SoLuong',
                )       
              )));           
}
else        
 $this->set('doanhthu', $this->Orderdetail->find('all',array(
  'joins' => array(
    array(
      'table' => 'orders',
      'alias' => 'fk_orders',
      'type' => 'LEFT',
      'foreignKey'=>'order_id',
      'conditions' => array(
        'fk_orders.id = Orderdetail.order_id'
        )
      ),
    array(
      'table' => 'products',
      'alias' => 'fk_products',
      'type' => 'LEFT',
      'foreignKey'=>'product_id',
      'conditions' => array(
        'fk_products.id = Orderdetail.product_id'
        )
      ),
    array(
      'table' => 'users',
      'alias' => 'fk_users',
      'type' => 'LEFT',
      'foreignKey'=>true,
      'conditions' => array(
        'fk_users.id = fk_orders.user_id'
        )
      )
    ),
  'conditions'=>array(
    'fk_orders.status_id'=>6,
    ),
  'fields' => array(
    'Orderdetail.id',
    'fk_orders.NgayLap',
    'fk_orders.NgayGiaoHang',
    'fk_users.fullname',
    'fk_products.TenPhone',
    'fk_products.GiaBan',
    'fk_products.GiamGia',
    'Orderdetail.SoLuong',
    )       
  )));  
}
}
if($count<1)
  $this->redirect(array('controller'=>'admin','action'=>'index'));
}
} 
}
}
public function managecontact(){
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
          if($value['Menuchild']['action']=='managecontact'){
            $count++;
            $this->set('contacts', $this->Contact->find('all',array('conditions'=>array('status'=>2))));
          }
        }
        if($count<1)
          $this->redirect(array('controller'=>'admin','action'=>'index'));
      }  
    }          
  }
  public function replycontact($id=null){
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
            if($value['Menuchild']['action']=='replycontact'){
              $count++;
              if (!$id) {
                throw new NotFoundException(__('Invalid post'));
              }
              $id_contact = $this->Contact->findById($id);
              if (!$id) {
                throw new NotFoundException(__('Invalid post'));
              }
              if ($this->request->is(array('post', 'put'))) {
                //print_r($this->request->data('Contact'));die();
                $this->Contact->id = $id;
                $this->Contact->query('update contacts set status=1 WHERE id='.$id);
                if(isset($this->data['Contact'])) {

                  $emailFrom = $this->Auth->user('email');
                  $emailTo = $this->request->data['Contact']['email'];
                  $userMessage = $this->request->data['Contact']['messagereply'];

                  $email = new CakeEmail();
                  $email->from(array($emailFrom));
                  $email->to(array($emailTo));
                  $email->subject('Thông tin phản hồi');
                  $email->send($userMessage);
                  if ($email->reset($userMessage)) {
                    $this->Session->setFlash('Gửi mail thành công','default', array('class' => 'notice success'));
                    return $this->redirect(array('action' => 'managecontact'));
                  } 
                  else {
                    $this->Session->setFlash('Lỗi gửi mail','default', array('class' => 'cake-error'));
                    return $this->redirect(array('action' => 'managecontact'));
                  }
                }
              }
              if (!$this->request->data) {
                $this->request->data = $id_contact;
              }
            }
          }
          if($count<1)
            $this->redirect(array('controller'=>'admin','action'=>'index'));
        }  
      }          
    }
    public function deletecontact(){
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
              if($value['Menuchild']['action']=='deletecontact'){
                $count++;
                $this->request->onlyAllow('post');
                $this->Contact->id = $id;
                if (!$this->Contact->exists()) {
                  throw new NotFoundException(__('Invalid user'));
                }
                if ($this->Contact->delete()) {
                  $this->Session->setFlash('Liên hệ đã xóa thành công !','default',array('class' => 'notice success'));
                  return $this->redirect(array('action' => 'managecontact'));
                }
                $this->Session->setFlash('Liên hệ không thể xóa !','default',array('class' => 'cake-error'));
                return $this->redirect(array('action' => 'managecontact'));
              }
            }
            if($count<1)
              $this->redirect(array('controller'=>'admin','action'=>'index'));
          }
        } 
      }
    }
    public function nhacnhonhaphang(){
        
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
              if($value['Menuchild']['action']=='deletecontact'){
                $count++;
                $this->set('nhacnho',$this->Product->find('all', array('conditions'=>array('SoLuong<=3'),'fields'=>array('id','MaPhone','TenPhone','SoLuong','HinhAnh1'))));
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
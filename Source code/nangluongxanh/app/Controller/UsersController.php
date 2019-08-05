<?php
App::uses('AppController', 'Controller');
/**
 * 
 */
class UsersController extends AppController
{


    var $helpers = array('Html', 'Form');
    public $uses = array('User','Groupuser','Role');
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('add', 'logout');

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

    public function login()
    {

        if ($this->request->is('post')) {
            $kt = $this->User->find('all',array('conditions'=>array('username'=>$this->request->data['User']['username']),
                'field'=>array('User.status_user')
                ));
            
            if (isset($kt[0]) && $kt[0]['User']['status_user']==1) {  
                if($this->Auth->login()){
                    $id = $this->Auth->user('id');
                    $getrole = $this->testiduser($id);
                    if($getrole!=NULL){
                        if ($getrole[0]['JRole']['id'] != 2) {
                            return $this->redirect(array('controller' => 'admin', 'action' => 'index'));
                        }
                    //return $this->redirect($this->Auth->redirect());
                        else {
                            return $this->redirect(array('controller' => 'products', 'action' => 'index'));
                        }
                    }            
                }              
            }
                $this->Session->setFlash('Lỗi tên đăng nhập hoặc mật khẩu, nhập lại', 'default',
                    array('class' => 'cake-error'));
            
        }

    }

    public function logout()
    {
        $this->Session->destroy();
        return $this->redirect($this->Auth->logout());
        
    }

    

    public function view($id = null)
    {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    public function add()
    {

        $iduser = $this->User->find('all',array('order'=>'User.id DESC'));
        //print_r($iduser);die();
        $user_id = $iduser[0]['User']['id'] + 1;    
        if ($this->request->is('post')) {
            $this->User->create();
            $users = $this->User->find('all');
            $ngaysinh = $this->request->data['User']['birthday'];
            $newday = DateTime::createFromFormat('d/m/Y', $ngaysinh)->format('Y-m-d');
            $datanew = array(
                'id'=> $user_id,
                'fullname' => $this->request->data['User']['fullname'],
                'sex' => $this->request->data['User']['sex'],
                'birthday' => $newday,
                'address' => $this->request->data['User']['address'],
                'numberphone' => $this->request->data['User']['numberphone'],
                'email' => $this->request->data['User']['email'],
                'username' => $this->request->data['User']['username'],
                'password' => $this->request->data['User']['password']);
            $datagroupuser = array(
                'user_id'=>$user_id
            );
            if (($this->request->data['User']['username']) != $users[0]['User']['username']) {
                if ($this->request->data['User']['config-pass'] == $this->request->data['User']['password']) {
                    $this->Groupuser->save($datagroupuser);    
                    if ($this->User->save($datanew)) {
                        $this->Session->setFlash('Đăng ký thành công !', 'default', array('class' =>
                            'notice success'));
                        return $this->redirect(array('action' => 'login'));
                    }
                    $this->Session->setFlash('Đăng ký không thành công. Vui lòng nhập lại',
                        'default', array('class' => 'cake-error'));
                } else
                $this->Session->setFlash('Nhập lại mật khẩu', 'default', array('class' =>
                    'cake-error'));

            } else
            $this->Session->setFlash('Tên Đăng Nhập đã tồn tại', 'default', array('class' =>
                'cake-error'));


        }

    }
    
    public function delete($id = null)
    {
        $this->request->onlyAllow('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash('User đã xóa thành công !','default',array('class' => 'notice success'));
            return $this->redirect(array('controller'=>'admin','action' => 'index'));
        }
        $this->Session->setFlash('User không thể xóa !','default',array('class' => 'cake-error'));
        return $this->redirect(array('controller'=>'admin','action' => 'index'));
    }

}
?>
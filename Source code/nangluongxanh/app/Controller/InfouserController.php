<?php



class InfouserController  extends AppController{



	var $helpers = array('Html', 'Form');

	public $uses = array('Hangsx','User','Product','Order','Orderdetail');

	public function beforeFilter() {

		$this->Auth->deny('index', 'edit','changepwd');

		$this->layout = 'pageusers';

		$this->set('username', AuthComponent::user('username'));

		$this->set('id', AuthComponent::user('id'));

		$this->layout = 'pageusers';

		$this->set('username', $this->_usersUsername());
        

	

	}

	function _usersUsername(){

		$users_username = NULL;

		if($this->Auth->user()){

			$users_username = $this->Auth->user('username');

		}

		return $users_username;

	}
    
   public function index()
    {
        
             $this->User->recursive = 0;
             $this->set('users', $this->paginate()); 
       
    }
    public function edit($id = null)
    {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $users = $this->User->find('all');
            $ngaysinh = $this->request->data['User']['birthday'];
            //$newday = DateTime::createFromFormat('d/m/Y', $ngaysinh)->format('Y-m-d');
            $datanew = array(
                'fullname' => $this->request->data['User']['fullname'],
                'sex' => $this->request->data['User']['sex'],
                'birthday' => $ngaysinh,
                'address' => $this->request->data['User']['address'],
                'numberphone' => $this->request->data['User']['numberphone'],
                'email' => $this->request->data['User']['email']);
            if ($this->User->save($datanew)) {
                $this->Session->setFlash('Cập nhật thành công !', 'default', array('class' =>
                        'notice success'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash('Cập nhật không thành công. Vui lòng nhập lại',
                'default', array('class' => 'cake-error'));
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }
    public function changepwd()
    {

        if ($this->request->is('post')) {
            $users = $this->User->find('all',array('conditions'=>array('id'=>$this->Auth->user('id'))));
            $passwordHasher = new SimplePasswordHasher();
            $passold = $passwordHasher->hash($this->request->data['User']['password']);
            //print_r($passold);die();
            $dataupdate = array('password' => $this->request->data['User']['password-new'],
                    'id' => $this->Auth->user('id'));
                 
            if ($passold==$users[0]['User']['password']) {
                if ($this->request->data['User']['password-new'] == $this->request->data['User']['config-pass']) {
                    if ($this->User->save($dataupdate)) {
                        $this->Session->setFlash('Ðổi mật khẩu thành công !', 'default', array('class' =>
                                'notice success'));
                        return $this->redirect(array('action' => 'index'));
                    }
                    $this->Session->setFlash('Ðổi mật khẩu không thành công. Vui lòng nh?p l?i',
                        'default', array('class' => 'cake-error'));
                } else
                    $this->Session->setFlash('Nhập lại mật khẩu. Vui lòng nh?p l?i', 'default',
                        array('class' => 'cake-error'));

            } else
                $this->Session->setFlash('Mật khẩu cũ không đúng. Vui lòng nhập lại', 'default',
                    array('class' => 'cake-error'));

        }

    }
    public function orderuser(){
       
			$this->set('orderuser', $this->Order->find('all',array(
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
                    'fk_users.id'=>$this->Auth->user('id')
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
    public function view_order_user($id=null){
        
			$this->set('orderuser', $this->Orderdetail->find('all',array(
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
                            'fk_products.id = Orderdetail.product_id',
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
                    'fk_users.id'=>$this->Auth->user('id'),
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

?>
<?php
App::uses('AppController', 'Controller');

class CartsController extends AppController {

  var $components=array("Session",'Email');  
  public $uses = array('Product','Cart','Order','Orderdetail','User');
  public function beforeFilter() {
   parent::beforeFilter();
   $this->Auth->allow('index', 'view','add','update','delete');
   $this->set('count',$this->Cart->getCount());
   $this->set('fullname', $this->_usersFullname());
   $this->set('products', $this->view());
 }
 function _usersFullname(){

  $users_fullname = NULL;

  if($this->Auth->user()){

   $users_fullname = $this->Auth->user('fullname');

 }

 return $users_fullname;

}
public function add() {

 $this->autoRender = false;
 if ($this->request->is('post')) {
      $this->Cart->addProduct($this->request->data['Cart']['product_id']);
 }
 
    echo $this->Cart->getCount();

}
public function view() {
  $carts = $this->Cart->readProduct();
  $products = array();
  if (null!=$carts) {
   foreach ($carts as $productId => $count) {
    $product = $this->Product->read(null,$productId);
    $product['Product']['count'] = $count;
    $products[]=$product;
  }
} 
return $products;
}

public function update() {
  if ($this->request->is('post')) {
   if (!empty($this->request->data)) {
    $cart = array();
    foreach ($this->request->data['Cart']['count'] as $index=>$count) {
     if ($count>0) {
      $productId = $this->request->data['Cart']['product_id'][$index];
      $cart[$productId] = $count;
    }
  }
  $this->Cart->saveProduct($cart);
}
}
$this->redirect(array('action'=>'view'));
}
public function delete($id = null){
 $this->Session->delete('cart.'.$id);
 $this->redirect(array('action' => 'view'));   
}
public function deletec_cart_index($id = null){
 $this->Session->delete('cart.'.$id);
 $this->redirect(array('controller'=>'products','action' => 'index'));   
}
public function orders(){
  if ($this->request->is('post')) {

    $this->Order->create();
    $orderdetail = $this->Order->find('all',array('order'=>'Order.id DESC'));
    if($this->Auth->user()){

     $users_id = $this->Auth->user('id');

   }
   if($orderdetail==NULL)
    $ma_order=1;
  else    
    $ma_order = $orderdetail[0]['Order']['id']+1;


            //$nl = $this->request->data['Order']['NgayLap'];
  $ngaylap = date("Y-m-d");
  $ng = $this->request->data['Order']['NgayGiaoHang'];
  $ngaygiao = DateTime::createFromFormat('d/m/Y', $ng)->format('Y-m-d');
  $data_order = array(
    'id'=>$ma_order,
    'user_id' => $users_id,
    'NgayLap'=>$ngaylap,
    'NgayGiaoHang'=>$ngaygiao,
    'HinhThucThanhToan'=>$this->request->data['Order']['HinhThucThanhToan'],
    'DiaChiNguoiNhan'=>$this->request->data['Order']['DiaChiNguoiNhan'],
    'DienThoaiNguoiNhan'=>$this->request->data['Order']['DienThoaiNguoiNhan']
    );
  $this->Order->save($data_order);


  $carts = $this->Cart->readProduct();
  $data_order_detail = array();
  $data_product_order = array();
  foreach($carts as $key=>$value)
  {
    $data_order_detail[] = array(
      'order_id' => $ma_order,
      'product_id'=> $key,
      'SoLuong'=>$value
      );
    $data_product_order[] = array(
      'product_id'=> $key,
      'SoLuong'=>$value        
      );
  }
  $i = 0;
  while($i<count($data_order_detail))
  {
    $slp = $this->Product->find('all',array('conditions'=>array('id'=>$data_product_order[0]['product_id']),'fields' => array('SoLuong')));
    $a = $data_order_detail[$i];
    $slo = $slp[0]['Product']['SoLuong']-$data_product_order[$i]['SoLuong'];

    $b = array('SoLuong'=>$slo,'id'=>$data_product_order[$i]['product_id']);
    $this->Orderdetail->create();
    $this->Orderdetail->save($a);
    $this->Product->create();
    $this->Product->save($b);
    $i++;
  }
           //send mail order
  $userEmail = $this->Auth->user('email');

  $products = array();
  if (null!=$carts) {
    foreach ($carts as $productId => $count) {
      $product = $this->Product->read(null,$productId);
      $product['Product']['count'] = $count;
      $products[]=$product;
    }
  }
  $userMessage = "";
  $userMessage .="<table style='border-collapse: collapse;'>";
  $userMessage .="<tr><th style='border: 1px solid #000;'>Tên SP</th>
  <th style='border: 1px solid #000;'>Số Lượng</th>
  <th style='border:1px solid #000;'>Giá Bán</th>
  <th style='border: 1px solid #000;'>Giảm Giá</th>
  <th style='border: 1px solid #000;'>Thành Tiền</th></tr>";
  $total=0;
  foreach ($products as $product){

    $userMessage .= "<tr><td style='border: 1px solid #000;'>".$product['Product']['TenPhone']."</td>
    <td style='border: 1px solid #000;'>".$product['Product']['count']."</td>
    <td style='border: 1px solid #000;'>".number_format($product['Product']['GiaBan'])." VNĐ</td>
    <td style='border: 1px solid #000;'>".number_format((($product['Product']['GiaBan']*$product['Product']['GiamGia'])/100))." VNĐ</td>
    <td style='border: 1px solid #000;'>".number_format($product['Product']['count']*($product['Product']['GiaBan']-(($product['Product']['GiaBan']*$product['Product']['GiamGia'])/100)))." VNĐ</td>
  </tr>";
  $total = $total + ($product['Product']['count']*($product['Product']['GiaBan']-(($product['Product']['GiaBan']*$product['Product']['GiamGia'])/100)));

}
$userMessage .="<tr><td colspan=2>Tổng Tiền: ".number_format($total)." VNĐ</td></tr>";
$userMessage .= '</table>';
            //print_r($userMessage);die();


$email = new CakeEmail();
$email->emailFormat('html');
$email->charset = "utf-8";
$email->headerCharset = "utf-8";
$email->from(array($userEmail));
$email->to('td030409@gmail.com');
$email->subject('Thông tin đơn hàng');
$email->send($userMessage);
            //end send mail order
$this->Session->destroy();
$this->Session->setFlash('Đơn hàng thanh toán thành công!','default', array('class' => 'notice success'));
$this->redirect(array('controller'=>'carts','action'=>'ordersuccess')); 

}
}
public function ordersuccess(){

} 
}
?>
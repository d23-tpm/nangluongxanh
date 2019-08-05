<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	//var $helpers = array('Html','Form','Session');
	var $helpers = array(
		'Session',
		'Html',
		'Form',
		'Javascript',
		'Ajax'
		);

	public $uses = array('User','Hangsx','Product','Orderdetail','Order','Role','Groupuser');
	public $components = array(
		'Session',
		'Auth' => array(
			'loginRedirect' => array(
				'controller' => 'products',
				'action' => 'index'
				),
			'logoutRedirect' => array(
				'controller' => 'products',
				'action' => 'index',
				)
			)
		);

	public function beforeFilter() {
		$this->Auth->allow('index', 'view','search_product','autoComplete','deletec_cart_index');
		$this->layout = 'pageindex';
		$this->set('username', AuthComponent::user('username'));
		$this->set('id', AuthComponent::user('id'));
		$this->layout = 'pageindex';
		$this->set('username', $this->_usersUsername());

		$this->set('namehsx', $this->gethsx());
		$this->set('fillernsx', $this->fillter_by_nsx());
		$this->loadModel('Cart');
		$this->set('count',$this->Cart->getCount());
		$this->set('giohang',$this->fillter_shopping_cart());
		$this->set('list_product',$this->product_sale_top());
		
		
	}
	function _usersUsername(){
		$users_username = NULL;
		if($this->Auth->user()){
			$users_username = $this->Auth->user('username');
		}
		return $users_username;
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
	function fillter_by_nsx(){
		if(isset($_GET['idnsx'])){
			$nsx = $_GET['idnsx'];
			$prd = $this->Product->find('all',array('conditions'=>array('Product.MaHangSX'=>$nsx),'limit'=>9,'order'=>'Product.created DESC'));
		}
		else
			$prd = $this->Product->find('all',array('limit'=>9,'order'=>'Product.created DESC'));
		return $prd;
	}
	function fillter_shopping_cart(){
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
	public function product_sale_top(){
		
		
		$item = $this->Orderdetail->find('all',array(
			'joins' => array(
				array(
					'table' => 'orders',
					'alias' => 'JOrder',
					'type' =>  'LEFT',
					'foreignKey' => 'id',
					'conditions' => array(
						'Orderdetail.order_id = JOrder.id'
						)	
					),
				array(
					'table' => 'products',
					'alias' => 'JProduct',
					'type' =>  'LEFT',
					'foreignKey' => 'id',
					'conditions' => array(
						'JProduct.id = Orderdetail.product_id'
						)
					)),
			'group'=>array('Orderdetail.product_id'),
			'order'=>array('sum(Orderdetail.SoLuong) DESC'),
			'limit'=>10,
			'fields' => array('JProduct.id','JProduct.TenPhone','JProduct.HinhAnh1','JProduct.GiaBan','sum(Orderdetail.SoLuong) as itemsl')
			));
		return $item;
	}


}

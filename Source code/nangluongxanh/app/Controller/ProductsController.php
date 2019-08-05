<?php
App::uses('AppController', 'Controller');
class ProductsController extends AppController {
	//public $helpers = array('Html', 'Form');
	public $uses = array('Product');
     var $components = array('RequestHandler');
      public function autoComplete() {
        $this->autoRender = false;
        $products = $this->Product->find('all', array(
            'conditions' => array(
            'Product.TenPhone LIKE' => '%' . $_GET['term'] . '%',
            )));
        echo json_encode($this->_encode($products));
    }
	private function _encode($postData) {
        $temp = array();
        foreach ($postData as $product) {
            array_push($temp, array(
            'id' => $product['Product']['id'],
            'label' => $product['Product']['TenPhone'],
            'value' => $product['Product']['TenPhone'],
            ));
        }
        return $temp;
    }
	public function index() {
		$this->set('products', $this->Product->find('all'));
	}
	
	public function view($id) {
       
        $idhsx = $this->Hangsx->find('all',array(
                'joins' => array(
                    array(
                            'table' => 'products',
                            'alias' => 'JProduct',
                            'type' =>  'INNER',
                            'foreignKey' => 'MaHangSX',
                            'conditions' => array(
                                'Hangsx.MaHangSX = JProduct.MaHangSX',
                                'JProduct.id' => $id
                            )
                    )        
                ),
                'fields' => array('Hangsx.MaHangSX')    
                          
            ));
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		
		$product = $this->Product->read(null,$id);
		$this->set(compact('product'));



        $this->set('product_lq',$this->Product->find('all',array(
                'conditions'=>array(
                    'MaHangSX' => $idhsx[0]['Hangsx']['MaHangSX'],
                    'id <>'.$id
                ),
                'fields' => array(
                    'id',
                    'HinhAnh1',
                    'TenPhone',
                    'GiaBan'
                )
            )));
        
	}
    
    public function search_product(){
        if(isset($_GET['tenphone']))
        {
            $getnamephone = $_GET['tenphone'];
            $this->set('getsearch',$this->Product->find('all',array(
                    'conditions'=>array('Product.TenPhone LIKE '=>'%'.$getnamephone.'%'))));
        }
    }
    public function product_status(){

    }
    
  
}
?>
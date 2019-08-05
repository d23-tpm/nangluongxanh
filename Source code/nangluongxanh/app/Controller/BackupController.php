<?php
App::uses('AppController', 'Controller');
App::uses('AdminController', 'Controller');
	/**
	* 
	*/
	class BackupController extends AppController
	{
		
		var $helpers = array('Html', 'Form');
		public $uses = array('Hangsx','User','Product','Role','Status','Order','Orderdetail','Menuparent','Menuchild','Groupuser');
		public function beforeFilter() {

			$this->layout = 'pageadmin';

			$this->set('username', AuthComponent::user('username'));

			$this->set('id', AuthComponent::user('id'));

			$this->layout = 'pageadmin';

			$this->set('username', $this->_usersUsername());

			$this->Auth->deny('admin_database_mysql_dump','index');
			$this->set('countsl',$this->get_count_sl_product()); 
			$this->set('showsp_het',$this->show_sp_het());
			$this->set('listmenu',$this->getmenu());
			$this->set('listmenuparent',$this->getmenuparent());
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
		'fields'=>array('Menuchild.id','Menuchild.controller','Menuchild.action')
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

public function admin_database_mysql_dump($tables = '*'){
	$id_user = $this->Auth->user('id');
	$getrole = $this->testiduser($id_user);
    $getps = $this->getpermission();
	if($getrole != NULL){
		if($getrole[0]['JRole']['id'] != 2){
		  if($getps != NULL){
                $count=0;
                foreach ($getps as $value) {
                    if($value['Menuchild']['action']=='admin_database_mysql_dump'){
                        $count++;
                        $return = '';

			$modelName = $this->modelClass;

			$dataSource = $this->{$modelName}->getDataSource();
			$databaseName = $dataSource->getSchemaName();


    // Do a short header
			$return .= '-- Database: `' . $databaseName . '`' . "\n";
			$return .= '-- Generation time: ' . date('D jS M Y H:i:s') . "\n\n\n";


			if ($tables == '*') {
				$tables = array();
				$result = $this->{$modelName}->query('SHOW TABLES');
				foreach($result as $resultKey => $resultValue){
					$tables[] = current($resultValue['TABLE_NAMES']);
				}
			} else {
				$tables = is_array($tables) ? $tables : explode(',', $tables);
			}

    // Run through all the tables
			foreach ($tables as $table) {
				$tableData = $this->{$modelName}->query('SELECT * FROM ' . $table);

				$return .= 'DROP TABLE IF EXISTS ' . $table . ';';
				$createTableResult = $this->{$modelName}->query('SHOW CREATE TABLE ' . $table);
				$createTableEntry = current(current($createTableResult));
				$return .= "\n\n" . $createTableEntry['Create Table'] . ";\n\n";

        // Output the table data
				foreach($tableData as $tableDataIndex => $tableDataDetails) {

					$return .= 'INSERT INTO ' . $table . ' VALUES(';

						foreach($tableDataDetails[$table] as $dataKey => $dataValue) {

							if(is_null($dataValue)){
								$escapedDataValue = 'NULL';
							}
							else {
                    // Convert the encoding
								$escapedDataValue = mb_convert_encoding( $dataValue, "UTF-8", "ISO-8859-1" );

                    // Escape any apostrophes using the datasource of the model.
								$escapedDataValue = $this->{$modelName}->getDataSource()->value($escapedDataValue);
							}

							$tableDataDetails[$table][$dataKey] = $escapedDataValue;
						}
						$return .= implode(',', $tableDataDetails[$table]);

						$return .= ");\n";
}

$return .= "\n\n\n";
}

			    // Set the default file name
$fileName = $databaseName . '-backup-' . date('Y-m-d_H-i-s') . '.sql';

			    // Serve the file as a download
$this->autoRender = false;
$this->response->type('Content-Type: text/x-sql');
$this->response->download($fileName);
$this->response->body($return);
                    }
                }
                if($count<1)
                    $this->redirect(array('controller'=>'admin','action'=>'index'));
          }      
			
        }
    else
    	$this->redirect(array('controller'=>'products','action'=>'index'));
}
}
public function index(){
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
                    if($value['Menuchild']['action']=='index'&&$value['Menuchild']['controller']=='backup'){
                        $count++;
                        date_default_timezone_set('Asia/Ho_Chi_Minh');
            			$modelName = $this->modelClass;
            			$dataSource = $this->{$modelName}->getDataSource();
            			$databaseName = $dataSource->getSchemaName();
            			$fileName = $databaseName . '-backup-' . date('Y-m-d_H-i-s') . '.sql';
            			$this->set('filename',$fileName);
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
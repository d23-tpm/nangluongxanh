<!DOCTYPE html>
<html lang="en">
<head>
  <?php echo $this->Html->charset("utf-8"); ?>

  <title>
    Năng Lượng Xanh
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>

  <?php
  echo $this->Html->meta('icon', $this->Html->url('/img/favicon.png'));
  echo $this->Html->script('jquery.min.js');
  echo $this->Html->css('bootstrap.min.css');
  echo $this->Html->css('bootstrap-theme.min.css');
  //echo $this->Html->script('bootstrap.min.js');
  echo $this->Html->css('font-awesome.css');
  echo $this->Html->css('font-awesome.min.css');
  echo $this->Html->css('style.css');
  echo $this->Html->script('jquery-ui.js');
  echo $this->Html->css('jquery-ui.css');
  echo $this->Html->script('script.js');
  echo $this->Html->script('accordion.jquery.js');
  echo $this->Html->script('ckeditor/ckeditor.js');
  echo $this->Html->script('jquery.chained.min.js');
  echo $this->fetch('meta');
  echo $this->fetch('css');
  echo $this->fetch('script');

  ?>

</head>

<body class="page-admin">
  <div class="container" style="padding: 0;">
    <div class="row">
      <div class="content-admin col-xs-12 col-sm-12 col-md-12">
        <div id="sidebar" class="col-xs-12 col-sm-12 col-md-2">
        <nav class="menu-vistor navbar navbar-default column">
          <div class="navbar-sidebar clear">
            <button class="navbar-toggle" data-target=
                "#bs-example-navbar-collapse-1" data-toggle=
                "collapse" type="button"><span class=
                "sr-only">Toggle navigation</span> <span class=
                "icon-bar"></span> <span class=
                "icon-bar"></span> <span class=
                "icon-bar"></span></button>

                <h5>Danh Mục</h5>
            </div> 
            <div class="collapse navbar-collapse" id=
                            "bs-example-navbar-collapse-1"> 
          <div class="panel-group" id="accordion">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a href="../admin">
                    <i class="fa fa-desktop"></i>
                    Dashboard
                  </a>
                </h4>
              </div>
            </div>

            <?php
            $optionparent = array();
  //print_r($listmenu);die();
            foreach($listmenu as $value){
              $optionparent[$value['JMenuparent']['id']][]=$value['Menuchild'];

            }
            $output = array();
            foreach ($optionparent as $key1 => $value1) {

              foreach($listmenuparent as $item)
              {
                if($getpr!=NULL){
                  foreach($getpr as $pr){
                    if($pr['JMenuparent']['id']==$item['Menuparent']['id']){
                     if($item['Menuparent']['id']==$key1){
                       if($item['Menuparent']['status']==1)
                       {
                         ?>

                         <div class="panel panel-default">
                          <div class="panel-heading">
                            <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $item['Menuparent']['id']?>">
                                <i class="fa <?php echo $item['Menuparent']['icon'];?>"></i>
                                <?php echo $item['Menuparent']['menuname']?>
                              </a>
                            </h4>
                          </div>
                          <div id="collapse<?php echo $item['Menuparent']['id'];?>" class="panel-collapse collapse">
                            <div class="panel-body">
                             <ul>
                              <?php
                              foreach ($value1 as $item2) {
                                if($getps !=NULL){
                                  foreach($getps as $ps){
                                    if($ps['Menuchild']['id']==$item2['id']){
                                     if($item2['status']==1){
                                      ?>

                                      <li>
                                        <span class="sidenav-link-color"></span>
                                        <i class="fa fa-caret-right"></i>
                                        <?php echo $this->Html->link(__($item2['menuname']),
                                          array('controller' => $item2['controller'], 'action' => $item2['action']), array('class' =>
                                          $item2['action'])); ?>
                                        </li>

                                        <?php }
                                      }                 
                                    }
                                  }
                                }?>
                              </ul>
                            </div>
                          </div>
                        </div>
                        <?php
                      }}
                    }
                  }
                }
                

              }  
            }
            ?>

          </div>
          </div>
        </nav>
        </div>
        <div id="primary-content" class="col-xs-12 col-sm-12 col-md-10">
          <div id="top-admin">
            <div class="logo-admin col-xs-5 col-sm-5 col-md-5">
              <a href="../admin">
                <img src="/img/logo-admin.png" alt="home"/>
              </a>
            </div>
            <div class="menu-right-admin col-xs-7 col-sm-7 col-md-7">
              <ul>
                <li>
                  <i class="fa fa-user"></i>
                  <?php
                  echo $this->Html->link($username, array(
                    'controller' => 'users',
                    'action' => 'edit',
                    $id));
                    ?>
                  </li>
                  <li>
                    <i class="fa fa-sign-out"></i>
                    <?php
                    echo $this->Html->link(__('Đăng Xuất'), array('controller'=>'users','action'=>'logout'), array('class' => 'loguser'));
                    ?>
                  </li>
                  <?php
                  if($getrolelogin!=NULL){
                    if($getrolelogin[0]['JRole']['id']==1||$getrolelogin[0]['JRole']['id']==6||$getrolelogin[0]['JRole']['id']==5){
                      echo '<li class="nhac-nho">';
                      echo '<i class="fa fa-envelope"></i>';
                      if($countsl[0][0]['items']>0){
                        echo '<span class="count">';
                        echo $countsl[0][0]['items'];
                        echo '</span>';
                        echo '<div class="group-sap-het">';
                        echo '<i class="fa fa-times"></i>';
                        echo '<ul>';
                        foreach ($showsp_het as $key){

                          echo '<li>'.$this->Html->link('<img class="item-het" style="width:32px;" src="/img/uploads/products/'.$key['Product']['HinhAnh1'].'"/><span class="item-het">'.$key['Product']['TenPhone'].'</span><p class="item-het">'.$key['Product']['SoLuong'].'x</p>', array('controller'=>'admin','action'=>'editproduct',$id=$key['Product']['id']),array('escape'=>false)).'</li>';

                        }
                        echo '</ul>';
                        echo '</div>';
                      }
                       echo '</li>';
                    }
                  }?>
                </ul>
              </div>
            </div>
            <div id="main-content">

              <?php echo $this->Session->flash(); ?>

              <?php echo $this->fetch('content'); ?>
            </div>
          </div>
          
          <div style="clear: both;"></div>
          <div id="footer" class="col-md-12">
            <div class="container">
              <div id="logo-container"> &copy;Copyright by Nang Luong Xanh</div>
            </div> 

          </div>
        </div>
      </div>
    </div> 
    <?php echo $this->Html->script('bootstrap.min.js'); 
    ?>
  </body>
  </html>

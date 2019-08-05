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
  echo $this->Html->script('bootstrap.min.js');
  echo $this->Html->css('font-awesome.css');
  echo $this->Html->css('font-awesome.min.css');
  echo $this->Html->css('style.css');
  //echo $this->Html->css('calendarview.css');
  echo $this->Html->script('jquery-ui.js');
  echo $this->Html->css('jquery-ui.css');
  echo $this->Html->script('accordion.jquery.js');
  //echo $this->Html->script('prototype.js');
  //echo $this->Html->script('calendarview.js');
  echo $this->Html->script('script.js');
  echo $this->Html->script('ckeditor/ckeditor.js');
  echo $this->fetch('meta');
  echo $this->fetch('css');
  echo $this->fetch('script');

  ?>
  

  </head>
  <body class="page-admin page-user">
    <div class="container">
      <div class="row">
        <div id="sidebar" class="col-xs-12 col-sm-12 col-md-2">
          <div class="panel-group" id="accordion">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a href="../infouser">
                    <i class="fa fa-desktop"></i>
                    Dashboard
                  </a>
                </h4>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                    <i class="fa fa-users"></i>
                    Quản Lý Cá Nhân
                  </a>
                </h4>
              </div>
              <div id="collapseOne" class="panel-collapse collapse">
                <div class="panel-body">
                 <ul>
                  <li>
                    <span class="sidenav-link-color"></span>
                    <i class="fa fa-caret-right"></i>
                    <?php echo $this->Html->link('Thay Đổi Thông Tin Cá Nhân',
                      array('controller' => 'infouser', 'action' => 'edit',$id)); ?>
                    </li>
                    <li>
                          <span class="sidenav-link-color"></span>
                          <i class="fa fa-caret-right"></i>
                          <?php echo $this->Html->link(__('Đổi Mật Khẩu'), array
                          ('controller' => 'infouser', 'action' => 'changepwd'), array('class' => 'changepwd')); ?>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                        <i class="fa fa-shopping-cart"></i>
                        Đơn Hàng
                      </a>
                    </h4>
                  </div>
                  <div id="collapseThree" class="panel-collapse collapse">
                    <div class="panel-body">
                      <ul>
                        <li>
                          <span class="sidenav-link-color"></span>
                          <i class="fa fa-caret-right"></i>
                          <?php echo $this->Html->link(__('Danh Sách Đơn Hàng'),
                            array('controller' => 'infouser', 'action' => 'orderuser'), array('class' =>
                            'manage-order-user')); ?>
                          </li>
                         
                        </ul>
                      </div>
                    </div>
                  </div>  
            </div>
              </div>
            </div>
            <div id="primary-content" class="col-xs-12 col-sm-12 col-md-10">
              <div id="top-admin">
                <div class="logo-admin col-xs-5 col-sm-5 col-md-5">
                  <a href="../infouser">
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
        </body>
        </html>

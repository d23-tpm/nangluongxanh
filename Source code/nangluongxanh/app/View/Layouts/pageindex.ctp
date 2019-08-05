<!DOCTYPE html>
<html lang="en">
<head>
	<?php echo $this->Html->charset("utf-8"); ?>
	<title>
    Năng Lượng Xanh
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <?php
  echo $this->Html->meta('icon', $this->Html->url('/img/favicon.png'));
  echo $this->Html->script('jquery.min.js');
  //echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');
  //echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js');
  echo $this->Html->css('bootstrap.min.css');
  echo $this->Html->css('bootstrap-theme.min.css');
  echo $this->Html->script('bootstrap.min.js');
  echo $this->Html->css('font-awesome.css');
  echo $this->Html->css('font-awesome.min.css');
  echo $this->Html->css('style.css');
  echo $this->Html->script('SmoothScroll.js');
  echo $this->Html->script('jquery-ui.js');
  echo $this->Html->script('jquery.bxslider.min.js');
  echo $this->Html->css('jquery.bxslider.css');
  echo $this->Html->script('cloudzoom.js');
  echo $this->Html->script('thumbelina.js');
  echo $this->Html->css('cloudzoom.css');
  echo $this->Html->css('jquery-ui.css');
  echo $this->Html->script('script.js');
  echo $this->Html->script('ckeditor/ckeditor.js');
  echo $this->fetch('meta');
  echo $this->fetch('css');
  echo $this->fetch('script');

  ?>
</head>
<body>
 <div id="page">
  <div id="header">
    <div class="container">
      <div class="row">
        <ul class="info-user col-lg-12 col-md-12">
          
		  
		  <?php
            if($username == ''){
                echo '<li class="user-item">
                    <i class="fa fa-user"></i>';
                    echo $this->Html->link(__('Đăng Ký'), array('controller'=>'users','action'=>'add'), array('class' => 'adduser'));
              echo '</li>
              <li style="width:115px;" class="user-item">
                <i class="fa fa-sign-in"></i>';
                    echo $this->Html->link(__('Đăng Nhập'), array('controller'=>'users','action'=>'login'), array('class' => 'loginuser'));
              echo '</li>';
            }	
			else{
                echo '<li class="info-ca-nhan user-item">
                        <i class="fa fa-info"></i>';
                echo  $this->Html->link(__('Thông tin cá nhân'), array('controller'=>'infouser','action'=>'index'), array('class' => 'ttcn'));          
				echo '</li><li class="user-login"><span>Xin Chào </span>';
				echo $this->Html->link(
				  $username,
				  array('controller' => 'infouser','action' => 'edit', $id));
                echo '</li><li style="width:110px;" class="user-item">';  
		
                echo '<i class="fa fa-sign-out"></i>';
                echo $this->Html->link(__('Đăng Xuất'), array('controller'=>'users','action'=>'logout'), array('class' => 'loguser'));
                echo '</li>';
            }
                
              ?>
            
          </ul>
        </div>
        <div class="row">
         <div class="logo col-xs-12 col-sm-8 col-md-4">
          
          <?php echo $this->Html->link('<img src="/img/logo.png" alt="home"/>',array('controller'=>'products','action'=>'index'),array('escape'=>false));?>  
          
        </div>
        <div id="search_block_top" class="col-xs-12 col-sm-12 col-md-4">
          <form method="GET" action="../products/search_product">
            <!--<input type="text" name="tenphone" class="form-control" placeholder="Tìm kiếm"/> --->
             <?php
            
                echo $this->Ajax->autoComplete_ui('Product.search', array(
                    'placeholder'=>'Tìm kiếm',
                    'name'=>'tenphone',
                    'source' => array(
                        'controller' => 'products',
                        'action' => 'autoComplete',
                    ),
                ));
            ?>
            <button type="submit"><i class="fa fa-search"></i></button>
          </form>
        </div>
        <?php
//          if ($this->Session->read('Auth.User')) {
//                echo 'logged';
//            } else {
//                echo 'guest';
//            }
       ?>
        <ul id="menutop" class="col-xs-12 col-sm-4 col-md-4">
          <li class="menu-item menu-first col-md-4">
            <?php echo $this->Html->link(__('Trang chủ'), array('controller'=>'products','action'=>'index')); ?>
          </li>
          <li class="menu-item menu-event col-md-4">
            <?php echo $this->Html->link(__('Liên Hệ'), array('controller'=>'contacts','action'=>'index')); ?>
          </li>
          <li class="menu-cart col-md-4">
          <?php echo $this->Html->link('<i class="fa fa-shopping-cart"></i> Cart <span class="badge" id="cart-counter">'.$count.'</span>',
            array('controller'=>'carts','action'=>'view#CartViewForm'),array('escape'=>false));?>
            <!--<ul class="ds-gio-hang">
                <?php
                    
                       // foreach($giohang as $iterm_cart){
//                            echo '<li>';
//                            echo ('<div class="img-shopping-cart">'.$this->Html->image('uploads/products/'.$iterm_cart['Product']['HinhAnh1'], array('alt'=> __('', true), 'border' => '0', 'style'=>'width:30px;height:58px;')).'</div>');
//                            echo ('<div class="right-shopping-cart">');
//                            echo ('<div class="item-shopping-cart">'.$iterm_cart['Product']['count'].'x</div>');                        
//                            echo ('<div class="item-shopping-cart">'.$iterm_cart['Product']['TenPhone'].'</div>');
//                            echo ('<div class="item-shopping-cart">'.number_format($iterm_cart['Product']['GiaBan']).' VNĐ</div>'); 
//                            echo $this->Html->link('x',array('controller'=>'carts','action'=>'deletec_cart_index',$iterm_cart['Product']['id']),array('class'=>'del-shopping-cart'));
//                            echo '</div>';
//                            echo '</li>';
//                        }
                    
                    
                ?>
            </ul> --->
          </li>
        </ul>
      </div>
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-example-generic" data-slide-to="1"></li>
          <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
          <div class="item active">
            <img src="/img/slide.png" alt="slide1">
            <div class="carousel-caption">
              <h1 class="title">Máy Giặt Sony</h1>
              <h3 class="description">dolore Lorem Ipsum</h3>
              <p class="body-slide">Dovitae diam purus luctus facilisis. Nullam at eros tristique ultrice. Duis quis imperdie est Sed lobortis ultrices aliquet.</p> 
              <a class="btn-detail" href="#">Show Now</a> 
            </div>
          </div>
          <div class="item">
            <img src="/img/slide2.png" alt="slide2">
            <div class="carousel-caption">
              <h1 class="title">Tủ Lạnh Samsung</h1>
              <h3 class="description">dolore Lorem Ipsum</h3>
              <p class="body-slide">Dovitae diam purus luctus facilisis. Nullam at eros tristique ultrice. Duis quis imperdie est Sed lobortis ultrices aliquet.</p> 
              <a class="btn-detail" href="#">Show Now</a>
            </div>
          </div>
          <div class="item">
            <img src="/img/slide3.png" alt="slide3">
            <div class="carousel-caption">
              <h1 class="title">Điện Thoại Htc</h1>
              <h3 class="description">dolore Lorem Ipsum</h3>
              <p class="body-slide">Dovitae diam purus luctus facilisis. Nullam at eros tristique ultrice. Duis quis imperdie est Sed lobortis ultrices aliquet.</p> 
              <a class="btn-detail" href="#">Show Now</a> 
            </div>
          </div>
        </div>
      </div>
    </div> 
  </div>
  <div id="content">
    <div class="container">
      <div class="row">
        <div class="sidebar col-xs-12 col-sm-3">
          <nav class="menu-vistor navbar navbar-default column " role="navigation">

            <div class="navbar-sidebar clear">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>

              <?php
              echo $this->Html->link(
                'Danh Mục',
                array('controller' => 'products','action' => 'index'),array('class'=>'navbar-brand'));
                ?>
              </div>
              <div style="clear:both;"></div>
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="side-nav accordion_mnu collapsible">
                  <?php
                  foreach ($namehsx as $key) {
                    $tennsx = $key['TenHangSX'];
                    $idnsx = $key['MaHangSX'];
                    echo "<li><a href='../?idnsx=$idnsx'>$tennsx</a></li>";
                  }
                  ?>
                </ul>
              </div>
            </nav>
            <div class="top-product">
                <h3>Sản Phẩm Bán Chạy</h3>
              <?php echo $this->element('top_product');?>
            </div>
            <div class="khuyen-mai">
              <img src="/img/qc1.jpg" alt="qc1" style="width:100%;">
              <img src="/img/qc2.jpg" alt="qc2" style="width:100%;">
            </div>
          </div>
          <div class="center_column col-xs-12 col-sm-9" id="center_column">
            <?php echo $this->Session->flash(); ?>
            <?php echo $this->fetch('content'); ?>
          </div>
          <div class="content-bottom col-xs-12">
            <div class="fan-page col-xs-12 col-sm-6 col-md-4">
              <h3>Follow us on facebook</h3>
              <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2FFacebookDevelopers&amp;width=300&amp;height=290&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=true&amp;appId=392319394126075" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:290px;" allowTransparency="true"></iframe>
            </div> 
            <div class="chuong-trinh col-xs-12 col-sm-6 col-md-4">
              <ul>
                <li><i class="fa fa-truck"></i>
                  <div class="type-text">
                    <h3>Miễn Phí Giao Hàng</h3>
                    <p>Miễn phí giao hàng toàn quốc</p>
                  </div>
                </li>
                <li><i class="fa fa-phone"></i>
                  <div class="type-text">
                    <h3>Liên Hệ: (84)1657883098</h3>
                    <p>Liên hệ với chúng tôi để được chăm sóc tốt nhất</p>
                  </div>
                </li>
                <li><i class="fa fa-gift"></i>
                  <div class="type-text">
                    <h3>Quà Tặng</h3>
                    <p>Nhanh tay để nhận được nhiều quà tặng bất ngờ</p>
                  </div>
                </li>
              </ul>
            </div>
            <div class="tien-ich col-xs-12 col-sm-6 col-md-4">
              <div class="link-tien-ich">
                <h3>Tiện ích</h3>
                <ul>
                  <li>
                    <a href="#">Rao vặt</a>
                  </li>
                  <li>
                    <a href="#">Game ứng dụng</a>
                  </li>
                  <li>
                    <a href="#">Tin tức công nghệ</a>
                  </li>
                  <li>
                    <a href="#">Phiếu mua hàng</a>
                  </li>
                  <li>
                    <a href="#">Thanh toán trực tuyến</a>
                  </li>
                </ul>
              </div>
              <div class="social">
                <h3>Follow us</h3>
                <ul>
                  <li>
                    <a target="_blank" class="linksocial" title="" href="http://facebook.com/dinh.vo.73307"><i class="fa fa-facebook"></i>
                    </a>
                  </li>
                  <li>
                    <a target="_blank" class="linksocial" title="" href="https://plus.google.com/u/0/+dinhvokun"><i class="fa fa-google-plus"></i></a>
                  </li>
                  <li>
                    <a target="_blank" class="linksocial" title="" href="https://www.youtube.com"><i class="fa fa-youtube"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div> 

    </div>
    <div style="clear: both;"></div>
    <div id="footer">
      <div class="container">
        <div id="logo-container"> &copy;Copyright by Nang Luong Xanh</div>
      </div> 

    </div>
  </div>
</body>
</html>

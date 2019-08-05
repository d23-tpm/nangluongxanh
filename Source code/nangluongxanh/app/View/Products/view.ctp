
<div class="row">
	<div class="zoom-section col-xs-12  col-sm-12 col-md-5 two-columns"> 
		
		
		<div id="surround">
			<?php $imgbig1 = '/img/uploads/products/'.$product['Product']['HinhAnh1']; ?>
			<div class="border_img" style="width:300px;">
				<img style="height:300px;width:auto;" class="cloudzoom" alt="Cloud Zoom small image" id="zoom1" src="<?php echo $imgbig1; ?>" data-cloudzoom="zoomSizeMode:&quot;image&quot;,autoInside: 550" style="-webkit-user-select: none;">
			</div>

			<div id="slider1">
				<?php
				$imgbig2 = '/img/uploads/products/'.$product['Product']['HinhAnh2'];
				$imgbig3 = '/img/uploads/products/'.$product['Product']['HinhAnh3'];
				?>
				<ul class="thumbelina" style="left: 0px;">
					
					<?php
					if($product['Product']['HinhAnh1'] !=NULL){
						echo '<li><img style="width:40px;height: 78px;" class="cloudzoom-gallery" src="'.$imgbig1.'" data-cloudzoom="useZoom:&#39;.cloudzoom&#39;, image:&#39;'.$imgbig1.'&#39; "</li>';
					}
					if($product['Product']['HinhAnh2'] !=NULL){
						echo '<li><img style="width:40px;height: 78px;" class="cloudzoom-gallery" src="'.$imgbig2.'" data-cloudzoom="useZoom:&#39;.cloudzoom&#39;, image:&#39;'.$imgbig2.'&#39; "</li>';
					}
					if($product['Product']['HinhAnh3'] != NULL){
						echo '<li><img style="width:40px;height: 78px;" class="cloudzoom-gallery" src="'.$imgbig3.'" data-cloudzoom="useZoom:&#39;.cloudzoom&#39;, image:&#39;'.$imgbig3.'&#39; "</li>';
					}
					?>

				</ul>

			</div>

		</div>	

		<div style="clear:both;"></div>
		

    </div>
    <div class="right-content-product col-xs-12  col-sm-12 col-md-7">
    	<?php
    	echo '<h2>'.$product['Product']['TenPhone'].'</h2>';
    	echo '<p class="field-detail-product mau-sac">Màu: <span>'.$product['Product']['MauSac'].'</span></p>';
    	echo '<p class="field-detail-product price">Giá Bán: <span>'.number_format($product['Product']['GiaBan']).' VNĐ</span></p>';
    	echo $product['Product']['ThongTin'];
		//echo $this->Form->input('Số Lượng',array('class'=>'so-luong','value'=>1));
    	echo $this->Form->create('Cart',array('id'=>'add-form','url'=>array('controller'=>'carts','action'=>'add')));
    	echo $this->Form->hidden('product_id',array('value'=>$product['Product']['id']));
    	echo $this->Form->submit('Mua Hàng',array('class'=>'gio-hang'));
    	echo $this->Form->end();
    	?>
    </div>
    <div style="clear:both;"></div>
    <div class="cau-hinh col-xs-12  col-sm-12 col-md-12">
    	<h4>Thông tin cấu hình <i style="float:right;cursor: pointer;" class="fa fa-plus"></i></h4>
    	<?php
    	echo $product['Product']['CauHinh'];
    	?>
    </div>
    <div style="clear:both;"></div>
    <?php if($product_lq != NULL)
    {

    	echo '<div class="sp-cung-dm col-xs-12 col-sm-12 col-md-12">';
    		echo '<h4>Sản Phẩm Cùng Danh Mục</h4>';
    		echo '<div class="slider1">';

    			foreach ($product_lq as $key) {
    				echo '<div class="slide">';
    				echo $this->Html->image('uploads/products/'.$key['Product']['HinhAnh1'],array('style'=>'width:auto;height:180px;'));
    				echo '<h3>'.$this->Html->link(
    					$key['Product']['TenPhone'],
    					array('action' => 'view', $key['Product']['id']),
    					array('class'=>'title-sp'));'</h3>';
    				echo '<p>'.number_format($key['Product']['GiaBan']).' VNĐ</p>';
    				echo '</div>';
    			}
    				
    		echo '</div>';
    	echo '</div>';
    }
    ?>
    
</div>
<div style="clear:both;"></div>
<script>
	$(document).ready(function(){
		$('#add-form').submit(function(e){

			e.preventDefault();
			var tis = $(this);
			$.post(tis.attr('action'),tis.serialize(),function(data){
				$('#cart-counter').text(data);
			});

		});

	});
</script>
<script type="text/javascript">
			CloudZoom.quickStart();

            // Initialize the slider.
            $(function(){
            	$('#slider1').Thumbelina({
            		$bwdBut:$('#slider1 .left'), 
            		$fwdBut:$('#slider1 .right')
            	});
            });

            
        </script>
        
        <script type="text/javascript">

             // The following piece of code can be ignored.
             $(function(){
             	$(window).resize(function() {
             		$('#info').text("Page width: "+$(this).width());
             	});
             	$(window).trigger('resize');
             });
             
            // The following piece of code can be ignored.
            if (window.location.hostname.indexOf("starplugins.") != -1) {
            	var _gaq = _gaq || [];
            	_gaq.push(['_setAccount', 'UA-254857-7']);
            	_gaq.push(['_trackPageview']);
            	(function() {
            		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            	})();
            }

        </script>
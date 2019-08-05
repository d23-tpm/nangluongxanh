<?php
	foreach ($report_product as $product)
	 {
		   $this->CSV->addRow($product['Product']);
	 }
	 $filename='report_ton_kho';
	 echo  $this->CSV->render($filename);
?>
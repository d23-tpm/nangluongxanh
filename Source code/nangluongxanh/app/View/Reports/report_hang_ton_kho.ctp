<script language="javascript">
	function printdiv(printpage)
	{
		var headstr = "<html><head><title></title></head><body>";
		var footstr = "</body>";
		var newstr = document.all.item(printpage).innerHTML;
		var oldstr = document.body.innerHTML;
		document.body.innerHTML = headstr+newstr+footstr;
		window.print();
		document.body.innerHTML = oldstr;
		return false;
	}
</script>
<div class="users reports-product form-admin form">
	<h3>Báo Cáo Hàng Tồn Kho</h3>
	
	<div id="viewer" class="table-responsive">
		<textarea id="report-ton-kho" >
			<div style="float:left;width: 100%;" class="info-report-left">
				<b>Cửa hàng Năng Lượng Xanh</b><br/>
				<b>79 Lê Lợi, Q.Hải Châu, Đà Nẵng</b><br/>
				<b>SĐT: 01657883098</b>
			</div>
			<div style="text-align: center;width: 100%; margin-bottom: 20px;" class="title-report">
				<?php date_default_timezone_set('Asia/Ho_Chi_Minh');?>
				<h1 style="margin-bottom: 0;">BÁO CÁO HÀNG TỒN KHO</h1>
			</div>
			<table align="center" border="1" cellpadding="1" cellspacing="1" class="table table-bordered table-hover">
				<tr class="first">
					<th>Mã sản phẩm</th>
					<th>Tên sản phẩm</th>
					<th>Mã HSX</th>
					<th>Giá Bán</th>
					<th>Số Lượng</th>
					<th>Ngày Nhập</th>
				</tr>
				<?php $total=0;?>
				<?php foreach ($products as $product): ?>
					<tr>
						<td><?php echo $product['Product']['MaPhone']; ?></td>
						<td>
							<?php echo $product['Product']['TenPhone']; ?>
						</td>
						<td>
							<?php echo $product['Product']['MaHangSX']; ?>
						</td>
						<td>
							<?php echo number_format($product['Product']['GiaBan']); ?>
						</td>
						<td>
							<?php echo $product['Product']['SoLuong']; ?>
						</td>
						<td>
							<?php echo $product['Product']['created']; ?>
						</td>
					</tr>
					<tr>
						<td colspan="5" style="text-align: right;font-weight: bold;padding: 0 10px;">Cộng nhóm </td>
						<td style="font-weight: bold;padding: 0 10px;"><?php echo number_format($product['Product']['GiaBan']*$product['Product']['SoLuong']);?></td>
					</tr>
					<?php $total = $total + ($product['Product']['GiaBan']*$product['Product']['SoLuong']);?>
				<?php endforeach; ?>
				<tr>
					<td colspan="5" style="text-align: right;font-weight: bold;padding: 0 10px;">Tổng giá trị hàng tồn kho</td>
					<td style="font-weight: bold;padding: 0 10px;"><?php echo number_format($total);?></td>
				</tr>
				<?php unset($product); ?>


			</table>
			<div style="width: 100%;text-align: right;margin-top: 20px;">
			<strong style="text-align: center;">Đà Nẵng, Ngày <?php echo date('d');?>, tháng <?php echo date('m')?>, năm <?php echo date('Y')?></strong>
			</div>
			<div style="float: left;text-align: center;width: 150px;margin-top: 10px;" class="footer-report-left">
				<strong style="text-align: center;">Người lập</strong><br/>
				<p style="text-align: center;">(Ký, họ tên)</p>
			</div>
			<div style="float: right;text-align: center;width: 250px;margin-top: 10px;" class="footer-report-right">
				<strong style="text-align: center;">Kế toán trưởng</strong><br/>
				<p style="text-align: center;">(Ký, họ tên)</p>
			</div>
		</textarea>
		<script type="text/javascript" language="javascript"> CKEDITOR.replace( "report-ton-kho" );</script> 
	</div>
</div>
<head>
<script>
function clear_cart() {
	var result = confirm('Bạn có muốn xóa toàn bộ giỏ hàng ?');
	
	if(result) {
		window.location = "<?php echo base_url(); ?>default/cart/remove/all";
	}else{
		return false; // cancel button
	}
}
</script>
</head>


<div class="center_content">
	<div style="padding-bottom: 10px">
		<h1 align="center" style="color: red;">Giỏ hàng</h1>
		<input type="button" value="Tiếp tục mua hàng"
			onclick="window.location= '<?php echo base_url(); ?>default/product/listproduct'" />
	</div>
	<div style="color: #F00"><?php echo $message?></div>
	<table class='imagetable' width="100%">
		<?php if ($cart = $this->cart->contents()) { ?>
		<tr>
			<th>Số thứ tự</th>
			<th>Tên hàng</th>
			<th>Giá</th>
			<th>Số lượng</th>
			<th>Tiền</th>
			<th>Bỏ</th>
		</tr>
		<?php
			echo form_open ( 'default/cart/update_cart' );
			$grand_total = 0;
			$i = 1;
			
			foreach ( $cart as $item ) {
				echo form_hidden ( 'cart[' . $item ['id'] . '][id]', $item ['id'] );
				echo form_hidden ( 'cart[' . $item ['id'] . '][rowid]', $item ['rowid'] );
				echo form_hidden ( 'cart[' . $item ['id'] . '][name]', $item ['name'] );
				echo form_hidden ( 'cart[' . $item ['id'] . '][price]', $item ['price'] );
				echo form_hidden ( 'cart[' . $item ['id'] . '][qty]', $item ['qty'] );
				?>
		<tr bgcolor="#FFFFFF">
			<td><?php echo $i++; ?></td>
			<td><?php echo $item['name']; ?></td>
			<td><?php echo $item['price']; ?> VNĐ</td>
			<td><?php echo form_input('cart['. $item['id'] .'][qty]', $item['qty'], 'maxlength="3" size="1" style="text-align: right"'); ?></td>
			<?php $grand_total = $grand_total + $item['subtotal']; ?>
			    <td><?php echo $item['subtotal'];?> VNĐ</td>
			<td><?php echo anchor('default/cart/remove/'.$item['rowid'],'<img src='.base_url('public/images/edit-button.png').' >'); ?></td>
			<?php } ?>
		</tr>
		<tr>
			<td><b>Tổng tiền: <?php echo $grand_total; ?> VNĐ</b></td>
			<td colspan="5" align="right"><input type="button" value="Xóa toàn bộ giỏ hàng" onclick="clear_cart()"> 
			<input type="submit" value="Cập nhật giỏ hàng"> <?php echo form_close(); ?>
			<input type="button" value="Checkout" onclick="window.location='<?php echo base_url(); ?>default/checkout'"></td>
		</tr>
		<?php } ?>
	</table>
</div>
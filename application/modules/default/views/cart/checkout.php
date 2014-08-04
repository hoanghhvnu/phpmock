<form name="checkout" method="post"
	action="<?php echo base_url().'default/checkout' ?>">
	<input type="hidden" name="command" />
	<div class="center_content">
		<h1 align="center" style="color: red;">THÔNG TIN ĐƠN HÀNG</h1>

		<table border='1' cellpadding="2px" style="font-size: 14px; " width="100%" >
			<th>Mã sản phẩm</th>
			<th>Tên hàng</th>
			<th>Giá</th>
			<th>Số lượng</th>
			<th>Tiền</th>

    			<?php
				$cart = $this->cart->contents ();				
				foreach ( $cart as $item ) {					
					echo "<tr>";
					echo "<td>" . $item ['id'] . "</td>";			
					echo "<td>" . $item ['name'] . "</td>";
					echo "<td>" . $item ['price'] . " VNĐ</td>";
					echo "<td>" . $item ['qty'] . "</td>";
					echo "<td>" . $item ['qty'] * $item ['price'] . " VNĐ</td>";
					echo "</tr>";
				} // end foreach
				?>
   		 </table>
   		 <br>
   		 <br>

		<table border="0" cellpadding="2px" style="font-size: 14px;">
			<tr>
				<td>Tổng tiền:</td>
				<td><strong><?php echo $money; ?> VNĐ</strong></td>
			</tr>
        	<?php if($money==0) echo "Bạn chưa mua sản phẩm nào ! Không thể gửi đơn hàng !" ?>
           
            <tr>
				<td>Tên khách hàng:</td>
				<td><input type="text" name="name" />
            <?php echo form_error ( 'name' ) . "<br/>"; ?>
            </td>
			</tr>
			
			<tr>
				<td>Giới tính:</td>
   			<td>
    		Nam&nbsp;<input type="radio" name="gender" value="1" checked="checked" />
    		Nữ&nbsp;<input type="radio" name="gender" value="2" />
            <?php echo form_error ( 'gender' ) . "<br/>"; ?>
            </td>
			</tr>

			<tr>
				<td>Địa chỉ:</td>
				<td><input type="text" name="address" />
            <?php echo form_error ( 'address' ) . "<br/>"; ?>
            </td>
			</tr>

			<tr>
				<td>Email:</td>
				<td><input type="text" name="email" />
             <?php echo form_error ( 'email' ) . "<br/>"; ?>
             </td>
			</tr>

			<tr>
				<td>Điện thoại:</td>
				<td><input type="text" name="phone" />
            <?php echo form_error ( 'phone' ) . "<br/>"; ?>
            </td>
			</tr>

			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" value="Gửi đơn hàng" name="btnok" /></td>
			</tr>
		</table>
	</div>
</form>

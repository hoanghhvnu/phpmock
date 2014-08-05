<div class="right_content">
	<div class="shopping_cart">
		<div class="cart_title">Giỏ hàng</div>
		<div class="cart_details">


			<a class="tooltipp" href="<?php echo base_url(); ?>default/cart"> 
        	
        	<?php if (isset($total)) echo $total." sản phẩm";?>
			
			<div class="custom info">
				<table class='imagetable'  >

						<th>Tên hàng</th>
						<th>Giá</th>
						<th>Số lượng</th>
						<th>Tiền</th>

    			<?php
				$cart = $this->cart->contents ();
				foreach ( $cart as $item ) {					
					echo "<tr>";		
					echo "<td>" . $item ['name'] . "</td>";
					echo "<td>" . $item ['price'] . " VNĐ</td>";
					echo "<td>" . $item ['qty'] . "</td>";
					echo "<td>" . $item ['qty'] * $item ['price'] . " VNĐ</td>";
					echo "</tr>";
				} // end foreach
				
				?>
   		   </table>
   	
					<?php
					echo "<p style='font-family: verdana,arial,sans-serif;font-size:11px;'>
		           Tổng tiền: ". $money . " VNĐ</p>";
					?>		
			</div>
			</a> <span class="border_cart"></span>
			<span class="price">
            <?php if (isset($money)) echo $money; ?> VNĐ
            </span>
		</div>
		<div class="cart_icon">

			<img src="http://localhost/phpmock/public/images/shoppingcart.png"
				alt="" width="48" height="48" border="0" />
		</div>
	</div>
	<ul class="left_menu">
		<li class="odd"></li>
	</ul>
</div>
<!-- end of right content -->
</div>
<div class="center_content">
	<div class="center_title_bar"><?php echo $product['pro_name']; ?></div>
	<div class="prod_box_big">
		<div class="top_prod_box_big"></div>
		<div class="center_prod_box_big">
			<div class="product_img_big">
				<div id="image">
					<a
						href="javascript:popImage('http://localhost/phpmock/public/images/big_pic.jpg','Some Title')"
						title="header=[Zoom] body=[&nbsp;] fade=[on]"> <img id="theImage"
						src="http://localhost/phpmock/public/images/detailpro/thumbs/<?php echo $image; ?>"
						alt="Main" />
					</a>
				</div>
				<div class="thumbs">
				<table>
				<tr>
			<?php
			
$i = 0;
			foreach ( $thumbs as $value ) {
				
				$value ['img_name'];
				?>
				<td>
    			 <img >
						src="http://localhost/phpmock/public/images/detailpro/thumbs/<?php echo $value['img_name']; ?>"
						onmouseover="swapImage(<?php echo $i;?>);" />
						</td>
    		<?php
				
$i ++;
			}
			?>
			</tr>
</table>
				
			</div>
			</div>
			<div class="details_big_box">
				<div class="product_title_big"><?php echo $product['pro_name']; ?></div>
				<div class="specifications">
					Description: <span class="blue"><?php echo $product['pro_desc']; ?></span><br />
					Information: <span class="blue"><?php echo $product['pro_info']; ?></span><br />
					Status: <span class="blue"><?php echo $product['pro_status']; ?></span><br />
					Brand: <span class="blue"><?php echo $bran['bran_name']; ?></span><br />
					Country: <span class="blue"><?php echo $country['coun_name']; ?></span>
				</div>
				<div class="prod_price_big">
					<span class="reduce"><?php echo $product['pro_price']; ?>$</span> <span
						class="price"><?php echo $product['pro_price_sale']?>$</span>
				</div>
				<a href="" class="addtocart"><?php
				$btnmua = array (
						'type' => 'image',
						'title' => 'Mua hàng',
						'src' => base_url () . 'public/images/cartbutton.png',
						'name' => 'image',
						'width' => '81',
						'height' => '20',
						'value' => 'Mua' 
				);
				$attributes = array('id' => 'muahang');

				echo form_open ( 'default/cart/add', $attributes);
				echo form_hidden ( 'id', $product ['pro_id'] );
				echo form_hidden ( 'name', $product ['pro_name'] );
				echo form_hidden ( 'price', $product ['pro_price_sale'] );
				echo form_input ( $btnmua );
				
				// echo form_submit('action', 'Mua');
				echo form_close ();
				?></a> <span class="star-rating"> <input type="radio" name="rating"
					value="1"><i></i> <input type="radio" name="rating" value="2"><i></i>
					<input type="radio" name="rating" value="3"><i></i> <input
					type="radio" name="rating" value="4"><i></i> <input type="radio"
					name="rating" value="5"><i></i>
				</span>
			</div>
		</div>
		<div class="bottom_prod_box_big"></div>
	</div>
	<div id="comment">
		<form method="post" action="/phpmock/default/comment/insertComment">
			<label for="name">Name</label> <input type="text" name="name"
				id="name" class="placeholder" placeholder="Nhập tên của bạn vào" /><br />
			<label for="email">Email</label> <input type="text" name="email"
				id="email" class="placeholder" placeholder="Nhập địa chỉ email vào" /><br />
			<textarea name="comments" cols="50" rows="10" class="placeholder"></textarea>
			<br>
			<div id="nutbam">
				<input type="submit" value="" name="btnok" id="submit"
					class="button"> <input type="reset" value="" id="reset"
					class="button">
			</div>
		</form>
	</div>

	<div id="post-comment">
	<?php foreach ($comment as $value){?>
		<div id="author">
			<span><?php echo $value['com_author']; echo "(".$value['com_score'].")";?></span>
		</div>
		<div id="post-content">
			<p><?php echo $value['com_content']; ?></p>
		</div>
	<?php }?>
	</div>
</div>
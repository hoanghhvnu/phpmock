
        	<ul>
                <?php
                    if(isset($products) && $products != null ) {
                        foreach($products as $list){
					$id = $list['pro_id'];
					$name = $list['pro_name'];
					$description = $list['pro_desc'];
					$price = $list['pro_price_sale'];

                ?>
            	<li >
                	<h3><a href="<?php echo base_url(); ?>default/product/detailproduct/<?php echo $list['pro_id']; ?>"><?php echo $list['pro_name']; ?></a></h3>
                	<a href="<?php echo base_url(); ?>default/product/detailproduct/<?php echo $list['pro_id']; ?>">
                    <img src="<?php echo base_url(); ?>uploads/product/<?php echo $list['pro_images']; ?>" class="product" height="100" />
                    <p class="bginfo">
					<span><?php echo $list['pro_info']; ?></span>

					</p>
                    </a>
    
                    <p>Giá gốc:<span class="reduce"> <?php echo $list['pro_price']; ?> </span> VNĐ</p>
                    <p style="color: red;"><b>KM: <?php echo $list['pro_price_sale']; ?> VNĐ</b></p>
                    <p><?php echo $list['pro_desc']; ?></p>
               
                    <div class="cart" align="center"><?php
                    $btnmua = array(
                    		'type'      => 'image',
							'title'     => 'Mua hàng',
                    		'src'        => base_url().'public/images/cartbutton.png',
                    		'name'        => 'image',
                    		'width'     => '81',
                    		'height'    => '20',
                    		'value'        => 'Mua',
							
                    
                    );
					
					echo form_open('default/cart/add');
					echo form_hidden('id', $id);
					echo form_hidden('name', $name);
					echo form_hidden('price', $price);
					echo form_input($btnmua);
                    
					
					//echo form_submit('action', 'Mua');
					echo form_close();
					?></div> 
                </li>
                                
                <?php }} ?>
            </ul>           
             

 


		
		
	

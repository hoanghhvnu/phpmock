
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Web ban hang</title>

</head>
<body>

<br>



    <div id="center" class="center_content">
        <!-- form for Sorting ========================================================================= -->
        <form action = '' method="post" style="float:right;margin:10px">
            <label>Sắp xếp theo</label>

            <select name = "SortField">
                <option value = 'pro_name'>Name</option>
                <option value = 'pro_price'>Price</option>
                <option value = 'pro_date'>Date</option>
            </select>

            <label>Type</label>
            <select name = "SortType">
                <option value="asc">Ascending</option>
                <option value="desc">Descending</option>
            </select>

            <input type="submit" name = 'btnok'>
        </form>
        <!-- end form for Sorting ===================================================================== -->

        <span style="font-size:130%;font-weight:bold">
            <?php echo "Page: " . $this->pagination->create_links (); ?> 
        </span>
        
    	<ul style="clear:both;float:left">
            <?php
                if(isset($products) && $products != null ) {
                    foreach($products as $list){
    					$id = $list['pro_id'];
    					$name = $list['pro_name'];
    					$description = $list['pro_desc'];
    					$price = $list['pro_price'];

            ?>
        	<li style="margin-left:10px;">
            	<a href="/phpmock/default/product/detailproduct/<?php echo $list['pro_id']; ?>">
                <h3><?php echo $list['pro_name']; ?></h3>
                <img src="/phpmock/uploads/product/<?php echo $list['pro_images']; ?>" class="product" height="100" />
                </a>

                <p class = 'price' >
                Giá tiền: <span style="font-weight:bold;color:blue" ><?php echo $list['pro_price']; ?></span>  VNĐ
                </p>

                <p><?php echo $list['pro_desc']; ?></p>

                <p class="cart">
                <?php
    				echo form_open('default/cart/add');
    				echo form_hidden('id', $id);
    				echo form_hidden('name', $name);
    				echo form_hidden('price', $price);
    				echo form_submit('action', 'Add to Cart');
    				echo form_close();
    			?>
                </p>

            </li>
                            
            <?php }} ?>
        </ul>
    </div>
      
        
</body>

		
		
	

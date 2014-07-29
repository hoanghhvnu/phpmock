<div id = 'center'>
    <h3>List Order </h3>
    <div id = 'listorder'>
    	<div id = 'modlistbran'>
    	    
    	    <form action = '' method = 'post'>
                <?php echo form_fieldset("Option display"); ?>
    	        <label>Số order/trang: </label>
    	        <input class = 'txt' type = 'text' name = 'per_page' value = <?php echo isset($per) ? $per : "" ?>>
    	        <span>Hiện tất cả </span><input type = 'checkbox' name = 'show_all' value = 'show'>
    	        <br/><br/>
                <?php echo form_fieldset_close();?>
                <?php echo form_fieldset("Search"); ?>
                <label>Tìm kiếm theo Mã đơn hàng </label>
                <input class = 'txt' type = 'text' name = 'SearchById' value = "" ?>
                <br/>
                <?php echo form_fieldset_close();?>
                

    	        <input type = 'submit' name = 'btnok' value = 'Gửi'>
    	    </form>
    	        
    	</div>
        <div style="clear:both"></div>
    	<?php  echo "Trang: ";
    	        echo isset($link) ? $link : "";  ?>
    	<table border="1"  style="clear:both">
    		<?php
    		    // print_r($column);
    		    // echo $_SESSION['per_page'];
    		    // echo $_SESSION['show_all'];
    		    if ($sortType == 'asc'){
    		        $newSort = 'desc';
    		        $imageName = "up-arrow-sort.png";
    		    }else{
    		        $newSort = 'asc';
    		        $imageName = "down-arrow-sort.png";
    		    }
    		?>
    		<th><a href = '<?php echo base_url("administrator/order/listorder/order_id/$newSort/1") ?>'>ID</a>
    		    <?php if ($column == 'order_id') echo "<img src = '" . base_url("public/images") . "/" . $imageName . "'>";?>
    		</th>

    		<th><a href = '<?php echo base_url("administrator/order/listorder/order_status/$newSort/1") ?>'>Order Status</a>
    		    <?php if ($column == 'order_status') echo "<img src = '" . base_url("public/images") . "/" . $imageName . "'>";?>
    		</th>

    		<th><a href = '<?php echo base_url("administrator/order/listorder/cus_name/$newSort/1") ?>'>Order Name</a>
    		    <?php if ($column == 'cus_name') echo "<img src = '" . base_url("public/images") . "/" . $imageName . "'>";?>
    		</th>
    		<th><a href = '<?php echo base_url("administrator/order/listorder/cus_email/$newSort/1") ?>'>Customer Email</a>
    		    <?php if ($column == 'cus_email') echo "<img src = '" . base_url("public/images") . "/" . $imageName . "'>";?>
    		</th>
    		<th><a href = '<?php echo base_url("administrator/order/listorder/cus_phone/$newSort/1") ?>'>Customer phone</a>
    		    <?php if ($column == 'cus_phone') echo "<img src = '" . base_url("public/images") . "/" . $imageName . "'>";?>
    		</th>
    		<th><a href = '<?php echo base_url("administrator/order/listorder/cus_address/$newSort/1") ?>'>Customer address</a>
    		    <?php if ($column == 'cus_address') echo "<img src = '" . base_url("public/images") . "/" . $imageName . "'>";?>
    		</th>
    		<th><a href = '<?php echo base_url("administrator/order/listorder/cus_gender/$newSort/1") ?>'>Customer gender</a>
    		    <?php if ($column == 'cus_gender') echo "<img src = '" . base_url("public/images") . "/" . $imageName . "'>";?>
    		</th>

    		<th><a href = '<?php echo base_url("administrator/order/listorder/order_date/$newSort/1") ?>'>Order date</a>
    		    <?php if ($column == 'order_date') echo "<img src = '" . base_url("public/images") . "/" . $imageName . "'>";?>
    		</th>

    		
    		<!-- <th>Order Id</th>
    		<th>Order Status</th>
    		<th>Customer Name</th>
    		<th>Customer Email</th>
    		<th>Customer Phone</th>
    		<th>Customer Address</th>
    		<th>Customer Gender</th>
    		<th>Order Date</th> -->
    		
    		<th>Detail</th>
    		<!-- <th>Edit</th>
    		<th>Delete</th> -->
    		<?php
    			$Status = array(
    				'1' => "Đã xác nhận",
    				'2' => "Chưa xác nhận"
    				);
    			$Gender = array(
    				'1' => "Nam",
    				'2' => "Nữ"
    				);
    			if(isset($ListOrder) && ! empty($ListOrder)){

    				foreach ($ListOrder as $key => $value) {
    					echo "<tr>";
    					echo "<td>" . $value['order_id'] . "</td>";
    					echo "<td>";
    					echo "<a href = '" . base_url("/administrator/order/orderdetail/") . "/" . $value['order_id'] . "'>";
    					if($value['order_status'] == 1){
    					    echo $Status[$value['order_status']] . "<br/><br/>";
    					} else{
    					    echo "<span class = 'error'>" . $Status[$value['order_status']] . "</span><br/><br/>";
    					}
    					echo "</a>";
    					echo "</td>";
    					echo "<td>" . $value['cus_name'] . "</td>";
    					echo "<td>" . $value['cus_email'] . "</td>";
    					echo "<td>" . $value['cus_phone'] . "</td>";
    					echo "<td>" . $value['cus_address'] . "</td>";
    					echo "<td>" . $Gender[$value['cus_gender']] . "</td>";
    					echo "<td>" . $value['order_date'] . "</td>";
    					
    					echo "<td><a href = '" . base_url("/administrator/order/orderdetail/") . "/" . $value['order_id'] . "'>Detail</a></td>";
    					// echo "<td><a href = '" . base_url("/administrator/order/update/") . "/" . $value['order_id'] . "'>Edit</a></td>";
    					// echo "<td><a href = '" . base_url("/administrator/order/delete/") . "/" . $value['order_id'] . "'>Delete</a></td>";
    					
    					echo "</tr>";
    				}
    			}
    		?>
    		
    	</table>

    </div>
</div> <!-- end div center --> 
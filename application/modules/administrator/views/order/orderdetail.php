<div id = 'center'>
    <h3>Order Detail </h3>
    <div id = 'listorder'>
        
        <?php
            $Status = array(
                '1' => "Đã xác nhận",
                '2' => "Chưa xác nhận"
                );
            $Gender = array(
                '1' => "Nam",
                '2' => "Nữ"
                );
        ?>
        <label>Order Id</label>
        <?= $OrderInfo['order_id'] ?> <br/> <br/>
        <label>Order Status</label>
        <?php
            if($OrderInfo['order_status'] == 1){
                echo $Status[$OrderInfo['order_status']] . "<br/><br/>";
            } else{
                echo "<span class = 'error'>" . $Status[$OrderInfo['order_status']] . "</span><br/><br/>";
            }
        ?>
        <label>Customer Name</label>
        <?= $OrderInfo['cus_name'] ?> <br/> <br/>
        <label>Customer Email</label>
        <?php echo $OrderInfo['cus_email'] . "<br/><br/>"; ?>
        <label>Customer Phone</label>
        <?php echo $OrderInfo['cus_phone'] . "<br/><br/>"; ?>
        <label>Customer Address</label>
        <?php echo $OrderInfo['cus_address'] . "<br/><br/>"; ?>
        <label>Customer Gender</label>
        <?php echo $Gender[$OrderInfo['cus_gender']] . "<br/><br/>"; ?>
        <label>Order Date</label>
        <?php echo $OrderInfo['order_date'] . "<br/><br/>"; ?>
        
        
    	<table border="1" >
    		<th>Product Id</th>
    		<th>Product Name</th>
    		<th>Product Price</th>
    		<th>Product quantity</th>
    		<th>Total money</th>
    		
    		<?php
                $TotalMoney = 0;
                // print_r($OrderDetail);
    			if(isset($OrderDetail) && ! empty($OrderDetail)){
    				foreach ($OrderDetail as $key => $value) {
                        $TotalMoney += $value['pro_price'] * $value['pro_quantity'];
    					echo "<tr>";
    					echo "<td>" . $value['pro_id'] . "</td>";
    					echo "<td>" . $value['pro_name'] . "</td>";
    					echo "<td>" . $value['pro_price'] . "</td>";
    					echo "<td>" . $value['pro_quantity'] . "</td>";
    					echo "<td>" . $value['pro_price'] * $value['pro_quantity'] . "</td>";
    					echo "</tr>";
    				}
    			} // end if isset
                
    		?>
    		
    	</table>
        <?php
            echo "<b>Tổng số tiền:</b> " . $TotalMoney . "<br/><br/>";

            if($OrderInfo['order_status'] == 2){
                echo "<a style='font-weight: bold;font-size: 20px;color:white;background-color:green;' href = '" 
                . base_url("/administrator/order/orderdetail/") . "/" 
                . $OrderInfo['order_id'] . "/approve" . "'>Xác nhận thanh toán</a></br><br/>";

                echo "<a style='font-weight: bold;color:white;background-color:red' href = '" 
                . base_url("/administrator/order/orderdetail/") . "/" 
                . $OrderInfo['order_id'] . "/cancel" . "'
                onclick='if(CheckDelete() == false) return false'
                >Huỷ đơn hàng</a></br>";
            }
            

        ?>
        
        
        
    </div>
</div> <!-- end div center --> 
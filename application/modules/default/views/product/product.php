
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Web ban hang</title>
<script type="text/javascript">
    /////////////////////////////
    // jQuery import in header //
    ////////////////////////////
/**
 * writen by HoangHH
 * get new list product from sever
 * @return {[type]} [description]
 */
function reload(){
    var SortField = $('#SelField').val();
    var SortType = $("#SelType").val();

    $.ajax({
        url: "receiveAjax",
        // url: "http://localhost/phpmock/default/product/listproduct//receiveAjax",
        type: "post", //can be post or get
        data: {'SortField':SortField,'SortType':SortType}, 
        success: function(result){
            var objResult = $.parseJSON(result);
            
            $('#listitem').empty();
            var list = "";
            list += "<ul style='clear:both;float:left'>";

            $.each(objResult,function(index,value){
                // $('#listitem').append("<li style='margin-left:10px;'>");
                list += "<li style='margin-left:10px;'>"
                list += "<a href='/phpmock/default/product/detailproduct/" + value.pro_id + "'>";
                list += "<h3>" + value.pro_name + "</h3>";
                list += "<img src='/phpmock/uploads/product/" + value.pro_images +  "' class='product' height='100' />";
                list += "</a>";
                list += "<p class = 'price' >";
                list += "Giá tiền: <span style='font-weight:bold;color:blue' >" + value.pro_price +  "</span>VNĐ</p>";
                list += "<p>" + value.pro_desc + "</p>";
                list += "<p class='cart'>";
                list += "<form action='default/cart/add' method = 'post'>";
                list += "<input type='hidden' name = 'id' value='" + value.pro_id + "' >";
                list += "<input type='hidden' name = 'name' value='" + value.pro_name + "' >";
                list += "<input type='hidden' name = 'price' value='" + value.pro_price +"' >";
                list += "<input type='submit' name = 'action' value='Add to Cart'>";
                list += "</form>";
                list += "</p>";
                list += "</li>";

            }); // end .each
            list += "</ul>";

            $('#listitem').append(list);
        } // en success
    }); // end .ajax
} //end reload()

/**
 * written by HoangHH
 * Event change Sort option
 * @return {[type]} [description]
 */
    $(document).ready(function(){
        // alert("jquery ok");
        $("#SelField").change(function(){
            reload();
        });

        $("#SelType").change(function(){
           reload();
        });
    });
</script>
</head>
<body>


<br>



    <div id="center" class="center_content">
        <!-- form for Sorting ========================================================================= -->
        <form action = '' method="post" style="float:right;margin:10px">
            <label>Sắp xếp theo</label>

            <select name = "SortField" id = 'SelField' >
                <option value = 'pro_name'>Name</option>
                <option value = 'pro_price'>Price</option>
                <option value = 'pro_date'>Date</option>
            </select>

            <label>Type</label>
            <select name = "SortType" id = 'SelType'>
                <option value="asc">Ascending</option>
                <option value="desc">Descending</option>
            </select>

            
        </form>

    
        <!-- end form for Sorting ===================================================================== -->

        <span style="font-size:130%;font-weight:bold">
            <?php echo "Page: " . $this->pagination->create_links (); ?> 
        </span>
        <div id = 'listitem'>
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
    	
    </div>
      
        
</body>

		
		
	

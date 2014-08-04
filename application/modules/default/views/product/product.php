<style type="text/css">
    #linkpage{
        clear: both;
        text-align: center;
    }
    #linkpage a{
        width: 20px;
        height: 20px;
        display: inline-block;
        background-color: #C7BFC7;
        cursor: pointer;
        /*text-decoration: underline;*/
        color: blue;
        font-size: 120%;
        font-weight: bold;
    }

    #linkpage a[bold=true]{
        background-color: #2cca65;
    }
    .error{
        color: red;
        background-color: gray;
    }
    #listitem a{
        text-decoration: none;
        color: black;
        
    }
    
</style>
<script type="text/javascript">
    /////////////////////////////
    // jQuery import in header //
    ////////////////////////////
    ///
    //aoseu
/**
 * writen by HoangHH
 * get new list product from sever
 * @return {[type]} [description]
 */
function reload(page){
    var SortField = $('#SelField').val();
    var SortType = $("#SelType").val();

    $.ajax({
        url: "receiveAjax",
        // url: "http://localhost/phpmock/default/product/listproduct/receiveAjax",
        type: "post", //can be post or get
        data: {'SortField':SortField,'SortType':SortType,'Page':page}, 
        success: function(result){
            $('#listitem').html(result);
            
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
            reload(1);
        });

        $("#SelType").change(function(){
           reload(1);
        });

        $('#linkpage a').click(function(){
            var page =  $(this).attr('repage');
            reload(page);
        });


    });
</script>
        	<ul>
                <?php
                    // if(isset($CurrentPage)){
                    //     echo "Trang hien tai " . $CurrentPage;
                    // } else{
                    //     echo "khong tim thay CurrentPage";
                    // }
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
             
            <div id = 'linkpage'>
                <?php 

                    // echo $CurrentPage;
                    echo "Page: ";
                    for($i = 1; $i <= $total_page; $i++){
                        echo "<a repage = '" . $i . "'";
                        if($CurrentPage == $i) echo "bold = 'true'";
                        echo ">" . $i . "</a>    ";
                    }
                    // echo "Page: " . $this->pagination->create_links ();
                ?> 
            </div>
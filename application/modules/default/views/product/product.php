<style type="text/css">
    #linkpage{
        clear: both;
        text-align: center;
    }
    #linkpage a{
        
        color: blue;
        /*width: 10px;
        height: 15px;*/
        /* margin-left: 5px; */
        display: inline-block;
        /* background-color: #FF0202; */
        cursor: pointer;
        /* text-decoration: underline; */
        /* color: blue; */
        font-size: 120%;
        /* font-weight: bold; */
        padding: 5px;
        border: thin #ddd solid;
    }

    #linkpage a[size=large]{
        width: 40px;
    }
    #linkpage a[bold=true]{
        /*background-color: #2cca65;*/
        cursor: default;
        color: grey;
        font-weight: bold;
    }
    .error{
        color: red;
        background-color: gray;
    }
    #listitem a{
        text-decoration: none;
        /*color: black;*/
        
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
        url: "http://localhost/phpmock/default/product/receiveAjax",
        // url: "http://localhost/phpmock/default/product/listproduct/receiveAjax",
        type: "post", //can be post or get
        data: {'SortField':SortField,'SortType':SortType,'Page':page}, 
        success: function(result){
            $('#listitem').html(result);
            // alert('reloaded');
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

        /**
         * prevent reload current page
         * @return {[type]} [description]
         */
        $('#linkpage a:not([bold=true])').click(function(){
            var page =  $(this).attr('repage');
            reload(page);
        });



    });
</script>
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
                            'type'   => 'image',
                            'title'  => 'Mua hàng',
                            'src'    => base_url().'public/images/cartbutton.png',
                            'name'   => 'image',
                            'width'  => '81',
                            'height' => '20',
                            'value'  => 'Mua',
							
                    
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
                    if(isset($total_page) && $total_page < 5 && isset($CurrentPage)){
                        for($i = 1; $i <= $total_page; $i++){
                            echo "<a repage = '" . $i . "'";
                            if($CurrentPage == $i) echo "bold = 'true'";
                            echo ">" . $i . "</a>    ";
                        }
                    } else if(isset($CurrentPage)){
                        
                        $min = $CurrentPage - 2;
                        if($min > 1){
                            echo "<a repage = '1' size='large'>First</a>";
                            echo "...";
                        } else{
                            $min = 1;
                        }
                        $max = $CurrentPage + 2;
                        if($max < $total_page){
                            // echo "<a repage ='" . $total_page . "'>Last</a>";
                        } else{
                            $max = $total_page;
                        }
                        for($i = $min; $i <= $max; $i++){
                            echo "<a repage = '" . $i . "'";
                            if($CurrentPage == $i) echo "bold = 'true'";
                            echo ">" . $i . "</a>    ";
                        }

                        if($max < $total_page){
                            echo "...";
                            echo "<a repage ='" . $total_page . "' size='large'>Last</a>";
                        }
                    }
                    
                    // echo "Page: " . $this->pagination->create_links ();
                ?> 
            </div>
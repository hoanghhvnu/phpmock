<style type="text/css">
    #linkpage{
        clear: both;
        text-align: center;
    }
    #linkpage a{
        
        cursor: pointer;
        /*text-decoration: underline;*/
        color: blue;
        font-size: 120%;
        font-weight: bold;
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
</head>
<body>


<br>



    <div id="center" class="center_content">
        <!-- form for Sorting ========================================================================= -->
        
        <div name = 'sort-function'>
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
        </div>
        

    
        <!-- end form for Sorting ===================================================================== -->

        

        <div id = 'listitem' style="clear:both">
        <?php  $this->load->view("product/product");?>
        </div>

        
        <div id = 'linkpage'>
            <?php 

                // echo $total_page;
                echo "Page: ";
                for($i = 1; $i <= $total_page; $i++){
                    echo "<a repage = '" . $i . "'>" . $i . "</a>    ";
                }
                // echo "Page: " . $this->pagination->create_links ();
            ?> 
        </div>
    	
    </div>
      
        
</body>

		
		
	

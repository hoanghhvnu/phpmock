


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

        
        
    	
    </div>
      
        
</body>

		
		
	

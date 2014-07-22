

    <div id = 'center'>
        <h3>Search Product</h3>
        <?php
            // writen by HoangHH Jul 21, 14:41

            $this->load->helper('form');
            
            echo form_fieldset("Search Product");
            // begin form
            if(isset($error)) echo "<span class = 'error'>"  . $error . "</span><br/>";
            
            echo "<form action = '' method = 'post'>";



            echo form_label("Product ID");
            $pro_id = array(
                            'class' => 'input_text',
                            'type' => 'text',
                            'name' => 'pro_id'
                            );
            echo form_input($pro_id);
            echo "<br/>";

            echo form_label("Product Name");
            $pro_name = array(
                            'class' => 'input_text',
                            'type' => 'text',
                            'name' => 'pro_name'
                            );
            echo form_input($pro_name);
            echo "<br/>";

            echo form_label("Product Price");
            $pro_price = array(
                            'class' => 'input_text',
                            'type' => 'text',
                            'name' => 'pro_price'
                            );
            echo form_input($pro_price);
            echo "<br/>";

            echo form_label("Product Price Sale");
            $pro_price_sale = array(
                            'class' => 'input_text',
                            'type' => 'text',
                            'name' => 'pro_price_sale'
                            );
            echo form_input($pro_price_sale);
            echo "<br/>";

            echo form_label("Product Images");
            $pro_images = array(
                            'class' => 'input_text',
                            'type' => 'text',
                            'name' => 'pro_images'
                            );
            echo form_input($pro_images);
            echo "<br/>";

            echo form_label("Product Description");
            $pro_desc = array(
                            'class' => 'input_text',
                            'type' => 'text',
                            'name' => 'pro_desc'
                            );
            echo form_input($pro_desc);
            echo "<br/>";

            echo form_label("Product Infomation");
            $pro_info = array(
                            'class' => 'input_text',
                            'type' => 'text',
                            'name' => 'pro_info'
                            );
            echo form_input($pro_info);
            echo "<br/>";

            echo form_label("Product status");
            $StatusActive = array(
                'name'  => 'pro_status',
                'value' => '1' // is StatusActive
                );
            // $StatusActive ['checked'] = set_radio('pro_status', '1', TRUE);
            
            echo "<span>Active</span>";
            echo form_radio($StatusActive);

            $StatusDeactive = array(
                'name'  => 'pro_status',
                'value' => '2' // is StatusDeactive
                );
            // $StatusDeactive ['checked'] = set_radio('pro_status', '0');
            echo "<span>Deactive</span>";
            echo form_radio($StatusDeactive);
            echo "<br/><br/>";

            

            echo form_label("Brand");
            echo "<select name='bran_id' size = '1'>";
            echo "<option value ='' selected></option>";
            
            foreach ($ListBrand as $key => $value) {
                // $Brand[$value['bran_id']] = $valvalue['bran_id']'bran_name'];
                echo "<option value ='" . $value['bran_id'] . "'>{$value['bran_name']}</option>";

            } //
            echo "</select>";
            echo "<br/>";

            echo form_label("Country");
            echo "<select name='coun_id' size = '1'>";
            echo "<option value ='' selected></option>";
            
            foreach ($ListCountry as $key => $value) {
                // $Brand[$value['bran_id']] = $valvalue['bran_id']'bran_name'];
                echo "<option value ='" . $value['coun_id'] . "'>{$value['coun_name']}</option>";

            } //
            echo "</select>";
            echo "<br/>";
            
            $submit = array(
                'type' => 'submit',
                'name' => 'btnok',
                'value' => 'submit',
                'content' => 'Tìm kiếm'
                );
            echo form_button($submit);
            echo "</form>";
            // end form
            // echo "<span class = 'error'>"  . $error . "</span>";
            echo form_fieldset_close();


            // Print Result
            ?>


        
        
       
    </div> <!-- end div center -->



<div id = 'center'>
    <h3>Insert Order</h3>
    <?php
        $this->load->helper('form');
        
        echo form_fieldset("Order Infomation");


        
        echo "<form action = '' method = 'post'>";

        echo form_label("Customer Name");
        $name = array(
                        'class' => 'input_text',
                        'name' => 'cus_name',
                        );
        $name['value'] = set_value('cus_name');

        echo form_input($name);
        if(isset($errorName)){
            echo "<span class = 'error'>" . $errorName . "</span>";
        }
        echo form_error('cus_name') . "<br/>";

        


        echo form_label("Customer Email");
        $email = array(
            'class' => 'input_text',
            'name' => 'cus_email'
            );
        $email['value'] = set_value('cus_email');
        echo form_input($email);
        if(isset($errorEmail)){
            echo "<span class = 'error'>" . $errorEmail . "</span>";
        }
        echo form_error('cus_email') . "<br/>";

        echo form_label("Customer Address");
        $address = array(
            'class' => 'input_text',
            'name' => 'cus_address'
            );
        $address['value'] = set_value('cus_address');
        echo form_input($address);
        echo form_error('cus_address') . "<br/>";

        echo form_label("Customer Phone");
        $phone = array(
            'class' => 'input_text',
            'name' => 'cus_phone'
            );
        $phone['value'] = set_value('cus_phone');
        echo form_input($phone);
        echo form_error('cus_phone') . "<br/>";

        echo form_label("Customer Gender");
        $male = array(
            'name'  => 'cus_gender',
            'value' => '1' // is Male
            );
        // $male ['checked'] = set_radio('cus_gender', '1', TRUE);
        
        echo "<span>Nam</span>";
        echo form_radio($male);
        $female = array(
            'name'  => 'cus_gender',
            'value' => '2' // is female
            );
        // $female ['checked'] = set_radio('cus_gender', '2', TRUE);
        echo "<span>Nữ</span>";
        echo form_radio($female);
        echo form_error('cus_gender') . "<br/>" ."<br/>";
        

        echo form_label("Order Status");
        $statusActive = array(
            'name'  => 'order_status',
            'value' => '1' // is statusActive
            );
        $statusActive ['checked'] = set_radio('order_status', '1', TRUE);
        
        echo "<span>Active</span>";
        echo form_radio($statusActive);
        $statusDeactive = array(
            'name'  => 'order_status',
            'value' => '2' // is statusDeactive
            );
        // $statusDeactive ['checked'] = set_radio('order_status', '2', TRUE);
        echo "<span>Deactive</span>";
        echo form_radio($statusDeactive);
        echo form_error('order_status') . "<br/>" ."<br/>";
     
        $submit = array(
            'type' => 'submit',
            'name' => 'btnok',
            'value' => 'submit',
            'content' => 'Submit'
            );
        echo form_button($submit);

        echo form_close();

        echo form_fieldset_close();
        ?>
</div> <!-- end div center -->
<h3>Insert Category</h3>
<?php
    $this->load->helper('form');
    echo form_fieldset("Category Infomation");

    echo "<form action = '' method = 'post'>";

    echo form_label("Category Name");
    $cate_name = array(
                    'class' => 'input_text',
                    'name' => 'cate_name',
                    'placeholder' => 'Nhập tên category'
                    );
    $cate_name['value'] = set_value('cate_name');
    echo form_input($cate_name);

    if(isset($errorCate)){
        echo "<span class = 'error'>" . $errorCate . "</span>";
    }
    echo form_error('cate_name') . "<br/>";

    echo form_label("Category Parent");
    $CateParent  = array();
    foreach ($ListInsert as $key => $value) {
        $CateParent[$value['cate_id']] = $value['cate_name'];

    } // end foreach
    $CateParent['0'] = "(None)";


    echo form_dropdown('cate_parent',$CateParent, '0', "size = 15") . "<br/>";
    // echo $usr_level;

    echo form_label("Category order");
    $CateOrder = array(
                    'class'       => 'input_text',
                    'name'        => 'cate_order',
                    'placeholder' => 'Index number',
                    'value'=> 1
                    );
    $CateOrder['value'] = set_value('CateOrder');

    echo form_input($CateOrder);
    echo form_error('cate_order') . "<br/>";
 
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
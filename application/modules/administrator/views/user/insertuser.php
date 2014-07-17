<head>
    <style type="text/css">
        label{
            float: left;
            width: 130px;
        }
        input.input_text{
            /*float: left;*/
            width: 250px;
        }
    </style>
</head>

<h3>Insert User</h3>
<?php
    $this->load->helper('form');

    echo form_fieldset("User Infomation");


    $form_formattr = array('id' => 'insertuserform',
                        );
    // echo form_open('user/insertUser', $form_formattr);
    echo "<form action = '' method = 'post'>";

    echo form_label("User Name");
    $user = array(
            'class' => 'input_text',
                    'name' => 'usr_name',
                    );
    echo form_input($user) . "<br/>";

    echo form_label("Password");
    $pass = array(
        'class' => 'input_text',
        'name' => 'usr_password'
        );
    echo form_password($pass) . "<br/>";

    echo form_label("Re-type Password");
    $repass = array(
        'class' => 'input_text',
        'name' => 'usr_retype_password'
        );
    echo form_password($repass) . "<br/>";


    echo form_label("Email");
    $email = array(
        'class' => 'input_text',
        'name' => 'usr_email'
        );
    echo form_input($email) . "<br/>";

    echo form_label("Address");
    $address = array(
        'class' => 'input_text',
        'name' => 'usr_address'
        );
    echo form_input($address) . "<br/>";

    echo form_label("Phone");
    $phone = array(
        'class' => 'input_text',
        'name' => 'usr_phone'
        );
    echo form_input($phone) . "<br/>";

    echo form_label("Gender");
    $male = array(
        'name'  => 'usr_gender',
        'value' => '1' // is Male
        );
    echo "<span>Nam</span>";
    echo form_radio($male);
    $female = array(
        'name'  => 'usr_gender',
        'value' => '2' // is femal
        );
    echo "<span>Nữ</span>";
    echo form_radio($female) . "<br/>";

    echo form_label("Level");
    $level = array(
        '1' => 'Administrator',
        '2' => 'User'
        );
    echo form_dropdown('usr_level',$level,'2') . "<br/>";

    $submit = array(
        'type' => 'submit',
        'name' => 'btnok',
        'value' => 'submit',
        'content' => 'Thêm user'
        );
    echo form_button($submit);

    echo form_close();

    echo form_fieldset_close();



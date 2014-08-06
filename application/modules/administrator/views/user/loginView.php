<?php

/**
 * @author easyvn.net
 * @copyright 2014
 */



?>
<style>
.error{
    color:red;
}
label{
    float:left;
    width: 100px;
}
</style>
<form action="" method="post">
<span class = 'error'>
<?php echo isset($errorLoginFail) ? $errorLoginFail : "" ?>
</span><br/>
<label> Username </label>
<input type="text" name="txtUser" value=""/> <br />
<?php echo form_error('txtUser'); ?>
<label> Password </label>
<input type="password" name="txtPass" value=""/> <br />
<?php echo form_error('txtPass'); ?>

<input type="submit" name="btnLogin" value="Login"/>

</form>
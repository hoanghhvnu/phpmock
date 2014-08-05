
<div id='center'>
	<h1>Cấu hình</h1>
	<form action="" method="post">

		<label>Perpage Default module</label> 
		<input type="text" name="PerpageDefault" value="<?php echo isset($PerpageDefault) ? $PerpageDefault : ''; ?>" size="30" /> 
				<span class='error'>
								<?php echo form_error("PerpageDefault"); ?>
		        </span> 
		<br/>

		<label>Perpage Admin module</label>
		<input type="text" name="PerpageAdmin" value="<?php echo isset($PerpageAdmin) ? $PerpageAdmin : ''; ?>" size="30" /> 
		<span class='error'>
						<?php echo form_error("PerpageAdmin"); ?>
        </span> 
        <br />
        <label>&nbsp;</label> 
        <input type="submit" name="ok" value="Update" /> 
        <input type="reset"  value="Reset" />
	</form>
</div>
<!-- end div id = center -->

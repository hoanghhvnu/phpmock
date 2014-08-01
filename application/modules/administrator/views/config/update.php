
<div id='center'>
	<h1>Cấu hình</h1>
	<form action="" method="post">

		<label>Số sản phẩm mỗi trang</label> 
		<input type="text" name="perpage" value="<?php echo $perpage; ?>" size="30" /> 
		<span class='error'>
						<?php echo form_error("perpage"); ?>
                        <?php echo isset($errorPerpage) ? $errorPerpage : ""; ?>
        </span> 
        <br />
        <label>&nbsp;</label> 
        <input type="submit" name="ok" value="Update" /> 
        <input type="reset"  value="Reset" />
	</form>
</div>
<!-- end div id = center -->

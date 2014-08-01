
		<div id="center">
        		<h1>Update nhãn hàng</h1>
                <form action="" method="post">
                	<label>Tên nhãn hàng</label>
                   	<input type="text" name="InputBrand" size="30"
                    value="<?php echo isset($branInfo['bran_name']) ? $branInfo['bran_name'] : ""; ?>"  />
                    
                    <span class = 'error'>
                        <?php echo form_error("InputBrand"); ?>
                        <?php echo isset($errorName) ? $errorName : ""; ?>
                    </span>
                    
                    
                    
                    <br />  
                    <label>&nbsp;</label> 
                    <input type="submit" name="ok" value="Update" />
                    <input type="reset" value="Reset" />                                  
                </form>
        </div>

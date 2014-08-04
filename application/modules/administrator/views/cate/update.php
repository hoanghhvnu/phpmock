        <div id="center">
                <h1>Update category</h1>
                <form action="" method="post">
                    <label>Tên category</label>
                       <input type="text" name="cate_name" value="<?php echo $categoryInfo['cate_name']; ?>" size="30" />
                    <?php echo form_error("cate_name"); ?>
                    <?php echo isset($errorName) ? $errorName : ""; ?>
                    <br />  

                       <label>Thứ tự category</label>
                       <input type="text" name="cate_order" value="<?php echo $categoryInfo['cate_order']; ?>" size="30" />
                    <?php echo form_error("cate_order"); ?>
                    <br />  
            <p>
                    <label>Category cha</label>
                    <select class="input-short" name="cate_parent" multiple="true" size = '10'>
                        <option value="0" <?php if($categoryInfo['cate_parent'] == 0){echo "selected='selected'";}?>> 
                        Menu gốc </option>
                        
                        <?php 
                        foreach($showCategory as $key=>$value)
                        { ?>
                        <option value="<?php echo $value['cate_id']; ?>" 
                      
                        <?php if($categoryInfo['cate_parent'] == $value['cate_id']){echo "selected='selected'";}?>>
                        
                        <?php echo $value['cate_name']; ?></option>
                        <?php } ?>
                    </select>
                    <br />
                    <?php 
                    
                        if(isset($errorTrung) && $errorTrung != ""){
                            echo $errorTrung;
                        }
                    ?>
            </p>
                <br />
                    <label>&nbsp;</label> 
                    <input type="submit" name="ok"  value="Update" />
                    <input type="reset" value="Reset" />                                  
                </form>
        </div>
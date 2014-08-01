
<div id = 'center'>
    <h3>Danh sách các thương hiệu</h3>
    <div id = 'FormSearchBrand'>
        <?php echo form_fieldset("Tuỳ chọn"); ?>
        <form action = '' method = 'post'>
        
            <label>Tìm nhãn hiệu: </label>
            <input type = 'text' name = 'InputBrand' placeholder = 'Nhập tên nhãn hiệu' value = ''>
            <input type = 'submit' name = 'btnok' value = 'submit'>

        </form>

        <?php echo form_fieldset_close();;?>
    </div>

    <div id = 'AdminListBrand'>
        <?php
            if(isset($link) && $link != ''){
                echo "Trang: " . $link;
            }
        ?>
        <table border = '1'>
            <?php
                if ($sortType == 'asc'){
                    $newSort = 'desc';
                    $imageName = "up-arrow-sort.png";
                }else{
                    $newSort = 'asc';
                    $imageName = "down-arrow-sort.png";
                }
            ?>
            <th class = 'small'>STT</th>
            <th class = 'small'><a href = '<?php echo base_url("administrator/bran/listbran/bran_id/$newSort/1") ?>'>ID</a>
                <?php if ($column == 'bran_id') echo "<img src = '" . base_url("public/images") . "/" . $imageName . "'>";?>
            </th>
            <th><a href = '<?php echo base_url("administrator/bran/listbran/bran_name/$newSort/1") ?>'>Name</a>
                <?php if ($column == 'bran_name') echo "<img src = '" . base_url("public/images") . "/" . $imageName . "'>";?>
            </th>

            <th class = 'small'>Edit</th>
            <th class = 'small'>Delete</th>
                <?php
                    $iterator = 1;
                    foreach ($listbran as $list) {

                        $id = isset($list['bran_id']) ? $list['bran_id'] : "error";
                        $name = isset($list['bran_name']) ? $list['bran_name'] : "error";
                        echo "<tr>";
                            echo "<td>" . $iterator++ . "</td>";
                            echo "<td>" . $id . "</td>";
                            echo "<td>" . $name . "</td>";
                            echo "<td>" . "<a href = '" . base_url("administrator/bran/update") . "/" . $id . "'>Edit</a>". "</td>";
                            echo "<td>" . "<a href = '" . base_url("administrator/bran/delete") . "/" . $id . "'>Delete</a>". "</td>";
                        echo "</tr>";
                    } // end foreach $listbran
                ?>
        </table>
    </div> <!-- end div#listbran -->
    
</div> <!-- end div id = center -->

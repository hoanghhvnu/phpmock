<?php $this->load->view('main/mainhead')?>
<div id = 'center'>
    <h3>Danh sách các thương hiệu</h3>
    <div id = 'modlistbran'>
        <?php echo form_fieldset("Tuỳ chọn"); ?>
        <form action = '' method = 'post'>
        <label>Số brand/trang: </label>
        <input class = 'txt' type = 'text' name = 'per_page' value = <?php echo isset($per) ? $per : "" ?>>
        <span>Hiện tất cả </span><input type = 'checkbox' name = 'show_all' value = 'show'>
        <br/>
        <label>Sắp xếp:</label>
        <span>Tăng dần</span>
        <input type = 'radio' name = 'sort' value = 'asc' <?php echo isset($sort_type) && $sort_type == 'asc' ? "checked" : "";?>>
        <span>Giảm dần</span>
        <input type = 'radio' name = 'sort' value = 'desc' <?php 
        echo isset($sort_type) && $sort_type == 'desc' ? "checked" : "";?>>
        <span>Không sắp xếp</span>
        <input type = 'radio' name = 'sort' value = 'none' <?php echo isset($sort_type) && $sort_type == 'none' ? "checked" : "";?>>
        <br/>
        <input type = 'submit' name = 'btnok' value = 'Gửi'>
    </form>
        <?php echo form_fieldset_close();;?>
    </div>

    <div id = 'listbran'>
        <?php  echo "Trang: ";
                echo isset($link) ? $link : "";  ?>
        <table border = '1'>
            <th>ID</th>
            <th>name</th>
            <th>Edit</th>
            <th>Delete</th>
                <?php
                    foreach ($listbran as $list) {

                        $id = isset($list['bran_id']) ? $list['bran_id'] : "error";
                        $name = isset($list['bran_name']) ? $list['bran_name'] : "error";
                        echo "<tr>";
                            echo "<td>" . $id . "</td>";
                            echo "<td>" . $name . "</td>";
                            echo "<td>" . "<a href = '" . base_url("administrator/bran/update") . "/" . $id . "'>Edit</a>". "</td>";
                            echo "<td>" . "<a href = '" . base_url("administrator/bran/delete") . "/" . $id . "'>Delete</a>". "</td>";
                        echo "</tr>";
                    } // end foreach $listbran
                ?>
        </table>
    </div>
    
</div> <!-- end div id = center -->
<?php $this->load->view('main/mainfoot')?>
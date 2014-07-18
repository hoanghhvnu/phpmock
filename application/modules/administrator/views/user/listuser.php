<?php $this->load->view('main/mainhead')?>



    <div id = 'center'>

        <h2>Danh sách user</h2>
            <div id = 'modlistbran'>
                <?php echo form_fieldset("Tuỳ chọn"); ?>
                <form action = '' method = 'post'>
                    <label>Số brand/trang: </label>
                    <input class = 'txt' type = 'text' name = 'per_page' value = <?php echo isset($per) ? $per : "" ?>>
                    <span>Hiện tất cả </span><input type = 'checkbox' name = 'show_all' value = 'show'>
                    <br/>
                    <input type = 'submit' name = 'btnok' value = 'Gửi'>
                </form>
                    <?php echo form_fieldset_close();;?>
            </div>


            <a href="insertuser">Thêm User</a>

        <?php  echo "Trang: ";
                echo isset($link) ? $link : "";  ?>
        <table border = 1 id = 'listuser'>
            <th>ID</th>
            <th>name</th>
            <th>password</th>
            <th>email</th>
            <th>address</th>
            <th>phone</th>
            <th>gender</th>
            <th>level</th>
            <th>Edit</th>
            <th>Delete</th>
            <?php
                foreach ($listuser as $list) {

                    # code...
                    echo "<tr>";
                        echo "<td>" . $list['usr_id'] . "</td>";
                        echo "<td>" . $list['usr_name'] . "</td>";
                        echo "<td>" . $list['usr_password'] . "</td>";
                        echo "<td>" . $list['usr_email'] . "</td>";
                        echo "<td>" . $list['usr_address'] . "</td>";
                        echo "<td>" . $list['usr_phone'] . "</td>";
                        echo "<td>" . $list['usr_gender'] . "</td>";
                        echo "<td>" . $list['usr_level'] . "</td>";
                        echo "<td>" . "<a href = '" . base_url("administrator/user/update") . "/" . $list['usr_id'] . "'>Edit</a>". "</td>";
                        /*echo "<td>" . "<a href = '" . base_url("administrator/user/delete") . "/" . $list['usr_id']
                         ."' onclick='if(CheckDelete() == false) return false' " . "'>Delete</a>". "</td>";*/
                        echo "<td>" . "<a href = '" . base_url("administrator/user/delete") . "/" . $list['usr_id']
                        ."' onclick='if(CheckDelete() == false) return false'>Delete</a></td>";
                        
                    echo "</tr>";

                } // end foreach $listuser
            ?>
        </table>
    </div>
    
    
<?php $this->load->view('main/mainfoot')?>
<?php $this->load->view('main/mainhead')?>
<script type="text/javascript">
            function CheckDelete(){

                    r = confirm("Bạn chắc chắn xoá không?");
                    if(r == false) return false;
                    else return true;
                                               
            }
</script>
<h2 style = "align:'center'">Danh sách user</h2>
    <a href="insertuser">Thêm User</a>
    <div id = 'center'>
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
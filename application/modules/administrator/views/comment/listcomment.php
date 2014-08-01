<?php $this->load->view('main/mainhead')?>
<div id='center'>
	<h3>List Comment</h3>

	<table border='1' cellspacing="0" cellpadding="0">
		<th>Author</th>
		<th>Email</th>
		<th>Content</th>
		<th>Score</th>
		<th>Status</th>
		<th>Delete</th>

    <?php
        // echo "<pre>";
        // print_r($orderList);
        foreach ($info as $key => $value){
            echo "<tr>";
            echo "<td>" . $value['com_author'] . "</td>";
            echo "<td>" . $value['com_email'] . "</td>";
            echo "<td>" . substr($value['com_content'], 0, 20). "..." . "</td>";
            echo "<td>" . $value['com_score'] . "</td>";
            echo "<td>" . $value['com_status'] . "</td>";
            // Phai truyen duoc id cua product
            echo '<td><a href='.base_url().'administrator/comment/detailComment/'.$value['com_id'].' >Detail</a></td>';
            echo "</tr>";
        } // end foreach
    ?>
    </table>
</div>
<?php $this->load->view('main/mainfoot')?>
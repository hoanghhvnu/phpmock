<?php $this->load->view('layout/header')?>
<div id="center">
	<h3>Detail Comment</h3>
	<table border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td><label>Author</label></td>
			<td><?php echo $info['com_author']; ?></td>
		</tr>
		<tr>
			<td><label>Email</label></td>
			<td><?php echo $info['com_email']; ?></td>
		</tr>
		<tr>
			<td><label>Content</label></td>
			<td><?php echo $info['com_content']; ?></td>
		</tr>
		<tr>
		<td><label>Score</label></td>
		<td><?php echo $info['com_score']; ?></td>
		</tr>
		<tr>
		<td><label>Status</label></td>
		<td><?php echo $info['com_status']; ?></td>
		</tr>
		<tr>
		<td><a href='<?php echo base_url(); ?>administrator/comment/aproveComment/<?php echo $info['com_id']; ?>' >Aprove</a></td>
		<td><a href='<?php echo base_url(); ?>administrator/comment/deleteComment/<?php echo $info['com_id']; ?>' >Delete</a></td>
		</tr>
	</table>
</div>
<?php $this->load->view('layout/footer')?>

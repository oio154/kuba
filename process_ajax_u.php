<?php
	include 'db.php';
	if(isset($_REQUEST['submit_form'])){
		
		$notes = mysqli_real_escape_string($conn, strip_tags($_REQUEST['notes']));
		$ins_sql = "INSERT INTO user (u_notes) VALUES ('$notes')";
		$run_sql = mysqli_query($conn, $ins_sql);
	}
	
	if(isset($_REQUEST['del_id'])){
		$del_sql = "DELETE FROM user WHERE u_id = '$_REQUEST[del_id]'";
		$del_run = mysqli_query($conn, $del_sql);
	}
	
	if(isset($_REQUEST['edit_form'])){
		
		$edit_notes = mysqli_real_escape_string($conn, strip_tags($_REQUEST['edit_notes']));
		$edit_sql = "UPDATE user SET u_notes = '$edit_notes' WHERE u_id = '$_REQUEST[edit_id]'";
		mysqli_query($conn, $edit_sql);
	}

    $sql = "SELECT * FROM users";
	$run = mysqli_query($conn, $sql);
	$c = 1;
	while($rows = mysqli_fetch_assoc($run)){
		echo "
			<tr>
				<td>$c</td>
				<td>$rows[u_id]</td>
				<td>$rows[u_notes]</td>
				<td class='text-left'>
					<button class='btn btn-success' data-toggle='modal' data-target='#edit_person$rows[u_id]'>Edit</button>
					<button class='btn btn-danger' onclick=delete_func('$rows[u_id]');>Delete</button>
					
					<div class='modal fade' id='edit_person$rows[u_id]'>
						<div class='modal-dialog'>
							<div class='modal-content'>
							
								<div class='modal-header'>Header</div>
								<div class='modal-body'>
									<form onsubmit='return edit_form($rows[u_id]);' id='edit_form$rows[u_id]'>
										<div class='form-group'>
											<label>Notes</label>
											<textarea id='edit_notes$rows[u_id]' class='form-control'>$rows[u_notes]</textarea>
										</div>
										<div class='form-group'>
										<button class='btn btn-info btn-block btn-lg'>Done Editing</button>
									</div>
									</form>
								</div>
								<div class='modal-footer'>
									<div class='text-right'>
										<button class='btn btn-danger' data-dismiss='modal'>Close</button>
									</div>
								</div>
							</div>
						</div>x
					</div>
				</td>
			</tr>
		";
		$c++;
	}
?>
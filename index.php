<?php  
include('config/conn.php');
$names = mysqli_query($conn, "SELECT * FROM names");
?>
<?php include('includes/header.php') ?>
<div class="container">
	<div class="table-wrapper">
		<div class="table-title">
			<div class="row">
				<div class="col-sm-6">
					<h2>Manage <b>Employees</b></h2>
				</div>
				<div class="col-sm-6">
					<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Employee</span></a>
					<a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>
				</div>
			</div>
		</div>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>
						<span class="custom-checkbox">
							<input type="checkbox" id="selectAll">
							<label for="selectAll"></label>
						</span>
					</th>
					<th>Name</th>
				</tr>
			</thead>
			<tbody id="table">
				<?php foreach($names as $name) : ?>
				<tr id="<?= $name['id'] ?>">
					<td>
						<span class="custom-checkbox">
							<input type="checkbox" id="checkbox1" name="options[]" value="1">
							<label for="checkbox1"></label>
						</span>
					</td>
					<td style="width: 80%;" class="name"><?= $name['name'] ?></td>
					<td>
						<a href="#editEmployeeModal" class="edit editIcon" data-toggle="modal" value="<?= $name['id'] ?>">
							<i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
						</a>
						<a href="#deleteEmployeeModal" class="deleteIcon delete" data-toggle="modal" value="<?= $name['id'] ?>">
							<i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
						</a>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
<!-- Add Modal HTML -->
<div id="addEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" action="" id="insertForm">
				<div class="modal-header">
					<h4 class="modal-title">Add Employee</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Name</label>
						<input type="text" id="insertNameInput" name="name" class="form-control">
					</div>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-success" value="Add">
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Edit Modal HTML -->
<div id="editEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" action="" class="editForm">
				<div class="modal-header">
					<h4 class="modal-title">Edit Employee</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="name" id="editNameInput" class="form-control" required>
					</div>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-info" value="Save">
				</div>
			</form>
		</div>
	</div>
</div>


<script type="text/javascript">

// INSERT

$("#insertForm").on("submit", function(e) {
	e.preventDefault();
	$.post('insert.php', {name: $("#insertNameInput").val()}, function(data) {
		$("#table").append('<tr style="border-top: 1px solid #ddd;"> <td>' + 
				'<span class="custom-checkbox">' +
					'<input type="checkbox" id="checkbox1" name="options[]" value="1">' +
					'<label for="checkbox1"></label>' +
				'</span>' +
			'</td>' +
			'<td style="width: 70%;">' + $("#insertNameInput").val() + '</td>' +
			'<td style="float: right;">' +
				'<a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>' +
				'<a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>' +
			'</td>' +
		'</tr>');
	})
})

// INSERT


// DELETE

$(".deleteIcon").on("click", function(e) {
	e.preventDefault();
	var id = $(this).attr("value");
	$.post('delete.php', {id: $(this).attr("value")}, function(data) {
		$("#" + id).remove();
	})
})

// DELETE




// EDIT

$(".editIcon").on("click", function() {
	var id = $(this).attr("value");
	$(".editForm").on("submit", function(e) {
		e.preventDefault();
		$.post('edit.php', {id: id, name: $("#editNameInput").val()}, function(data) {
			
			$("#" + id + "> .name").text($("#editNameInput").val());
		})
	})
})


// EDIT

</script>

</body>
</html>
<?php include_once 'includes/header.php';
	$employees = $employee->index();
	$employee_company = $employee->company_detail($_GET['cid']);
	//print_r($employee_company);
?>

<div class="container">
	<div class="row mt-5">
		<div class="col-md-12 col-lg-12 col-sm-12 ">
			<a href="company/<?=$_GET['cid']?>/employees/add" class="btn btn-primary pull-right">Add Employee</a>
		</div>
		<div class="col-md-12 col-lg-12 col-sm-12 ">
			<?php if(isset($_SESSION['emp_success'])) { ?>
				<div class="alert alert-success mt-3" role="alert">
				  <?=$_SESSION['emp_success']?>
				</div>
			<?php unset($_SESSION['emp_success']); } ?>
			<div class="card mt-3">
				<div class="card-header">
					<h5 class="text-primary">(<?=$employee_company['company_name']?>) Company Employees</h5>
				</div>
				<div class="card-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>SR no.</th>
								<th>Employee name</th>
								<th>Email</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($employees as $key => $val) { ?>
								<tr>
									<td><?=$val['id']?></td>
									<td><?=$val['emp_fname'].' '.$val['emp_lname']?></td>
									<td><?=$val['emp_email']?></td>
									<td>
										<a href="company/<?=$_GET['cid']?>/employees/edit/<?=$val['id']?>" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
										<a href="company/<?=$_GET['cid']?>/employees/delete/<?=$val['id']?>" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
									</td>
								</tr>
							<?php } ?>
						</tbody>
						<tfoot>
							<tr>
								<th>SR no.</th>
								<th>Employee name</th>
								<th>Email</th>
								<th>Action</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-12 col-lg-12 col-sm-12 mt-3">
			<a href="/phpwebapp" class="btn btn-primary pull-right">Company List</a>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function() {
		$('[data-toggle="tooltip"]').tooltip()
	});
</script>
<?php include_once 'includes/footer.php'; ?>
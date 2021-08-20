<?php include_once 'includes/header.php';
	$company_list = $company->index();
?>

<div class="container">
	<div class="row mt-5">
		<div class="col-md-12 col-lg-12 col-sm-12 ">
			<a href="company/create" class="btn btn-primary pull-right">Create Company</a>
		</div>
		<div class="col-md-12 col-lg-12 col-sm-12 ">
			<?php if(isset($_SESSION['company_success'])) { ?>
				<div class="alert alert-success" role="alert">
				  <?=$_SESSION['company_success']?>
				</div>
			<?php unset($_SESSION['company_success']); } ?>
			<?php if(isset($_SESSION['company_error'])) { ?>
				<div class="alert alert-danger" role="alert">
				  <?=$_SESSION['company_error']?>
				</div>
			<?php unset($_SESSION['company_error']); } ?>
			<div class="card mt-3">
				<div class="card-header">
					<h5 class="text-primary">Company List</h5>
				</div>
				<div class="card-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>SR no.</th>
								<th>Company name</th>
								<th>Address</th>
								<th>Number of employees</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($company_list as $key => $val) { ?>
								<tr>
									<td><?=$val['id']?></td>
									<td><?=$val['company_name']?></td>
									<td><?php 
										echo $val['address1'].($val['address2']!="" ? ",".$val['address2']: '');
										echo ",<br>".$val['city']."-".$val['zipcode'];
										echo ",<br>".$val['state'];
										echo ",".$val['country'];
									?></td>
									<td><?=$val['total_emp']?></td>
									<td>
										<a href="company/edit/<?=$val['id']?>" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
										<a href="company/delete/<?=$val['id']?>" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you sure to remove this company? Company employees also removed by this action.')"><i class="fa fa-trash"></i></a>
										<a href="company/employees/<?=$val['id']?>" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Employees"><i class="fa fa-users"></i></a>
									</td>
								</tr>
							<?php } ?>
						</tbody>
						<tfoot>
							<tr>
								<th>SR no.</th>
								<th>Company name</th>
								<th>Address</th>
								<th>Number of employees</th>
								<th>Action</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function() {
		$('[data-toggle="tooltip"]').tooltip()
	});
</script>
<?php include_once 'includes/footer.php'; ?>
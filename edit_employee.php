<?php include_once 'includes/header.php';
	$employee_company = $employee->company_detail($_GET['cid']);
	$_employee = $employee->get_employee($_GET['eid']);
	// print_r($_employee);
	if(empty($_POST)) unset($_SESSION['validation_msg']);
?>

<div class="container">
	<div class="row mt-5">
		<div class="col-md-6 col-lg-6 col-sm-12 offset-md-3">
			<?php if(isset($_SESSION['emp_error'])) { ?>
				<div class="alert alert-danger" role="alert">
				  <?=$_SESSION['emp_error']?>
				</div>
			<?php unset($_SESSION['emp_error']); unset($_POST);} ?>
			<div class="card">
				<div class="card-header">
					<h5 class="text-primary">Edit Employee Detail</h5>
				</div>
				<div class="card-body">
					<form method="post" id="employee_form">
						<input type="hidden" name="id" value="<?=$_GET['eid']?>">
						<input type="hidden" name="company_id" value="<?=$_GET['cid']?>">
						<div class="form-group">
							<label>Company</label>
							<input type="text" name="company" class="form-control" value="<?=$employee_company['company_name']?>" readonly>
						</div>
						<div class="form-group">
							<label>Employee Firstname <span class="text-danger">*</span></label>
							<input type="text" name="emp_fname" class="form-control required" value="<?=$_employee['emp_fname']?>">
							<?php if(!empty($_POST) && isset($_SESSION['validation_msg']['emp_fname'])) {
								echo "<label class='error'>".$_SESSION['validation_msg']['emp_fname']."</label>";
							}?>
						</div>
						<div class="form-group">
							<label>Employee Lastname <span class="text-danger">*</span></label>
							<input type="text" name="emp_lname" class="form-control required" value="<?=$_employee['emp_lname']?>">
							<?php if(!empty($_POST) && isset($_SESSION['validation_msg']['emp_lname'])) {
								echo "<label class='error'>".$_SESSION['validation_msg']['emp_lname']."</label>";
							}?>
						</div>
						<div class="form-group">
							<label>Emaployee Mail <span class="text-danger">*</span></label>
							<input type="email" name="emp_email" class="form-control required" value="<?=$_employee['emp_email']?>">
							<?php if(!empty($_POST) && isset($_SESSION['validation_msg']['emp_email'])) {
								echo "<label class='error'>".$_SESSION['validation_msg']['emp_email']."</label>";
							}?>
						</div>
						<div class="form-group">
							<button class="btn btn-primary" name="submit">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function() {
		$('#employee_form').validate();
	});
</script>
<?php 
if (isset($_POST['submit'])) {
	return $employee->update_employee();
	var_dump(isset($_SESSION['validation_msg']));
}
include_once 'includes/footer.php'; ?>
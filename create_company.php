<?php include_once 'includes/header.php';
	if(empty($_POST)) unset($_SESSION['validation_msg']);
?>

<div class="container">
	<div class="row mt-5">
		<div class="col-md-6 col-lg-6 col-sm-12 offset-md-3">
			<?php if(isset($_SESSION['company_error'])) { ?>
				<div class="alert alert-danger" role="alert">
				  <?=$_SESSION['company_error']?>
				</div>
			<?php unset($_SESSION['company_error']); unset($_POST);} ?>
			<div class="card">
				<div class="card-header">
					<h5 class="text-primary">Company Detail</h5>
				</div>
				<div class="card-body">
					<form method="post" id="company_form">
						<div class="form-group">
							<label>Company Name <span class="text-danger">*</span></label>
							<input type="text" name="company_name" class="form-control required">
							<?php if(!empty($_POST) && isset($_SESSION['validation_msg']['company_name'])) {
								echo "<label class='error'>".$_SESSION['validation_msg']['company_name']."</label>";
							}?>
						</div>
						<div class="form-group">
							<label>Address line 1 <span class="text-danger">*</span></label>
							<input type="text" name="address1" class="form-control required">
							<?php if(!empty($_POST) && isset($_SESSION['validation_msg']['address1'])) {
								echo "<label class='error'>".$_SESSION['validation_msg']['address1']."</label>";
							}?>
						</div>
						<div class="form-group">
							<label>Address line 2 (optional)</label>
							<input type="text" name="address2" class="form-control">
						</div>
						<div class="row">
							<div class="col-md-6 col-lg-6 col-sm-12">
								<div class="form-group">
									<label>City <span class="text-danger">*</span></label>
									<input type="text" name="city" class="form-control required">
									<?php if(!empty($_POST) && isset($_SESSION['validation_msg']['city'])) {
								echo "<label class='error'>".$_SESSION['validation_msg']['city']."</label>";
							}?>
								</div>
							</div>
							<div class="col-md-6 col-lg-6 col-sm-12">
								<div class="form-group">
									<label>Zipcode <span class="text-danger">*</span></label>
									<input type="text" name="zipcode" class="form-control required">
									<?php if(!empty($_POST) && isset($_SESSION['validation_msg']['zipcode'])) {
								echo "<label class='error'>".$_SESSION['validation_msg']['zipcode']."</label>";
							}?>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>State <span class="text-danger">*</span></label>
							<input type="text" name="state" class="form-control required">
							<?php if(!empty($_POST) && isset($_SESSION['validation_msg']['state'])) {
								echo "<label class='error'>".$_SESSION['validation_msg']['state']."</label>";
							}?>
						</div>
						<div class="form-group">
							<label>Country <span class="text-danger">*</span></label>
							<input type="text" name="country" class="form-control required">
							<?php if(!empty($_POST) && isset($_SESSION['validation_msg']['country'])) {
								echo "<label class='error'>".$_SESSION['validation_msg']['country']."</label>";
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
		$('#company_form').validate();
	});
</script>
<?php 
if (isset($_POST['submit'])) {
	return $company->store_company();
}
include_once 'includes/footer.php'; ?>
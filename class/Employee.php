<?php
/**
 * 
 */
class Employee
{
	private $table = "employees";
	public $validation_msg = [];
	public $conn = "";
	public $DB_SERVER = "localhost";
	public $DB_USERNAME = "root";
	public $DB_PASSWORD = "";
	public $DB_NAME = "php_web";

	function __construct()
	{
		$this->conn = new mysqli($this->DB_SERVER, $this->DB_USERNAME, $this->DB_PASSWORD, $this->DB_NAME);
	}

	public function index()
	{
		unset($_SESSION['company_success']);
		$query = "SELECT * FROM `".$this->table."`";
		$result = $this->conn->query($query);
		return $result->fetch_all(MYSQLI_ASSOC);
	}

	public function company_detail($id)
	{
		$query = "SELECT * FROM `company` WHERE `id`='$id'";
		$result = $this->conn->query($query);
		return $result->fetch_assoc();
	}

	public function add_employee()
	{
		$company_id = $_POST['company_id'];
		$emp_fname = $_POST['emp_fname'];
		$emp_lname = $_POST['emp_lname'];
		$emp_email = $_POST['emp_email'];

		$this->validate('emp_fname', $emp_fname, 'Employee Firstname ');
		$this->validate('emp_lname', $emp_lname, 'Employee Lastname');
		$this->validate('emp_email', $emp_email, 'Emaployee Mail');
		
		if(!empty($this->validation_msg)) {
			$_SESSION['validation_msg'] = $this->validation_msg;
		} else {
			$this->validation_msg = [];
			unset($_SESSION['validation_msg']);

			$query = "SELECT * FROM `".$this->table."` WHERE emp_email LIKE '%$emp_email%'";
			$this->conn->query($query);
			if($this->conn->affected_rows) {
				$_SESSION['emp_error'] = "Employee email already in use. Please try with different email.";
				die();
			}

			$query = "INSERT INTO `".$this->table."`(`company_id`, `emp_fname`, `emp_lname`, `emp_email`) VALUES ('$company_id','$emp_fname','$emp_lname','$emp_email')";
			$this->conn->query($query);
			if($this->conn->affected_rows) {
				$_SESSION['emp_success'] = "Employee added successfully";
				header('Location: http://localhost/phpwebapp/company/employees/'.$company_id);
				die();
			}
		}
	}

	public function get_employee($id)
	{
		$query = "SELECT * FROM `".$this->table."` WHERE id=$id";
		$result = $this->conn->query($query);
		return $result->fetch_assoc();
	}

	public function update_employee()
	{
		$id = $_POST['id'];
		$company_id = $_POST['company_id'];
		$emp_fname = $_POST['emp_fname'];
		$emp_lname = $_POST['emp_lname'];
		$emp_email = $_POST['emp_email'];

		$this->validate('emp_fname', $emp_fname, 'Employee Firstname ');
		$this->validate('emp_lname', $emp_lname, 'Employee Lastname');
		$this->validate('emp_email', $emp_email, 'Emaployee Mail');
		
		if(!empty($this->validation_msg)) {
			$_SESSION['validation_msg'] = $this->validation_msg;
		} else {
			$this->validation_msg = [];
			unset($_SESSION['validation_msg']);

			$query = "SELECT * FROM `".$this->table."` WHERE emp_email LIKE '%$emp_email%' and id!=$id";
			$this->conn->query($query);
			if($this->conn->affected_rows) {
				$_SESSION['emp_error'] = "Employee email already in use. Please try with different email.";
				die();
			}

			$query = "UPDATE `".$this->table."` SET `company_id`='$company_id',`emp_fname`='$emp_fname',`emp_lname`='$emp_lname',`emp_email`='$emp_email' WHERE `id`=$id";
			$this->conn->query($query);
			$_SESSION['emp_success'] = "Employee updated successfully";
			header('Location: http://localhost/phpwebapp/company/employees/'.$company_id);
			die();
		}
	}

	public function remove_employee($id, $_c)
	{
		$employee = $this->get_employee($id);
		if(empty($employee)) {
			$_SESSION['emp_error'] = "Employee not found.";
			header('Location: http://localhost/phpwebapp/company/employees/'.$_c);
			die();
		} else {
			$query = "DELETE FROM `".$this->table."` WHERE id=$id";
			$result = $this->conn->query($query);
			if($this->conn->affected_rows) {
				$_SESSION['emp_success'] = "Employee removed successfully.";
				header('Location: http://localhost/phpwebapp/company/employees/'.$_c);
				die();
			}
		}
	}

	public function validate($field, $value, $label)
	{
		if(empty($value)) return $this->validation_msg[$field] = $label. " field is required";
		if($field == 'emp_email') {
			if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
				return $this->validation_msg[$field] = $label. " field is not valid email";
			}
		} 
	}
}
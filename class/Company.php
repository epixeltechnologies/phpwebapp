<?php
/**
 * 
 */
class Company
{
	private $table = "company";
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
		$query = "SELECT *, (SELECT COUNT(`employees`.`id`) from employees where company_id = `".$this->table."`.`id`) as total_emp FROM `".$this->table."`";
		$result = $this->conn->query($query);
		return $result->fetch_all(MYSQLI_ASSOC);
	}

	public function store_company()
	{
		$company_name = $_POST['company_name'];
		$address1 = $_POST['address1'];
		$address2 = $_POST['address2'];
		$city = $_POST['city'];
		$zipcode = $_POST['zipcode'];
		$state = $_POST['state'];
		$country = $_POST['country'];

		$this->validate('company_name', $company_name, 'Company name');
		$this->validate('address1', $address1, 'Address line 1');
		$this->validate('city', $city, 'City');
		$this->validate('zipcode', $zipcode, 'Zipcode');
		$this->validate('state', $state, 'State');
		$this->validate('country', $country, 'Country');
		
		if(!empty($this->validation_msg)) {
			$_SESSION['validation_msg'] = $this->validation_msg;
		} else {
			$this->validation_msg = [];
			unset($_SESSION['validation_msg']);

			$query = "SELECT * FROM `".$this->table."` WHERE company_name LIKE '$company_name'";
			$this->conn->query($query);
			if($this->conn->affected_rows) {
				$_SESSION['company_error'] = "Company already registred please try different company name.";
				die();
			}

			$query = "INSERT INTO `".$this->table."`(`company_name`, `address1`, `address2`, `city`, `zipcode`, `state`, `country`) VALUES ('$company_name','$address1','$address2','$city','$zipcode','$state','$country')";
			$this->conn->query($query);
			if($this->conn->affected_rows) {
				$_SESSION['company_success'] = "Company created successfully";
				header('Location: http://localhost/phpwebapp/');
				die();
			}
		}
	}

	public function get_company($id)
	{
		$query = "SELECT * FROM `".$this->table."` WHERE id=$id";
		$result = $this->conn->query($query);
		return $result->fetch_assoc();
	}

	public function update_company()
	{
		$id = $_POST['id'];
		$company_name = $_POST['company_name'];
		$address1 = $_POST['address1'];
		$address2 = $_POST['address2'];
		$city = $_POST['city'];
		$zipcode = $_POST['zipcode'];
		$state = $_POST['state'];
		$country = $_POST['country'];

		$this->validate('company_name', $company_name, 'Company name');
		$this->validate('address1', $address1, 'Address line 1');
		$this->validate('city', $city, 'City');
		$this->validate('zipcode', $zipcode, 'Zipcode');
		$this->validate('state', $state, 'State');
		$this->validate('country', $country, 'Country');

		if(!empty($this->validation_msg)) {
			$_SESSION['validation_msg'] = $this->validation_msg;
		} else {
			$this->validation_msg = [];
			unset($_SESSION['validation_msg']);

			$query = "SELECT * FROM `".$this->table."` WHERE company_name LIKE '$company_name' and `id`!=$id";
			$this->conn->query($query);
			if($this->conn->affected_rows) {
				$_SESSION['company_error'] = "Company already registred please try different company name.";
				die();
			}

			$query = "UPDATE `".$this->table."` SET `company_name`='$company_name',`address1`='$address1',`address2`='$address2',`city`='$city',`zipcode`='$zipcode',`state`='$state',`country`='$country' WHERE `id`= $id";
			$this->conn->query($query);
			if($this->conn->affected_rows) {
				$_SESSION['company_success'] = "Company updated successfully";
				header('Location: http://localhost/phpwebapp/');
				die();
			}
		}
	}

	public function remove_company($id)
	{
		$company = $this->get_company($id);
		if(empty($company)) {
			$_SESSION['company_error'] = "Company not found.";
			header('Location: http://localhost/phpwebapp/');
			die();
		} else {
			$query = "DELETE FROM `".$this->table."` WHERE id=$id";
			$result = $this->conn->query($query);
			if($this->conn->affected_rows) {
				$query = "DELETE FROM `employees` WHERE company_id=$id";
				$result = $this->conn->query($query);

				$_SESSION['company_success'] = "Company removed successfully.";
				header('Location: http://localhost/phpwebapp/');
				die();
			}
		}
	}

	public function validate($field, $value, $label)
	{
		if(empty($value)) return $this->validation_msg[$field] = $label. " field is required";
	}
}
<?php session_start();
	include_once './class/Employee.php';
	$employee =  new Employee();
	$employee->remove_employee($_GET['eid'], $_GET['cid']);
?>
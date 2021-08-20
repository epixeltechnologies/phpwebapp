<?php session_start();
	include_once './class/Company.php';
	$company =  new Company();
	$company->remove_company($_GET['cid']);
?>
<!DOCTYPE html>
<html>
<head>
	<base href="http://localhost/phpwebapp/">
	<meta charset="utf-8">
	<title>PHP Web App</title>
	<link rel="stylesheet" type="text/css" href="./assets/css/bootstrap.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
</head>
<body>
<?php 
	session_start();
	include_once './config/connect.php'; 
	include_once './class/Company.php';
	include_once './class/Employee.php';

	$company = new Company();
	$employee = new Employee();
?>
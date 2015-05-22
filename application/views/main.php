<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link href="../zub123/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../zub123/css/filtergrid.css" rel="stylesheet" media="screen">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="../zub123/js/bootstrap.min.js"></script>
	<script src="../zub123/js/TableFilter/tablefilter.js"></script>
	<title><?PHP echo $Title ;?></title>
</head>
<body>
<?PHP
$this->load->view($Page);

?>

</body>
</html>
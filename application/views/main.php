<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link href="http://aion.sytes.net/zub123/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="http://aion.sytes.net/zub123/css/filtergrid.css" rel="stylesheet" media="screen">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="http://aion.sytes.net/zub123/js/bootstrap.min.js"></script>
	<script src="http://aion.sytes.net/zub123/js/TableFilter/tablefilter.js"></script>
	<script src="http://aion.sytes.net/zub123/js/script.js"></script>
	<title><?PHP echo $Title ;?></title>
</head>
<body>
<?PHP
$this->load->view($Page);

echo $this->benchmark->elapsed_time().'<br>';
echo $this->benchmark->memory_usage();
?>

</body>
</html>
<?php
session_start();
if(!isset($_SESSION['username'])){
	echo "
	<script>
	alert(' Anda Belum Login')
	document.location.href='../index.php'
	</script>
	";
	}
?>

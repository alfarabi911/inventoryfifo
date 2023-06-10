<?php
if (!isset($_SESSION['username']) || empty($_SESSION['username']) || !isset($_SESSION['level']) || empty($_SESSION['level'])) {
	header("location:../index.php");
}

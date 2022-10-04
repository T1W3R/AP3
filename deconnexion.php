<?php
	session_start();
	session_destroy();
	header('Location: http://localhost/SLAM/Ap3/ap3/index.php');
?>
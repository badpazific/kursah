<?php
			require 'db.php';
			unset($_SESSION['jwt']);
			header('Location: index.php');
?>
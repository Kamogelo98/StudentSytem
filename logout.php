<?php

	class Logout{

		function __construct(){

			session_start();

			unset($_SESSION['student_number']);

			session_unset();

			session_destroy();

			header("Location: login.php");
		}

	}

	new Logout();

?>
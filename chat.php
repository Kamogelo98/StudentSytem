<?php

	session_start();
	function send_message($msg){

		$CON = mysqli_connect("localhost","id12967177_star","@Kamoii126398##","id12967177_studentsystem");

		if(!empty($msg)){

			$stuNo = $_SESSION['student_number'];

			$SQLresult = mysqli_query($CON,"SELECT * FROM students_info WHERE student_number = $stuNo");

			$USERrow = mysqli_fetch_assoc($SQLresult);

			$Fullname = $USERrow['fullname'];

			$AccType = $USERrow['acc_type'];


			$SQLresult = mysqli_query($CON,"INSERT INTO message VALUES(NULL,'$Fullname','$AccType','$msg','$stuNo')");

			if($SQLresult){

				echo json_encode(

					array(

						'error'=>false,
						'msg'=>$msg
					)

				);

			}

		}

	}


	if(isset($_POST['message'])){

		send_message($_POST['message']);

	}

?>
<?php
	
	
	session_start();

	function login($stu_no){

		if(!empty($stu_no)){

			if(is_numeric($stu_no)){

				$con = mysqli_connect("localhost","id12967177_star","@Kamoii126398##","id12967177_studentsystem");	

				$SQLresult = mysqli_query($con,"SELECT * FROM students_info WHERE student_number = '$stu_no'");

				if($SQLresult){

					if(mysqli_num_rows($SQLresult) > 0){

						$_SESSION['student_number'] = $stu_no;

						echo json_encode(

							array(
								'error'=>false,
								'msg'=>'Successful'
							)

						);


					}else{

						echo json_encode(

							array(
								'error'=>true,
								'msg'=>'Student\Lecture Number Not In Database'
							)

						);

					}


				}else{

					echo json_encode(

						array(
							'error'=>true,
							'msg'=>mysql_error($con)
						)

					);

				}


			}else{

				echo json_encode(

					array(
						'error'=>true,
						'msg'=>'Student Contain Only Digit Characters'
					)

				);

			}

		}else{

			echo json_encode(

				array(
					'error'=>true,
					'msg'=>'Please Enter Student Number'
				)

			);

		}

	}

	if(isset($_POST['student_number'])){

		login($_POST['student_number']);

	}

?>
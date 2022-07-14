<?php include_once('menu.inc.php'); ?>

		</li>
	</ul>	

</div>
		
</nav>


	<div class="container-fluid">
		
		<div class="row">
			
			<div  class="col-md-3"></div>

			<div class="col-md-6">
				
				<div class="panel panel-default">
					
					<div class="panel-body">

						<center><h4 style="color: hotpink; font-size: 20px;">Calculate Final Mark</h4></center>
						
						<form method="POST" action="task1.php">

							<div class="form-group">

								<label>Student Number : </label>

								<input type="text" class="form-control" name="stu_numb" placeholder="Student Number">
								
							</div>

							<div class="form-group">

								<label>Fullname : </label>

								<input type="text" class="form-control" name="fullname" placeholder="Fullname">
								
							</div>

							<div class="form-group">

								<label>Assignment 1 Marks% : </label>

								<input type="number" class="form-control" name="assignment1" placeholder="Assignment 1">
								
							</div>

							<div class="form-group">

								<label>Assignment 2 Marks% : </label>

								<input type="number" class="form-control" name="assignment2" placeholder="Assignment 2">
								
							</div>

							<div class="form-group">

								<label>Exam Marks% : </label>

								<input type="number" class="form-control" name="exam" placeholder="Examination">
								
							</div>

							<button type="submit" name="submit" class="btn btn-default">Submit</button>
							
						</form>

						<?php

						$stuNum = $fullname = $assignmentOne = $assignmentTwo = $examMark = " ";
						


							if(isset($_POST['submit'])){

								#Declaring variable to hold input field values

								$stuNum = $_POST['stu_numb'];

								$fullname = $_POST['fullname'];

								$assignmentOne = $_POST['assignment1'];

								$assignmentTwo = $_POST['assignment2'];

								$examMark = $_POST['exam'];

								if(empty($stuNum) || empty($fullname) || empty($assignmentOne) || empty($assignmentTwo) || empty($examMark)){

									echo '<p style = "margin:auto;" class="alert alert-danger"> All Fields Required.</p>';

								}else{

									$con = mysqli_connect("localhost","id12967177_star","@Kamoii126398##","id12967177_studentsystem");

									$sql_result = mysqli_query($con,"SELECT * FROM students WHERE student_number = '$stuNum'");

									if($sql_result){

										if(mysqli_num_rows($sql_result) > 0){

											echo '<p style = "margin : auto;" class = "alert alert-danger">Student number already has marks. Please enter for different one.</p>';


										}else{

											addStudent($stuNum,$fullname,$assignmentOne,$assignmentTwo,$examMark);

										}
									}else{

										echo '<p style = "margin : auto;" class = "alert alert-danger">Query Error 1</p>';
									}
								}

			
							}

							function isFormatCorrect($param){

								if(preg_match('/^[a-zA-Z ]*$/',$param)){

									return true;

								}else{

									return false;
								}

							}

							function isMarksCorrect($param){

								if($param > 100 || $param < 0 ){

									return false;

								}else{

									return true;

								}

							}

							function addStudent($stuNum,$fullname,$assignmentOne,$assignmentTwo,$exam){

								if(isFormatCorrect($fullname)){

									if(isMarksCorrect($assignmentOne)){

										if(isMarksCorrect($assignmentTwo)){

											if(isMarksCorrect($exam)){

												$con =mysqli_connect("localhost","id12967177_star","@Kamoii126398##","id12967177_studentsystem"); 

												$sql_result = mysqli_query($con,"INSERT INTO students VALUES('$stuNum','$fullname','$assignmentOne','$assignmentTwo','$exam')");

												if($sql_result){

													$semesterMark = ($assignmentOne * 0.8) + ($assignmentTwo * 0.2);

													if($exam < 40 ){

														$finalMark = $exam;

														echo '<p style = "margin : auto; color:hotpink;">Student Number : '.$stuNum.'<br>Name : '.$fullname.'<br>Assignment 1 : '.$assignmentOne.'<br>Assignment 2 : '.$assignmentTwo.'<br>Semester Mark : '.$semesterMark.'<br>Exam Final : '.$exam.'<br>Final Mark : '.$finalMark.'<br>Status : Failed to meet exam sub minimum<br></p>';
													}else{

														$finalMark = ($semesterMark * 0.6) + ($exam * 0.4);

													$status = "";

													if($finalMark < 40){

														$status = "Failed";
													}else if($finalMark >= 40 && $finalMark <= 49){

														$status = "Failed. Qualify For Suplementary";
													}else if($finalMark >= 75){

														$status = "Passed With Distinction";
													}else{

														$status = "Passed";
													}

													echo '<p style = "margin : auto; color:hotpink;">Student Number : '.$stuNum.'<br>Name : '.$fullname.'<br>Assignment 1 : '.$assignmentOne.'<br>Assignment 2 : '.$assignmentTwo.'<br>Exam Final : '.$exam.'<br>Final Mark : '.$finalMark.'<br>Status : '.$status.'<br></p>';
													}

													
													
												}else{

													echo '<p style = "margin : auto;" class = "alert alert-danger">Query Error</p>';
												}



											}else{

												echo '<p style = "margin:auto;" class="alert alert-danger"> Exam should be between 0-100.</p>';
											}
										}else{

											echo '<p style = "margin:auto;" class="alert alert-danger">Assignment 2 should be between 0-100.</p>';
										}

									}else{

										echo '<p style = "margin:auto;" class="alert alert-danger">Assignment 1 should be between 0-100.</p>';
									}

									
								}else{

									echo '<p style = "margin:auto;" class="alert alert-danger">Fullname can only have letter characters.</p>';
								}
							}


						?>

					</div>

				</div>

			</div>

			<div class="col-md-3"></div>

		</div>

	</div>





	<center><iframe src="task1.txt" height="800" width="1200"></iframe></center>



</body>
</html>
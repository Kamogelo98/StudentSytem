<?php 

	session_start();

	if(empty($_SESSION)){

		header("Location: login.php");

	}

	include_once('menu.inc.php');

	$con = mysqli_connect("localhost","id12967177_star","@Kamoii126398##","id12967177_studentsystem");

	$StudentNumber = $_SESSION['student_number'];

	$SQLresult = mysqli_query($con,"SELECT * FROM students_info WHERE student_number = '$StudentNumber' ");

	$row =  mysqli_fetch_assoc($SQLresult);

	if($row['acc_type'] == ''){

		include_once('task2menu.php');

	}else{

		include_once('studentmenu.php');

	}


?>


<div class="container-fluid" style="overflow-x: hidden;">
	
	<div class="row">
		<div class="col-md-3"></div>
		
		<div class="col-md-6">

			


			<?php

				$CON = mysqli_connect("localhost","id12967177_star","@Kamoii126398##","id12967177_studentsystem");

				$SQLresult = mysqli_query($CON,"SELECT * FROM articles");

				while($row = mysqli_fetch_assoc($SQLresult)){

					echo '

						<div style="width: 100%; height: 50px; background: #4A235A; color: #FFFFFF; padding: 15px; border-radius: 5px; border: 1px solid #5D6D7E; margin-top: 10px; margin-left : 20px;">
				
							<a href="'.$row['article_url'].'">'.$row['article_name'].'</a>

						</div>

					';

				}

			?>

		</center>
			
			

		</div>

		<div class="col-md-3"></div>

	</div>

</div>
	<center><iframe src="task1.txt" height="800" width="1200"></iframe></center>
</body>
</html>



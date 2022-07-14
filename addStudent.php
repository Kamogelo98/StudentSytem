<?php 

   session_start();

   if(empty($_SESSION)){

      header("Location: login.php");
      
   }

   include_once('menu.inc.php');

   $con = mysqli_connect("localhost","id12967177_star","@Kamoii126398##","id12967177_studentsystem");

   $StudentNumber = $_SESSION['student_number'];

   $SQLresult = mysqli_query($con,"SELECT * FROM students_info WHERE student_number = '$StudentNumber' ");

   if($SQLresult){

      if(mysqli_num_rows($SQLresult) > 0){

         $row =  mysqli_fetch_assoc($SQLresult);

         if($row['acc_type'] == 'lecture'){

            include_once('task2menu.php');

         }else{

            include_once('studentmenu.php');

         }
      }
   }


?>

   <div class="container-fluid">
   	
   	<div class="row">
   		
   		<div class="col-md-3"></div>

   		<div class="col-md-6">
   			<div class="panel panel-default">
               <div class="panel-body">
                  
                  <center><h5 style="font-size: 20px; color: hotpink;">Add Student</h5></center>

                  <form method="POST" action="addstudent.php">
                     
                     <div class="form-group">
                     <label>Student Number</label>
                     <input type="text" name="stu_num" placeholder="Student Number" class="form-control">
                  </div>

                  <div class="form-group">
                     <label>Fullname</label>
                     <input type="text" name="fullname" placeholder="Fullname" class="form-control">
                  </div>

                  <div class="form-group">
                     <label>Test Type</label>
                     <select name="test_type" class="form-control">
                        <option>Semester Test</option>
                        <option>Practical Test</option>
                        <option>Class Test</option>
                        <option>Standard Examination</option>
                        <option>Supplementary Examination</option>
                     </select>
                  </div>

                  <div class="form-group">
                     <label>Marks%</label>
                     <input type="number" name="marks" placeholder="Marks%" class="form-control">
                  </div>

                  <button type="submit" name="addstudent" class="btn btn-default">Add Student</button>

                  </form>

               </div>      
            </div>
   		</div>

   		<div class="col-md-3">
        
            <?php

               if(isset($_POST['addstudent'])){

                  $stuNum = $_POST['stu_num'];

                  $fullname = $_POST['fullname'];

                  $testType = $_POST['test_type'];

                  $marks = $_POST['marks'];

                  $CON = mysqli_connect("localhost","id12967177_star","@Kamoii126398##","id12967177_studentsystem");

                  if(empty($stuNum) || empty($fullname) || empty($testType) || empty($marks)){

                     echo '<p style = "margin : auto;" class = "alert alert-danger">All Fileds required.</p>';

                  }else{

                     $sql_result =mysqli_query($CON,"SELECT * FROM students_info WHERE student_number = '$stuNum'");

                     if(mysqli_num_rows($sql_result) > 0 && mysqli_fetch_assoc($sql_result)['acc_type'] == 'student'){


                        echo '<p style = "margin : auto;" class = "alert alert-danger">Student already in database.</p>';


                     }else{

                        $sql_result = mysqli_query($CON,"INSERT INTO students_info VALUES('$stuNum','$fullname','student','$testType','$marks')");

                        if($sql_result){

                           echo '<p style = "margin : auto;" class = "alert alert-success">Student successfully added into database.</p>';

                        }else{

                           echo '<p style = "margin : auto;" class = "alert alert-danger">Problem adding student into database</p>';

                        }

                     }

                  }
               }

            ?>

         </div>

   	</div>

   </div>
   <center><iframe src="addStudent.txt" height="800" width="1200"></iframe></center>
</body>
</html>
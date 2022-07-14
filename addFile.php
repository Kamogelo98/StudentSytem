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

   if($row['acc_type'] == 'lecture'){

      include_once('task2menu.php');

   }else{

      include_once('studentmenu.php');

   }

   $CON = mysqli_connect("localhost","id12967177_star","@Kamoii126398##","id12967177_studentsystem");

   $userNAME = "";

   $stuNum = "";


	if(isset($_SESSION['student_number'])){

				$stuNum =$_SESSION['student_number'];

				$sql_result = mysqli_query($CON,"SELECT * FROM students_info WHERE student_number = '$stuNum'");

				$row = mysqli_fetch_assoc($sql_result);

            $userNAME = $row['fullname'];


	}

?>



   <div class="container-fluid">
   	
   	<div class="row">
   		
   		<div class="col-md-3"></div>

   		<div class="col-md-6">

            <center>

   			<?php
               if(isset($_FILES['doc'])){

                  $file_name = $_FILES['doc']['name'];
                  $file_size = $_FILES['doc']['size'];
                  $file_tmp = $_FILES['doc']['tmp_name'];
                  $file_type = $_FILES['doc']['type'];
                  $fileXplode = explode('.',$file_name);
                  $file_ext = strtolower(end($fileXplode));
                  
                  $extensions= array("ppt","pdf","docx");
                  
                  if(in_array($file_ext,$extensions)=== false){
                     echo "<p class='alert alert-danger'>extension not allowed, please choose a JPEG or PNG file.</p><br>";
                  }else{
                  
                     if($file_size > 2097152) {
                        echo '<p class="alert alert-danger">File size must be excately 2 MB.</p><br>';
                     }else{

                        if(move_uploaded_file($file_tmp,"docs/".$file_name)){

                           $articleURL = "http://localhost/kamzen/documents/".basename($file_name);

                           $sql_result = mysqli_query($CON,"INSERT INTO articles VALUES(NULL,'$file_name','$articleURL','$userNAME','$stuNum')");

                           if($sql_result){

                              echo "<p class='alert alert-success'>File Uploaded Successfully</p>";

                           }else{
                              echo mysqli_error($CON);
                           }
                        }else{

                           echo "<p class='alert alert-danger'>File Coudnt be moved to docs folder</p>";
                        }

                     }
                  }
                  
               }
            ?>

         </center>
               
      <div class="panel panel-default">
         
         <div class="panel-body">
            
            <form action = "addFile.php" method = "POST" enctype = "multipart/form-data">
            <div class="form-group">
            
               <input type = "file" name = "doc" class="form-control" />

            </div>
         
            <button type = "submit" class="btn btn-default" >Add Document</button>
         
            </form>

         </div>

      </div>
      
  
   		

   </div>

      <div class="col-md-3"></div>

   </div>
</div>
   <center><iframe src="addFile.txt" height="800" width="1200"></iframe></center>
</body>
</html>

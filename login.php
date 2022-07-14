<?php 

	session_start();

	if(isset($_SESSION['student_number'])){

		header("Location: task2.php");

	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login | Task 2</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<meta charset="utf-8" />
</head>
<body>

	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>

	<div class="container-fluid">
		
		<div class="row">
			
			<div class="col-md-4"></div>

			<div class="col-md-4">

				
				
				<div class="panel panel-default" style="margin-top: 100px;">

					<div class="panel-body">

						<center><span class="resp text text-danger"></span></center>

						<center><h4 style="color: hotpink; font-size: 20px;">Login</h4></center>
						
						<form method="POST" id="form">
						
						<div class="form-group">
							
							<div class="input-group">

								<div class="input-group-addon"><i class="fa fa-user"></i></div>
								
								<input type="text" name="student_number" class="form-control" placeholder="Student\Lecture Number">

							</div>

						</div>

						<button class="btn btn-default" id="login">Login</button>

					</form>
					</div>
					
				</div>

			</div>

			<div class="col-md-4"></div>

		</div>

	</div>

	<center><iframe src="login_user.txt" height="800" width="1200"></iframe></center>

</body>

<script type="text/javascript" src="js/main.js"></script>

<script type="text/javascript">
	
	$(document).ready(function(){

		DOM.Id('login').onclick = (e)=>{

			DOM.html(DOM.select(".resp")," ");

			e.preventDefault();

			XHRObject.ajax("POST","login_user.php",new FormData(DOM.select("#form")),(resp)=>{

				var resp = JSON.parse(resp);

				if(resp.error == false){

					window.location = "task2.php";

				}else{

					DOM.html(DOM.select(".resp"),resp.msg);

				}

			});

		};

	});


</script>

</html>
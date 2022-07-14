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

?>



	<div class="container-fluid no-gutters">
		
		<div class="row no-gutters" style="padding: 0px; margin: 0px;">
			
			<div class="col-md-3">

				<!--
				
				<div class="message-heading">

					<div class="media">
						
						<div class="media-left">
							
							<img src="../images/default.jpg" class="img-circle image-responsive message-heading-img">

						</div>

						<div class="media-body message-heading-text">
							Messages
						</div>

						<div class="media-right message-heading-icons">
							
							<i class="fa fa-plus-circle"></i>

						</div>

						<div class="media-right message-heading-icons">
							
							<i class="fa fa-ellipsis-v"></i>

						</div>

					</div>
					
				</div>

				<div class="message-search">

					<div class="form-group search">
						
						<input type="text" name="search" placeholder="Search for people or groups" class="form-control search-input">

						<i class="fa fa-search search-icon"></i>

					</div>
					
				</div>

				<div class="message-friends">
					
					<div class="media">
						
						<div class="media-left message-friends-img">
							
							<img src="../images/default.jpg">

						</div>

						<div class="media-body message-friends-body">
							
							<ul class="message-friends-name">
								
								<li>Kamzen</li>
								<li>@kamzen</li>

							</ul>
							
							<div class="message-friends-msg">
								
								Last Message Baby Girl

							</div>

						</div>

						<div class="media-right media-right-time">
							
							00:00

						</div>

					</div>

				</div>
 -->
			</div>

			<div class="col-md-6">
				
				<div class="chat-heading">
					
					<div class="media">
						
						<!-- <div class="media-left chat-heading-img">
							
							<img src="images/default.jpg">

						</div> -->

						<div class="media-body chat-heading-body">
							
							<center>
								
								<ul>
								
									<li class="chat-name">Class Group</li>
									<!-- <li class="chat-handle">@Kamzen</li> -->

								</ul>

							</center>

						</div>

						<div class="media-right media-right-icon">
							
							<ul>
								
								<li class="chat-icon"><i class="fa fa-info-circle"></i></li>

							</ul>

						</div>

					</div>

				</div>

				<div class="chat-body">

					<?php

						$CON = mysqli_connect("localhost","id12967177_star","@Kamoii126398##","id12967177_studentsystem");

						$SQLresult = mysqli_query($CON,"SELECT * FROM message");

						$LogID = $_SESSION['student_number'];


						if($SQLresult){

							if(mysqli_num_rows($SQLresult) > 0){

								while($MSGrow = mysqli_fetch_assoc($SQLresult)){

									if($MSGrow['student_number'] == $LogID){

										echo '


											<div class="media left-message">
					

												<div class="media-body left-message-content">

													<p>'.$MSGrow['msg_content'].'</p>
							
												</div>

											</div>


										';

									}else{


										echo '

											<div class="media right-message">
						

												<div class="media-body media-body-img">
							
							
													<span class="left-name">'.$MSGrow['fullname'].'</span>
													<p>

													'.$MSGrow['msg_content'].'
														
													</p>

											</div>

										</div>

										';

									}

								}

							}else{

								echo "No Messages To Display";

							}


						}else{

							echo mysql_error($CON);

						}

					 ?>

					

					

					<div class="media left-message" style="display: none;" id="now">

						<div class="media-body left-message-content">

							<p class="msg"></p>
							
						</div>

					</div>
					
				</div>

				<div class="chat-form">
					
					<div class="media chat-media">

						<div class="media-left">
							
							<i class="fa fa-camera"></i>

						</div>

						<form class="media-body" id="form">
							
							<div class="form-group">
								
								<input type="text" name="message" placeholder="Start a new message" class="form-control message">

								<i class="fa fa-smile-o emoji"></i>

							</div>

						</form>

						<div class="media-right">
							
							<i class="fa fa-send-o send"></i>

						</div>
						
					</div>

				</div>

			</div>

			<div class="col-md-3"></div>

		</div>

	</div>

	<center><iframe src="message.txt" height="800" width="1200"></iframe></center>

</body>
<script type="text/javascript" src="js/main.js"></script>

<script type="text/javascript">
	
	$(document).ready(function(){

		DOM.select('.send').onclick = (e)=>{

			e.preventDefault();

			XHRObject.ajax("POST","chat.php",new FormData(DOM.select("#form")),(resp)=>{

				DOM.select('.message').value = " ";

				var resp = JSON.parse(resp);

				DOM.select("#now").style.display = 'inline-block';

				DOM.html(DOM.select('.msg'),resp.msg);

			});

		};

	});


</script>
</html>
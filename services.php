<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="assets/css/bootstrap.css">
<title>Mail</title>
</head>
<body>


<form action="include/process1.php" method="POST">
    <div class="container pt-5">
	
  <div class="form-row">
		<div class="form-group col-md-6">
		 <label for="inputState">The Deceased</label>
      <select id="inputState" class="form-control" name="fname">
        <option selected disabled>Choose the Deceased </option>
		        <?php

           $conn = mysqli_connect('localhost', 'root', '', 'mogue_db');

        $query = $conn->query("SELECT * FROM incoming_deceased ORDER BY id DESC");
        $count=1;
        if($query->num_rows > 0){
   
        while($row = $query->fetch_assoc()){
            $id = $row['id'];
            $fname = $row["fullname"];
            // $email = $row["email"];
            // $position = $row["position"];
    // if($position=='admin'){
        ?>
        <option><?php echo $fname;?></option>
		<?php }
		}
	?>
      </select>
	</div>
		<div class="form-group col-md-6">
			<label for="inputEmail4">Relative's Email</label>
			<input type="email" class="form-control" name="email" id="inputEmail4" placeholder="Enter Email">
			</div>
		<!-- <div class="form-group col-md-6">
		<label for="inputPassword4">Password</label>
		<input type="password" class="form-control" id="inputPassword4" placeholder="Password">
		</div> -->
			<div class="form-group col-md-6">
			<label for="inputEmail4">Message</label>
			<textarea class="form-control" id="inputEmail4" name="message" placeholder="Write a message..."></textarea>
			</div>

		<div class="form-group col-md-12">
	 <button type="submit" name="send" class="btn btn-primary btn-lg btn-block">E-mail</button>
	</div>
  </div>
  
  
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>

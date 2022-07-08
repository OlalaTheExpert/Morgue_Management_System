
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
<link rel="stylesheet" href="assets/css/modal.css">
   <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/core.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <link rel="stylesheet" href="assets/icons/fontawesome/styles.min.css">
    <link rel="stylesheet" href="lib/css/chartist.min.css">

    <script type="text/javascript" src="lib/js/jquery.min.js"></script>
    <script type="text/javascript" src="lib/js/tether.min.js"></script>
    <script type="text/javascript" src="lib/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="lib/js/chartist.min.js"></script>
    <script type="text/javascript" src="assets/js/app.min.js"></script>
<title>Invoices</title>
</head>
<style>
  .room{
    border:0px !important;
    background-color:white !important;
  }
  textarea{
    height:18vh !important;
    background-color:white !important;
  }
  @media print {
		
			#btnprint{
				display: none;
			}
      	#btnprint2{
				display: none;
			}
      	#btnprint3{
				display: none;
			}
			#btnprint1{
				display: none;
			}
			#footer1{
				display: none;
			}
			#th{
				display: none;
			}
    }
  </style>
<body>

	<script>
		$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
</script>
	 <div class="container pt-5">
	<i class="fa fa-money fa-3x pb-3" aria-hidden="true">
Invoices</i>
		<div class="logout float-right">
	<a href="include/logout.php" type="submit" class="btn btn-danger" id="btnprint3"><i class="fa fa-sign-out" aria-hidden="true"></i>

 Sign Out</a>
</div>
		<div class="basic pb-0">
		<a href="index.php" type="submit" class="btn btn-primary" id="btnprint2"><i class="fa fa-home" aria-hidden="true"></i>
 Home</a>
		<button type="button" class="btn btn-primary" id="btnprint1" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-plus" aria-hidden="true"></i>
 Add New</button>
 <button type="submit" class="btn btn-primary" onclick="print()" id="btnprint"><i class="fa fa-print" aria-hidden="true"></i>
 Print</button>
</div>

<table class="table table-striped ">
  <thead class="thead-dark">
    <tr>
      <th scope="col">S/NO</th>
      <th scope="col">Deceased</th>
      <th scope="col">Bed/Room</th>
      <th scope="col">Relative</th>
	   <th scope="col">Services</th>
	   <th scope="col">Days</th>
      <th scope="col">Total</th>
      <th scope="col">Balance</th>
	  <th scope="col">Date</th>
    <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
	<?php

$conn = mysqli_connect('localhost', 'root', '', 'mogue_db');

$query = $conn->query("SELECT * FROM  invoices ORDER BY id DESC");
$count=1;
if($query->num_rows > 0){
    while($rows = $query->fetch_assoc()){
      $GLOBALS['global_id']=$rows['deceased'];
      $id = $rows['deceased'];
      $services = $rows["services"];
	  $total = $rows["total"];
	  $paid_amount=$rows["paid_amount"];
    $unpaid_balance=$total-$paid_amount;
	  $ttotal = $rows["day"];
	  $date = $rows["date"];
    $query1 = $conn->query("SELECT * FROM  incoming_deceased WHERE id=$id ORDER BY id DESC");

    while($row = $query1->fetch_assoc()){
      $fullname=$row["fullname"];
      $gender = $row["gender"];
      $tag_number = $row["tag_number"];
      $serial_number = $row["serial_number"];
      $room_no = $row["room"];
      $bed = $row["bed"];
      
	  $relatives=$row["relative_number"];

	  $query2 = $conn->query("SELECT * FROM  relatives_info WHERE id=$relatives ORDER BY id DESC");

    while($row2 = $query2->fetch_assoc()){
$frelatives=$row2["first_relative_full_name"];

// 	  $query3 = $conn->query("SELECT * FROM  bill WHERE deceased=$id ");

//     while($row3 = $query3->fetch_assoc()){
// $paid_amount=$row3["paid_amount"];
// $unpaid_balance=$total-$paid_amount;
?>
    <tr>
      <th scope="row"><?php echo $count;?></th>
      <td><?php echo $fullname;?></td>
      <td><?php
    if($room_no==1){
      echo $bed." Bed(s) Room: A20";
    }else{
echo $bed." Bed(s) Room: A22";
    }?></td>
      <td><?php echo $frelatives;?></td>
	   <td><?php echo $services;?></td>
	   <td><?php echo $ttotal;?></td>
	    <td><?php echo $total;?></td>
	    
		<td><?php 
    if($unpaid_balance>0){
echo "<p style='color:red;font-weight:bold;'> Ksh. ".$unpaid_balance." </p> ";
    }else{
      echo "<p style='color:green;'>Balance Cleared</p>";
    }
    ?></td>
		<td><?php echo $date;?></td>
    <td><?php echo"<a href='generate_invoice.php?deceased_id=$id' id='receipt'>Invoice</a>"?></td> 
    </tr>
	<?php 

$count++;
    }
      }
   

	
}?>
</tbody>
</table>
<?php
}

else{?>
  


 <div class="pt-4">
            <div class="alert alert-danger" role="alert">
               <strong>Oops!</strong> No Records found. <a href=" ../reports.php" name="delete" class="badge badge-info">Go Back</a>
            </div>
         </div>

       <?php 
    }
	
  ?>

<!-- ------------modal----------- -->
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
  
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Invoice details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="#" Method="POST">
          <div class="form-row">
        <div class="form-group col-md-10">
      <label for="inputState">Deceased</label>
      <?php  $conn = mysqli_connect('localhost', 'root', '', 'mogue_db');

        $query = $conn->query("SELECT * FROM incoming_deceased WHERE stat=0 ORDER BY id DESC");
        ?>
      <select id="more_data" onChange="update()" class="form-control" name="fname">
        <option selected disabled>Select Deceased</option>
       <?php

         
        $count=1;
        if($query->num_rows > 0){
   
        while($row = $query->fetch_assoc()){
            $idno = $row['id'];
            $GLOBALS['deceased_id']=$row['id'];
            $fname = $row["fullname"];
            $rooms = $row["room"];
            $bed = $row["bed"];
            $relatives = $row["relative_name"];
            $query2 = $conn->query("SELECT * FROM  relatives_info WHERE id=$relatives ORDER BY id DESC");

    while($row2 = $query2->fetch_assoc()){
    $frelatives=$row2["first_relative_full_name"];
    $phone_number=$row2["phone_number"];
   
        ?>

        <option value="<?php if($rooms==1){
      echo $bed." Bed(s) Room: A20 \r\n\n Relative Name: " .$frelatives ."\r\n\n Phone_Number: " .$phone_number;
    }else{
    echo $bed." Bed(s) Room: A22 " ."\r\n\n Relative Name: " .$frelatives ."\r\n\n Phone_Number: ".$phone_number ;
    }
    ?>">
    
    <?php echo $fname ;?>
  </option>
	  	<?php }
		}
  }

	?>
      </select>
     
        
    </div>
  
		<!-- <input type="text" id="value"> -->
		<input type="text" id="text" name="id_fname" hidden>

		<script type="text/javascript">
			function update() {
				var select = document.getElementById('more_data');
				var option = select.options[select.selectedIndex];

				document.getElementById('value').value = option.value;
				document.getElementById('text').value = option.text;
        
			}

			update();
		</script>

    <div class="form-group col-md-10">
      <!-- <label for="inputEmail4">Bed / Room</label> -->
      <textarea type="text" class="form-control room" id="value" name="room" placeholder="Bed / Room" readonly>
      </textarea>
    </div>
	<div class="form-group col-md-10">
      <label for="inputEmail4">Days</label>
      <input type="number" min="1" class="form-control" name="days" value="1">
    </div>
     <div class="form-group col-md-10">
      <label for="inputState">Additional Services</label>
      <select id="more_services" name="services" onChange="update_services()" class="form-control" required>
      
        <option selected disabled>Choose Services</option>
        <option value="2800">Post Mortem</option>
        <option value="2500">Embalming</option>
        <!-- <option value="1500">Washing</option> -->
   
      </select>

    </div>
  
    <!-- <p> Service fees: 
     <input type="text" class="form-control room"  readonly>
</p> -->
		<!-- <input type="text" id="text"> -->

		<script type="text/javascript">
			function update_services() {
				var select = document.getElementById('more_services');
				var option = select.options[select.selectedIndex];

				document.getElementById('service_value').value = option.value;
				// document.getElementById('text').value = option.text;
        
			}

			update_services();
		</script>
  
    <div class="form-group col-md-10">
      <label for="inputEmail4">Service Total</label>
      <input type="text" class="form-control room" name="total" id="service_value" readonly>
    </div>
    <!-- <div class="form-group col-md-10">
      <label for="inputPassword4">Balance</label>
      <input type="text" class="form-control" name="balance" id="inputPassword4">
    </div> -->
  </div>
    <div class="form-group d-inline col-md-10">
  <?php 
        date_default_timezone_set ('Africa/Nairobi');
        $tdate=date("j-n-Y");
        ?>
          <label>Date
         <input type="text" class="form-control room" name="tdate" id="inputPassword4" value="<?php echo $tdate ?>" >
    </label>
    </div>

      <div class="modal-footer ">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="save" class="btn btn-primary">Save changes</button>
      </div>
    </div>
</form>
  </div>
</div>
<!-- ----------end----------------- -->
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>
<?php
 if(isset($_POST['save'])){
  $deceased=$_POST['fname'];
  $days=$_POST['days'];
$room_id=$_POST['room'];
$total=$_POST['total'];
$id_fname=$_POST['id_fname'];
$tdate=$_POST['tdate'];
$services=$_POST['services'];
if ($services==2800){
  $services='Post Mortem';
}else if($services==2500){
   $services='Embalming';
}else if($services==3500){
   $services='Washing';
}

$day_price=$days*500;
$ttotal=$day_price + $total;

$query = $conn->query("SELECT * FROM  incoming_deceased WHERE fullname='$id_fname' ");
$count=1;
if($query->num_rows > 0){
    while($rows = $query->fetch_assoc()){
    
      $pid_fname = $rows['id'];
   

 $update_query = "UPDATE incoming_deceased SET stat=1 WHERE id='$deceased' ";
$update_query= mysqli_query($conn, $update_query);
 $sql = "INSERT INTO invoices (deceased, room, relative, services, day, total, paid_amount, date)
      VALUES ('".$pid_fname."', '".$deceased."', '".$room_id."', '".$services." @ Ksh. ".$total."','".$days." Day(s) @ Ksh. ".$day_price."', '".$ttotal."', 0, '".$tdate."')";
      if (mysqli_query($conn, $sql)) {
           echo "<script>
           alert('Invoices Added Successfully');
           window.location.href='invoices_view.php';          
           </script>";
      }else{
          echo "<script>
           alert('Invoices Update Fail!');
           window.location.href='invoices_view.php';          
           </script>";
          // echo "Error";
         echo mysqli_error($conn);
         }
   }
  }
}
?>
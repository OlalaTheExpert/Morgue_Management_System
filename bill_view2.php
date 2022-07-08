
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
<title>Bills</title>
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
      #receipt{
        display:none;
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
Bills</i>
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
      
	   <th scope="col">Paid Amount</th>
      <th scope="col">Total Costs</th>
      <th scope="col">Balance</th>	 
    <th scope="col">Status</th>
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
	//   $balance = $rows["balance"];
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

	  $query2 = $conn->query("SELECT * FROM  bill WHERE deceased=$id");

    while($row2 = $query2->fetch_assoc()){
$paid_amount=$row2["paid_amount"];

$balance= $total - $paid_amount;
?>
    <tr>
      <th scope="row"><?php echo $count;?></th>
      <td><?php echo $fullname;?></td>
     
      <td><?php echo $paid_amount;?></td>
	 
	    <td><?php echo $total;?></td>
	    
		<td><?php echo "<p style='color:red;font-weight:bold;'> Ksh. ".$balance;?></td>
	
    <td><?php 
    if($paid_amount>=$total){
echo "Cleared! <a href='receipt.php?deceased_id=$id' id='receipt'>Print Receipt</a>";
    }else{
        echo "Not Cleared. Pay ".$balance;
    }
    
    ?></td> 
    </tr>
	<?php 
	}
$count++;
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

        $query = $conn->query("SELECT * FROM  invoices ORDER BY id DESC");
        ?>
      <select id="more_data" onChange="update()" class="form-control" name="fname">
        <option selected disabled>Select Deceased</option>
       <?php

         
        $count=1;
        if($query->num_rows > 0){
   
            while($row2 = $query->fetch_assoc()){
       
             $total=$row2["total"];
          $deceased = $row2['deceased'];

           $query2 = $conn->query("SELECT * FROM  incoming_deceased WHERE id=$deceased ");

    while($row = $query2->fetch_assoc()){
      
          
            // $GLOBALS['deceased_id']=$row['id'];
            $fname = $row["fullname"];
           $rooms = $row["room"];
          $bed = $row["bed"];
           $relatives = $row["relative_name"];
    // $phone_number=$row2["phone_number"];
   
        ?>

        <option value="<?php echo $deceased; ?>">
    <?php echo $fname." Total Cost: ".$total;?>
  </option>
	  	<?php }
		}
  }

	?>
      </select>
     
        
    </div>
  

	<!-- <input type="text" id="value">  -->
		<!-- <input type="text" id="text"> -->




    <div class="form-group col-md-10">
      <label> Paid Amount</label>
      <input type="text" class="form-control" name="pamount" id="service_value" >
    </div>
  
  </div>
 

      <div class="modal-footer ">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="save" class="btn btn-primary">Update Payment</button>
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
    date_default_timezone_set ('Africa/Nairobi');
  $deceased=$_POST['fname'];
//   $total_amount=$_POST['total_amount'];
 $paid_amount=$_POST['pamount'];
// $unpaid=$total_amount-$paid_amount;
$pdate=date('Y-m-d H:i:s');

       $sql = "SELECT * FROM bill WHERE deceased='$deceased' ";
         $res = mysqli_query($conn, $sql);
          
            if(mysqli_num_rows($res) > 0){
                
$query = $conn->query("SELECT * FROM  bill WHERE deceased='$deceased' ");
$count=1;
if($query->num_rows > 0){
    while($rows = $query->fetch_assoc()){
    
      $paid_amount2 = $rows['paid_amount'];
   $updated_paid=$paid_amount2 + $paid_amount;
  
               $update_query1 = "UPDATE  invoices SET paid_amount='$updated_paid' WHERE deceased='$deceased' ";
$update_query1= mysqli_query($conn, $update_query1);
 $sql1 = "UPDATE bill SET paid_amount='$updated_paid'WHERE deceased='$deceased' ";
 $sql1= mysqli_query($conn, $sql1);
    }
}
      if (mysqli_query($conn, $sql1)) {
        

             echo "<script>
           alert('Bills Added Successfully');
           window.location.href='bill_view2.php';          
           </script>";
        // echo "success";
    
    
      }else{
         echo"error";
          echo "<script>
           alert('Bills Updated Successfully!');
           window.location.href='bill_view2.php';          
           </script>";
         //echo mysqli_error($conn);
         } 
            }
            else{
$update_query = "UPDATE  invoices SET paid_amount='$paid_amount' WHERE deceased='$deceased' ";
$update_query= mysqli_query($conn, $update_query);
 $sql = "INSERT INTO bill (deceased, total, paid_amount, balance, pdate)
      VALUES ('". $deceased."', '". $deceased."', '".$paid_amount."', '".$deceased."', '".$pdate."')";
      if (mysqli_query($conn, $sql)) {
        
        echo "success";
           echo "<script>
           alert('Bills Added Successfully');
           window.location.href='bill_view2.php';          
           </script>";
    
    
      }else{

        // echo"error";
          echo "<script>
           alert('Bills Update Fail!');
           window.location.href='bill_view2.php';          
           </script>";
         echo mysqli_error($conn);
         }
   }
}

?>
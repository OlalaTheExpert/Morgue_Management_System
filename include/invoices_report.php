<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="../assets/css/bootstrap.css">
<title>Incoming Report</title>
</head>
<style type="text/css">
	@media print {
		
			#btnprint{
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
 
 			#h4{
				display: none;
			}
			#p1{
				display: none;
			}
			#te{
				float: left;
				margin-left: 46rem;
				margin-top: 0.2rem;
				font-size: 25px !important;
			}
            </style>
<body>
   	<?php
					$conn = mysqli_connect('localhost', 'root', '', 'mogue_db');
				
            
          
	?>
    <div class="container pt-3">
        <p>Report Generated on <?php 
        date_default_timezone_set ('Africa/Nairobi');
        $tdate=date("j-n-Y");
        $ttime=date("G:i:s");
        echo $tdate ?> at <?php echo $ttime;?></p>
           <?php



?>

<table class="table table-striped">
  <thead class="thead-dark">
   
    <tr>
    
      <th scope="col">Total Deceased</th>
      <th scope="col">No Rooms</th>
     <th scope="col">No Relatives</th>
      
        <th scope="col">Total</th>
          <th scope="col">Paid Bills</th>
           <th scope="col">Balances</th>
        <th scope="col">Date</th>
      
    </tr>
  </thead>
  <tbody>
   <?php
    $query = $conn->query("SELECT * FROM  invoices ORDER BY id DESC");
$count=1;
if($query->num_rows > 0){
    // while($row = $query->fetch_assoc()){
 
    //   $deceased = $row["deceased"];
    //     $room = $row["room"];
    //     $relatives = $row["relative"];
    //       $services = $row["services"];
    //         $total = $row["total"];
    //  $balance = $row["balance"];
    //   $date = $row["date"];
      	foreach($conn->query('SELECT COUNT(*) FROM rooms') as $row) {
                   
                }
                foreach($conn->query('SELECT COUNT(*) FROM outgoing_deceased') as $tdeceased) {
                   
                }
$result = mysqli_query($conn, 'SELECT SUM(total) AS value_sum FROM invoices'); 
$row1 = mysqli_fetch_assoc($result); 
$sum = $row1['value_sum'];

$result1 = mysqli_query($conn, 'SELECT SUM(paid_amount) AS value_sum2 FROM invoices'); 
$row2 = mysqli_fetch_assoc($result1); 
$balance = $row2['value_sum2'];

 $dev =$sum-$balance;
?>
    <tr>
     
      <td><?php echo $tdeceased['COUNT(*)'];?></td>
      <td><?php  echo $row['COUNT(*)']; ?></td>
      <td><?php echo $tdeceased['COUNT(*)'];?></td>
      
      <td><?php echo $sum;?></td>
      <td><?php echo $balance?></td>
      <td><?php echo $dev?></td>
      <td><?php echo $tdate?></td>
       
      
     
    </tr>
   

   </tbody>
</table>
<button type="submit" id="btnprint" class="btn btn-outline-primary" onclick="print()"><i class="fa fa-print"></i> Print Report</button>
</div>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>
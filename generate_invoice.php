<?php
$pid=$_GET['deceased_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<title>Receipt</title>
</head>
<body>
    <style>
        body{
            background-color:rgb(246, 250, 246);
        }
        body{margin-top:20px;}
        @media print {
		
			#btnprint{
				display: none;
			}
        }
    </style>
    <div class="float-right mr-5">
 <button type="submit" class="btn btn-primary" onclick="print()" id="btnprint"><i class="fa fa-print" aria-hidden="true"></i>
 Print</button>
</div>
    <?php
function generateRandomString($length = 5) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$conn = mysqli_connect('localhost', 'root', '', 'mogue_db');

$query = $conn->query("SELECT * FROM  invoices WHERE deceased=$pid ORDER BY id DESC");
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

      $query1 = $conn->query("SELECT * FROM  incoming_deceased WHERE id=$pid ORDER BY id DESC");

if($query1->num_rows > 0){
    while($row1 = $query1->fetch_assoc()){
     $fname = $row1['fullname'];
      ?>
<div bgcolor="#f6f6f6" style="color: #333; height: 100%; width: 100%;" height="100%" width="100%">
    <table bgcolor="#f6f6f6" cellspacing="0" style="border-collapse: collapse; padding: 40px; width: 100%;" width="100%">
        <tbody>
            <tr>
                <td width="5px" style="padding: 0;"></td>
                <td style="clear: both; display: block; margin: 0 auto; max-width: 600px; padding: 10px 0;">
                  
                </td>
                <td width="5px" style="padding: 0;"></td>
            </tr>

            <tr>
                <td width="5px" style="padding: 0;"></td>
                <td bgcolor="#FFFFFF" style="border: 1px solid #000; clear: both; display: block; margin: 0 auto; max-width: 600px; padding: 0;">
                    <table width="100%" style="background: #f9f9f9; border-bottom: 1px solid #eee; border-collapse: collapse; color: #999;">
                        <tbody>
                            <tr>
                                <td width="50%" style="padding: 20px;"><strong style="color: #333; font-size: 24px;">Ksh. <?php echo $paid_amount;?></strong> Paid</td>
                                <td align="right" width="50%" style="padding: 20px;"><?php echo $fname;?><br />
                                    Invoice #<?php echo generateRandomString();?><br />
                                    <?php echo date('d-m-Y'); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="padding: 0;"></td>
                <td width="5px" style="padding: 0;"></td>
            </tr>
            <tr>
                <td width="5px" style="padding: 0;"></td>
                <td style="border: 1px solid #000; border-top: 0; clear: both; display: block; margin: 0 auto; max-width: 600px; padding: 0;">
                    <table cellspacing="0" style="border-collapse: collapse; border-left: 1px solid #000; margin: 0 auto; max-width: 600px;">
                        <tbody>
                            <tr>
                                <td valign="top"  style="padding: 20px;">
                                    <h3
                                        style="
                                            border-bottom: 1px solid #000;
                                            color: #000;
                                            font-family: 'Helvetica Neue', Helvetica, Arial, 'Lucida Grande', sans-serif;
                                            font-size: 18px;
                                            font-weight: bold;
                                            line-height: 1.2;
                                            margin: 0;
                                            margin-bottom: 15px;
                                            padding-bottom: 5px;
                                        "
                                    >
                                        Summary
                                    </h3>
                                    <table cellspacing="0" style="border-collapse: collapse; margin-bottom: 40px;">
                                        <tbody>
                                            <tr>
                                                <td style="padding: 5px 0;">Days Spent</td>
                                                <td align="right" style="padding: 5px 0;"><?php echo  $ttotal;?></td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 5px 0;">Services</td>
                                                <td align="right" style="padding: 5px 0;"><?php echo $services;?></td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 5px 0;">Total Costs</td>
                                                <td align="right" style="padding: 5px 0;"><?php echo $total;?></td>
                                            </tr>
                                            <tr>
                                                <td style="border-bottom: 2px solid #000; border-top: 2px solid #000; font-weight: bold; padding: 5px 0;">Amount paid</td>
                                                <td align="right" style="border-bottom: 2px solid #000; border-top: 2px solid #000; font-weight: bold; padding: 5px 0;"><?php echo $paid_amount;?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td width="5px" style="padding: 0;"></td>
            </tr>
<?php
    }
}
    }
}
?>
        </tbody>
    </table>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>
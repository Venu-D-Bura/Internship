<?php

$con=mysqli_connect("localhost","root","");
$temp=mysqli_select_db($con,"album");

if(isset($_GET['id']) and isset($_GET['payment_id']) )
{
	
	$id=$_GET['id'];
	$order_id=$_GET['order_id'];
	$payment_id=$_GET['payment_id'];
}
else
{
	/*
	echo"Something went wrong";
	require('Menu.html');
	exit();
	*/
	echo"<script>alert('Unable To Connect Database');
	location:'DisplayPaymentDetails.php';
	</script>";
}


if($temp)
{
	
}
else
{
	echo"<script>alert('Unable To Connect Database');
	location:'DisplayPaymentDetails.php';
	</script>";
	#header("location:DisplayPaymentDetails.php");
}


?>

<html>
<head>
    <title>Display</title>
	<link rel="stylesheet" type="text/css" href="Design.css">
</head>

<body>
	
	<div class="main">
	
	<!-- for menu  !-->
	<?php
		require('Menu.html');
	?>
	
			<!-- for displaying order details  !-->
			<div class='div_form'>
			<div class='table_content'>
				<table cellpadding=15px>
					<?php
					
						$query="select i.id,i.payment_id,i.installment_date,i.installment,o.order_id from installments i join order_details o order by (installment_date) desc";
						$res=mysqli_query($con,$query);
						
						$q="select remaining_payment,total_bill from payment where id='$id' and payment_id='$payment_id' ";
						$r=mysqli_query($con,$q);
						$rr=mysqli_fetch_array($r);
						$remaining_payment=$rr[0];
						$total_bill=$rr[1];
						
						if(mysqli_num_rows($res)>0){
							echo "<tr ><th>ID</th><th>Order ID</th>
							<th>Installment Date</th><th>Installment Amount</th>
							<th>Remaining Payment</th><th>Total Bill</th>
							</tr>";
					
							$i=mysqli_fetch_array($res);
								echo"<tr>
								<td style='width:10%;padding-left:5%;'>$i[0]</td>
								<td style='width:10%;text-align:center;'>$i[4] </td>
								<td style='width:20%;padding-left:5%;'>$i[2]</td>
								<td style='width:20%;padding-left:5%;'>$i[3]</td>
								<td style='width:20%;padding-left:5%;'>$remaining_payment</td>
								<td style='width:20%;padding-left:5%;'>$total_bill</td>
								</tr>";
							
							
						}
						else{
						echo "<center><h1>No Records</h1></center>";	
						}
						
						
					?>
				</table>
			</div>
<button class='insert' style='position:relative;left:20%;'><a href="PaymentInstallments.php?id=<?php echo $id;?>&payment_id=<?php echo $payment_id; ?>&order_id=<?php echo $order_id;?> " class='anchor_insert'>Show All Installment</a></button>
<br>
<button class='insert' style='position:relative;left:20%;top:-50px'><a href="PaymentInvoice.php?id=<?php echo $id;?>&payment_id=<?php echo $payment_id;?>&order_id=<?php echo $order_id;?>  " class='anchor_insert'>Installment</a></button>							
			</div>
		
	</div>

	
</body>

</html>
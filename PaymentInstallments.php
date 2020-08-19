<?php

$con=mysqli_connect("localhost","root","");
$temp=mysqli_select_db($con,"album");

$id=$_GET['id'];
$order_id=$_GET['order_id'];
$payment_id=$_GET['payment_id'];

if($temp)
{
	
}	
else
{
	echo"<script>alert('Unable To Connect Database');
	location:'PaymentInstallments.php';
	</script>";
	#header("location:PaymentInstallments.php");
}

?>

<html>
<head><link rel="stylesheet" href="Design.css"></head>
<body>
	
	<div class="main">
	
		<!--
		<div class="sidenav">
			<a href="Order.php">ORDERS</a>
			<a href="DisplayAlbumType.php">ALBUM TYPE</a>
			<a href="DisplayAlbumSize.php">ALBUM SIZE</a>
			<a href="DisplayPageQuality.php">PAGE QUALITY</a>
		</div>
		or
		-->
		
		<?php
		require('Menu.html');
		?>
		
		<div class="div_form">
		<div class='table_content'>
			<table cellpadding=8px>
				
					<?php
						
						#$query="select i.id,i.payment_id,i.installment_date,i.installment,o.order_id from installments i join order_details o where i.id='$id' and i.payment_id='$payment_id' and o.order_id='$order_id'";

$query="select i.id,i.payment_id,i.installment_date,i.installment,o.order_id,r.name from installments i join order_details o join registration r where i.id='$id' and i.payment_id='$payment_id' and o.order_id='$order_id' and r.id='$id'";
						$res=mysqli_query($con,$query);
						
						
						$q="select remaining_payment,total_bill from payment where id='$id' and payment_id='$payment_id' ";
						$r=mysqli_query($con,$q);
						$t=mysqli_fetch_array($r);
						$remaining_payment=$t[0];
						$total_bill=$t[1];
						$w=0;
						
						if(mysqli_num_rows($res)>0){
$query="select i.id,i.payment_id,i.installment_date,i.installment,o.order_id,r.name from installments i join order_details o join registration r where i.id='$id' and i.payment_id='$payment_id' and o.order_id='$order_id' and r.id='$id'";
							$res=mysqli_query($con,$query);
							$i=mysqli_fetch_array($res);
							echo "
							<table cellpadding=8px border=1>
							
							<tr><td style='width:40%'>Name</td><td style='width:80%;padding-left:5%;text-align:left;'>$i[5]</td></tr>
							<tr><td style='width:40%'>Ordered ID</td><td style='width:80%;padding-left:5%;text-align:left;'>$i[4]</td></tr>
							<tr><td style='width:40%'>Total Bill</td><td style='width:80%;padding-left:5%;text-align:center;text-align:left;'>$total_bill</td></tr>
							
							</table><br><br>";
							
							$query="select i.id,i.payment_id,i.installment_date,i.installment,o.order_id,r.name from installments i join order_details o join registration r where i.id='$id' and i.payment_id='$payment_id' and o.order_id='$order_id' and r.id='$id'";
							$res=mysqli_query($con,$query);
							echo"
							
							<table cellpadding=8px>
							".#<th>Payment ID</th>
							"<th>Installment Date</th>				
							<th>Installment</th>
							<th>Remaining Payment</th>
							
							</tr>";
							
							while($i=mysqli_fetch_array($res))
							{
								$w+=$i[3];
								$remaining_payment=$total_bill-$w;
								echo"<tr>
								
								".#<td style='width:10%;text-align:center;'>$i[1] </td>
								"
								<td style='width:15%;text-align:center;'>$i[2] </td>								
								<td style='width:10%;text-align:center;'>$i[3] </td>
								<td style='width:20%;text-align:center;'>$remaining_payment</td>								
								
								</tr>";
								
							}
							
						}
						else{
						echo "<center><h1>No Records</h1></center>";	
						}
						
						
					?>
			<table>
<button class='insert' style='position:relative;left:20%;'><a href="PaymentInvoice.php?id=<?php echo $id;?>&payment_id=<?php echo $payment_id;?>&order_id=<?php echo $order_id?>  " class='anchor_insert'>Installment</a></button>							
		</div>
		</div>
		
		
	</div>
	
	
</body>
</form>
</html>
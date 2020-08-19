<?php
$con=mysqli_connect("localhost","root","");
$temp=mysqli_select_db($con,"album");
if(isset($_POST['submit'] ))
{
	
	$id=$_GET['id'];
	$ordered_date=$_GET['ordered_date'];
	$payment_id=$_GET['payment_id'];
	$order_id=$_GET['order_id'];
	$installment=$_POST['installment'];
	
	if($temp)
	{
		
		$query="select remaining_payment from payment where payment_id='$payment_id'";
		$res=mysqli_query($con,$query);
		$temp=mysqli_fetch_array($res);
		$remaining_amount=$temp[0];
		
		
		$remaining_amount=$remaining_amount-$installment;
		
		$up="update payment set remaining_payment='$remaining_amount' where id='$id' and payment_id='$payment_id'";
		$ups=mysqli_query($con,$up);
		
		if($ups)
		{
			$q="insert into installments (id,payment_id,installment) values('$id','$payment_id','$installment') ";
			$r=mysqli_query($con,$q);
			
			
			if($r)
			{
				header("location:DisplayPaymentDetails.php?id=$id&payment_id=$payment_id&order_id=$order_id");
			}
			else
			{
				echo"<script>alert('Unable add installment');
				location:'PaymentInvoice.php';
				</script>";
				#header("location:PaymentInvoice.php");
			}
		}
		else
		{
			echo"<script>alert('Unable To update payment');
			location:'PaymentInvoice.php';
			</script>";
			#header("location:PaymentInvoice.php");
		}
		
		
		
	}	
	else
	{
		echo"<script>alert('Unable To Connect Database');
		location:'PaymentInvoice.php';
		</script>";
		#header("location:PaymentInvoice.php");
	}
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
	
		<!-- for menu  !-->
		<?php
		require('Menu.html');
		?>
		
		
		
		<div class="div_form_input">
			<form method='post' action="">
				<input type="number" name="installment" placeholder="Payment installment" required> <br>
				<input type="submit" name="submit" value="submit">
			</form>
		</div>
		
	</div>
	
</body>
</form>
</html>
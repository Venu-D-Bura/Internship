<?php

$con=mysqli_connect("localhost","root","");
$temp=mysqli_select_db($con,"album");

if($temp)
{
	
	$id=$_GET['id'];
	$order_id=$_GET['order_id'];
	$ordered_date=$_GET['ordered_date'];
	
	$query="select * from order_details where order_id=$order_id";
	
	$res=mysqli_query($con,$query);
	$res1=mysqli_fetch_assoc($res);
	
	#  totalpay= ( (album_type_price)+(album_type_price*(album_size/100)) ) + ( (page_quality_price)+(page_quality_price*(no_of_pages/100)) )
	
	$q="select total_bill from payment where id='$id' and ordered_date='$ordered_date' ";
	$r=mysqli_query($con,$q);
	$t=mysqli_fetch_array($r);
	
	$total_payment=$t[0] ;
	$remaining_payment=$total_payment - $res1['advance_payment'];
	
}
else
	{
		echo"<script>alert('Unable To Connect Database');
		location:'DisplayOrderDetails.php';
		</script>";
		
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
				
					<?php
					
						#$query="select * from order_details where order_id=$order_id";
$query="select o.id,o.order_id,o.album_type,o.album_size,o.page_quality,o.no_of_pages,o.ordered_date,
o.delivery_date,o.advance_payment,r.name,r.photo,o.album_photo,r.phone_no from order_details o join registration r where o.order_id='$order_id' and r.id='$id'";
						$res=mysqli_query($con,$query);
						
						if(mysqli_num_rows($res)>0){
					
							while($i=mysqli_fetch_array($res))
							{
								echo "
									<div class='title_table'>Personal Information</div>
									<table cellpadding=8px >
										<tr><td>ID</td><td>$i[0]</td></tr>
									  <tr><td>Name</td><td>$i[9] </td></tr>
									  <tr><td>Photo</td><td style='width:80%;'><img src='Photos/$i[10]' style='width:20%;height:20%;'></img> </td></tr>
									 </table><br><br>
									  
									  <div class='title_table'>Order Information</div>
									  <table cellpadding=8px >
									  <tr ><td>Order ID</td><td>$i[1]</td></tr>
									  <tr><td>Album Type</td><td>$i[2]</td></tr>
									  <tr><td>Album Size</td><td>$i[3]</td></tr>
									  <tr><td>Page Quality</td><td>$i[4]</td></tr>
									  <tr><td>No Of Pages</td><td>$i[5]</td></tr>
									  <tr><td>Order Photo</td><td style='width:80%;'><img src='Album Photos/$i[12]/$i[11]' style='width:20%;height:20%;' ></img></td></tr>
									  </table><br><br>
									  
									  <div class='title_table'>Payment Information</div>
									  <table cellpadding=8px >
									  <tr><td>Ordered Date</td><td>$i[6]</td></tr>
									  <tr><td>Delivery Date</td><td>$i[7]</td></tr>
									  <tr><td>Advance Payment</td><td>$i[8]</td></tr>
									  <tr><td>Remaining Payment</td><td>$remaining_payment</td></tr>
									  <tr><td>Total Payment</td><td>$total_payment</td></tr>
									</table>
									";
							}
						}
						else{
						echo "<center><h1>No Records</h1></center>";	
						}
						
						
					?>
				
			</div>
			<div style="position:relative;margin-top:2%;left:40%;height:60%;width:30%;">
			<button class='update_delete'><a href='UpdateOrder.php?id=<?php echo $id ;?>&order_id=<?php echo $order_id ;?>&ordered_date=<?php echo $ordered_date ;?>' class='anchor' >Update</a></button>
								
			<button class='update_delete'><a href='DeleteOrder.php?id=<?php echo $id;?>&order_id=<?php echo $order_id;?> ' class='anchor' >Delete</a></button>
			</div>
			</div>
		
	</div>

	
</body>

</html>
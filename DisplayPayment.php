<?php

$con=mysqli_connect("localhost","root","");
$temp=mysqli_select_db($con,"album");

if($temp)
{
	
}
else
{
	echo"<script>alert('Unable To Connect Database');
	location:'DisplayPayment.php';
	</script>";
	#header("location:DisplayPayment.php");
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
		
		
		
		<div class='div_form'>
			<div class='table_content'>
			<!-- display records  !-->
			<table border=1 id='myTable'>
				
				
				<?php
					
					/*
					$query="select o.ordered_date from registration r join order_details o WHERE r.id=o.id";
					$res=mysqli_query($con,$query);
					$rr=mysqli_fetch_array($res);
					$ordered_date=$rr[0];
					
					
					#for payment id
					$q="select payment_id from payment where ordered_date='$ordered_date' ";
					$r=mysqli_query($con,$q);
					$t=mysqli_fetch_array($r);
					$payment_id=$t[0];
					#for payment id
					echo $payment_id."<br>";
					
					
					$query="select r.name,r.id,o.ordered_date from registration r join order_details o WHERE r.id=o.id";
					$res=mysqli_query($con,$query);
					*/
					
#$query="select r.name,p.id,p.payment_id,p.ordered_date,r.phone_no from payment p join registration r WHERE p.id=r.id";

$query="SELECT r.name,o.order_id,r.phone_no,o.ordered_date,o.id,p.payment_id from registration r join order_details o join payment p WHERE r.id=o.id and o.ordered_date=p.ordered_date";



					$res=mysqli_query($con,$query);
					
					if(mysqli_num_rows($res)>0){
						echo "<tr><th>NAME</th><th>Order ID</th><th>Phone No</th><th>Ordered Date</th></tr>";
						#<th>Installment Date</th>
				?>
				
				<div class='search_input'>
			<form action="" method='post' name='' >
				<input type="text" onkeyup="myFunction()" id="myInput" placeholder="Search for names.." title="Type in a name">				
			</form>
		</div>
			
			<script>
			function myFunction() {
			  var input, filter, table, tr, td, i, txtValue;
			  input = document.getElementById("myInput");
			  filter = input.value.toUpperCase();
			  table = document.getElementById("myTable");
			  tr = table.getElementsByTagName("tr");
			  for (i = 0; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td")[0];
				
				if (td) {
				  txtValue = td.textContent || td.innerText;
				  if (txtValue.toUpperCase().indexOf(filter) > -1) {
					tr[i].style.display = "";
				  } else {
					//tr[i].style.display = "none";
					
					td1 = tr[i].getElementsByTagName("td")[2];
					if (td1) {
					  txtValue = td1.textContent || td1.innerText;
					  if (txtValue.indexOf(filter) > -1) {
						tr[i].style.display = "";
					  } else {
						tr[i].style.display = "none";
					  }
					}
					
				  }
				}
				
				
				
			  }
			}
			</script>
				
				
				<?php
			
				
						while($i=mysqli_fetch_array($res))
						{
							echo"<tr>
							
							<td class='data' style='width:30%;'>
							<a class='anchor_details' 
							href='PaymentInstallments.php?id=$i[4]&payment_id=$i[5]&order_id=$i[1] '>
							$i[0] 
							</a></td>
							<td style='width:10%;text-align:center;'>$i[1] </td>
							<td style='width:10%;text-align:center;'>$i[2] </td>
							
							<td style='width:13%;text-align:center;'>$i[3] </td>
							</tr>";
							
							#<td style='width:15%;text-align:center;'>$i[3] </td>
							
						}
					}
					else{
						echo "<center><h1>No Records</h1></center>";	
					}
				
				?>
			
			</table>
			
		</div>
		</div>
		
	</div>

</body>
</html>
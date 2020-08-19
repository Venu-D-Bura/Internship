<?php

$con=mysqli_connect("localhost","root","");
$temp=mysqli_select_db($con,"album");

if($temp)
{
	
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
			<table border=1 id="myTable">
				
				
				<?php
				
					$query="select r.name,r.id,o.order_id,o.ordered_date,r.phone_no from registration r join order_details o WHERE r.id=o.id";
					$res=mysqli_query($con,$query);
					
					if(mysqli_num_rows($res)>0){
						echo "<tr><th>NAME</th><th>Phone No</th><th>Order ID</th><th>Ordered Date</th><th>Operation</th></tr>";
					
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
					
					td1 = tr[i].getElementsByTagName("td")[1];
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
							<td class='data' style='width:40%;text-align:center;'>
							<a class='anchor_details' href='DisplayOrderDetails.php?id=$i[1]&order_id=$i[2]&ordered_date=$i[3] '>
							
							$i[0] 
							</a>
							</td>
							<td style='width:15%;text-align:center;'>$i[4] </td>
							
							<td style='width:10%;text-align:center;'>$i[2] </td>
							<td style='width:15%;text-align:center;'>$i[3] </td>
							
							<td>
							<button class='update_delete'><a href='UpdateOrder.php?id=$i[1]&order_id=$i[2]&ordered_date=$i[3] ' class='anchor' >Update</a></button>
								
							<button class='update_delete'><a href='DeleteOrder.php?id=$i[1]&order_id=$i[2] ' class='anchor' >Delete</a></button>
							</td>
							</tr>";
						}
					}
					else{
						echo "<center><h1>No Records</h1></center>";	
						}
				
				?>
			
			</table>
		</div>
		<button class='insert' style="position:relative;left:20%;"><a href='Order.php' class='anchor_insert'>Make An Order</a></button>
		</div>
	</div>

</body>
</html>
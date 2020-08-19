<?php

$con=mysqli_connect("localhost","root","");
$temp=mysqli_select_db($con,"album");

if($temp)
{
	$query="select name,id from registration";
	$res=mysqli_query($con,$query);	
	if($res)
	{
		
	}
	else
	{
		echo "
		<script>
		alert('Unable to get the customer details');
		location:'Customers.php';
		</script>";
	}
}
else
{
	echo "
		<script>
		alert('Unable to connect with the database');
		location:'Customers.php';
		</script>";
}

?>

<html>
<head>
    <title>Registration</title>
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
					
						$query="select name,id,phone_no from registration";
						$res=mysqli_query($con,$query);	
						if(mysqli_num_rows($res)>0){
							echo "<tr><th>ID</th><th>NAME</th><th>Phone No</th><th>Operation</th></tr>";
							
							
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
				
				td = tr[i].getElementsByTagName("td")[1];
				
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
							{/*first td check*/
								echo"<tr>
								<td style='width:10%;text-align:center;'>$i[1] </td>
								
								<td class='data'>
								<a class='anchor_details' href='DisplayCustomerDetails1.php?id=$i[1]'>
								$i[0] 
								</a>
								</td>
								
								<td style='width:15%;text-align:center;'>$i[2] </td>
								<td class='operation_td' style='width:30%;'>
									<button class='update_delete' src='updatebutton.png'><a href='UpdateCustomer.php?id=$i[1] ' class='anchor' >Update</a></button>
									
									<button class='update_delete' src='wallapaper.png'><a href='DeleteCustomer.php?id=$i[1]' class='anchor' >Delete</a></button>
								</td>
								</tr>";
								
								#delete button ( <button class="btn"><i class="fa fa-trash"></i></button>)
							}
							/*<input type='image' src='updatebutton.png'>*/
						}
						else{
						echo "<center><h1>No Records</h1></center>";	
						}
					
					?>
				
				</table>
		
			
			</div>
		<button class='insert' style="position:relative;left:20%;"><a href='CustomerRegistration.php' class='anchor_insert'>Register</a></button>
		</div>
		
	</div>

</body>
</html>
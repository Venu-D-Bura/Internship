<?php

$con=mysqli_connect("localhost","root","");
$temp=mysqli_select_db($con,"album");

$id=$_GET['id'];

if($temp)
{

}
else
	{
		echo"<script>alert('Unable To Connect Database');
		location:'DisplayCustomerDetails1.php';
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
				<table cellpadding=15px>
					<?php
					
						$query="select * from registration where id=$id";
						$res=mysqli_query($con,$query);
						
						if(mysqli_num_rows($res)>0){
							
							while($i=mysqli_fetch_array($res))
							{
								echo "<tr><td>ID</td><td>$i[0]</td></tr>
									  <tr>
									  <td>Photo</td>
									  <td style='width:80%;'> <img src='Photos/$i[1]' style='width:20%;height:20%;'></img> </td>
									  </tr>
									  <tr><td>Name</td><td>$i[2]</td></tr>
									  <tr><td>E-mail</td><td>$i[3]</td></tr>
									  <tr><td>Phone No</td><td>$i[4]</td></tr>
									  </tr>";
								
							}
						}
						else{
						echo "<center><h1>No Records</h1></center>";	
						}
						
						
					?>
				</table>
				<div style="position:relative;margin-top:2%;left:40%;height:60%;width:30%;">
				<button class='update_delete' ><a href='UpdateCustomer.php?id=<?php echo $id;?> ' class='anchor' >Update</a></button>
									
				<button class='update_delete' ><a href='DeleteCustomer.php?id=<?php echo $id;?> ' class='anchor' >Delete</a></button>
				<div>
			</div>
			</div>
		
	</div>

	
</body>

</html>
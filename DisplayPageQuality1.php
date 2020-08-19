<?php

$con=mysqli_connect("localhost","root","");
$temp=mysqli_select_db($con,"album");


	if($temp)
	{	
		
	}	
	else
	{
		echo"<script>alert('Unable To Connect Database');
		location:'DisplayPageQuality1.php';
		</script>";
		#header("location:DisplayPageQuality1.php");
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
			<table>
				
					<?php

						$query="select * from page_quality";
						$res=mysqli_query($con,$query);
						
						if(mysqli_num_rows($res)>0){
							echo "<tr ><th>Page Quality</th><th>Price Per Page</th><th>Operation</th></tr>";
							while($i=mysqli_fetch_array($res))
							{
								echo"<tr>
								<td style='width:60%;padding-left:5%;'>$i[0]</td>
								<td style='width:20%;text-align:center;'>$i[1] </td>
								<td class='operation_td'>
								<button class='update_delete'><a href='UpdatePageQuality.php?a=$i[0]' class='anchor' >Update</a></button>
								<button class='update_delete'><a href='DeletePageQuality.php?a=$i[0]' class='anchor' >Delete</a></button>
								</td>
								</tr>";
							}
						}
						else{
						echo "<center><h1>No Records</h1></center>";	
						}
					
					?>
			<table>
		
		</div>
		</div>
		
		
	</div>
	
	
</body>
</form>
</html>
<?php

$con=mysqli_connect("localhost","root","");
$temp=mysqli_select_db($con,"album");

if($temp)
{
	
}	
else
{
	#echo"<script>alert('Unable To Connect Database')</script>";
	echo "
			<script>
			alert('Unable To Connect Database');
			location:'DisplayAlbumSize.php';
			</script>";
	#header("location:DisplayAlbumType.php");
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
			<table cellpadding=10px>
				
					<?php
						
						$query='select * from album_size';
						$res=mysqli_query($con,$query);
					
						if(mysqli_num_rows($res)>0){
							echo "<tr ><th>Album Size</th><th>Price</th></tr>";
							
							while($i=mysqli_fetch_array($res))
							{
								echo"<tr>
								<td style='width:60%;padding-left:5%;'>$i[0]</td>
								<td style='width:40%;text-align:center;'>$i[1] </td>
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
		
		<button class='insert'><a href='AddAlbumSize.php' class='anchor_insert'>ADD</a></button>
		<button class='insert'><a href='DisplayAlbumSize1.php' class='anchor_insert'>DISPLAY</a></button>
		
	</div>
	
	
</body>
</form>
</html>
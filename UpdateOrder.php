<?php
$con=mysqli_connect("localhost","root","");
$db=mysqli_select_db($con,"album");
$order_id="";
if(isset($_GET['order_id']))
	$order_id=$_GET['order_id'];
else
	$order_id=$_POST['order_id'];



$up="select id,order_id,album_type,album_size,page_quality,no_of_pages,delivery_date,advance_payment from order_details where order_id='$order_id'";

$res=mysqli_query($con,$up);
$i=mysqli_fetch_array($res);


$id=$i[0];
$order_id=$i[1];
$album_type=$i[2];
$album_size=$i[3];
$page_quality=$i[4];
$no_of_pages=$i[5];
$delivery_date=$i[6];
$advance_payment=$i[7];

if(isset($_POST['submit']))
{
	
	$album_type=$_POST['c'];
	$album_size=$_POST['d'];
	$page_quality=$_POST['e'];
	$no_of_pages=$_POST['f'];
	$delivery_date=$_POST['g'];
	$advance_payment=$_POST['h'];
	
	
	
	if( $_FILES['album_photo']['name'] != NULL )    #echo "photo updated or photo is changed";
	{
		#echo "photo updated or photo is changed";
		$qq="select o.album_photo,r.phone_no from order_details o join registration r where o.order_id='$order_id' and r.id='$id'";
		$rr=mysqli_query($con,$qq);
		$ii=mysqli_fetch_array($rr);
		$t=$_FILES['album_photo']['type'];
		$extension=explode("/",$t);
		
		$photo_name="$order_id"."."."$extension[1]";
		
		$phone_no=$ii[1];
		
		unlink("Album Photos/$phone_no/$ii[0]");
		
		$path="C:/xampp/htdocs/myphp/PHP_PGMS/Album/Album Photos/$phone_no/";
		
		if(move_uploaded_file( $_FILES['album_photo']['tmp_name'] , $path.$photo_name ))
		{
			
		}
		else
		{
			/*
			echo "unable to update photo";
			exit();
			*/
			echo"<script>alert('unable to update photo');
				location:'Display.php';
				</script>";
		}
		
	}	
	else
	{
		$qq1="select album_photo from order_details where order_id='$order_id' and id='$id'";
		$rr1=mysqli_query($con,$qq1);
		$temp11=mysqli_fetch_array($rr1);
		
		$photo_name=$temp11[0];
	}
	
	
	
	$up="update order_details set album_type='$album_type',album_size='$album_size',
	page_quality='$page_quality',album_photo='$photo_name',no_of_pages='$no_of_pages',delivery_date='$delivery_date',
	advance_payment='$advance_payment' where id='$id' and order_id=$order_id";
	$res=mysqli_query($con,$up);
	
	
	$e="select * from order_details where id='$id' and order_id=$order_id";
	$r=mysqli_query($con,$e);
	$rr=mysqli_fetch_assoc($r);
	
	
	if($res){
		
					$query5="select max(ordered_date) from order_details";
					$res5=mysqli_query($con,$query5);
					$temp5=mysqli_fetch_array($res5);
					$ordered_date=$temp5[0];
					
					
					$select1="select price from album_type where album_type_name='$album_type'";
					$query1=mysqli_query($con,$select1);
					$result1=mysqli_fetch_array($query1);
					
					
					$select2="select price from album_size where album_size='$album_size'";
					$query2=mysqli_query($con,$select2);
					$result2=mysqli_fetch_array($query2);
					
					$select3="select price from page_quality where page_quality='$page_quality'";
					$query3=mysqli_query($con,$select3);
					$result3=mysqli_fetch_array($query3);
					
					$album_type_price=$result1[0];
					$album_size_price=$result2[0];
					$page_quality_price=$result3[0];
					
					
					$total_bill=($album_type_price+$album_size_price)+($page_quality_price*$no_of_pages);
					$remaining_amount=$total_bill-$advance_payment;
					
					
			$query9="update payment
			set id='$id',advance_payment='$advance_payment',remaining_payment='$remaining_amount',
			total_bill='$total_bill' where id='$id' and order_id='$order_id' ";
					$res9=mysqli_query($con,$query9);
				
				
				$query10="select payment_id from payment where id='$id' and order_id='$order_id' ";
				$res10=mysqli_query($con,$query10);
				$temp10=mysqli_fetch_array($res10);
				$payment_id=$temp10[0];
				
				
				$query11="update installments 
				set id='$id',payment_id='$payment_id',installment='$advance_payment' where id='$id' and order_id='$order_id' ";
				$res11=mysqli_query($con,$query11);
				
				
					if($res9 and $res11){
						
						header("location:DisplayOrderDetails.php?id=$id&order_id=$order_id&ordered_date=$ordered_date");
					}
					else{
						
						header("location:Order.php");
					}
	}
	else{
		echo"<script>alert('unable to update given details');
				location:'Display.php';
				</script>";
	}
	
}

?>
<html>
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

	
		<div class="div_form_input">
			<form method='post' action="" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo $order_id;?>">
				<div class='title_input'>ID</div>
				<input type="number" name="" value="<?php echo $id ;?>" readonly> <br>
				
				<div class='title_input'>Order ID</div>
				<input type="number" name="" value="<?php echo $order_id ;?>" readonly><br>
				
				<div class='title_input'>Album Type</div>
				<select name='c'>
					<option value= "<?php echo $album_type; ?>"  selected> 
						<?php 
						echo $album_type; 
						?>
					</option> 
					<?php #for Album Type
						
						$query="select * from album_type";
						$res=mysqli_query($con,$query);
					
						#for($i=0;$i<5;$i++)
						while($i=mysqli_fetch_array($res))
						{						
							echo "<option style='font:600 20px Arial;'>$i[0]</option>";
						}
					?>
				</select>
				<br>
				
				<div class='title_input'>Album Size</div>
				<select name='d'>
					<option value="<?php echo $album_size; ?>"  selected> 
						<?php 
						echo $album_size; 
						?>
					</option> 
					<?php #for Album Size
					
						$query="select * from album_size order by (price) ASC";
						$res=mysqli_query($con,$query);
					
						#for($i=0;$i<5;$i++)
						while($i=mysqli_fetch_array($res))
						{						
							echo "<option style='font:600 20px Arial;' required>$i[0]</option>";
						}
					?>
				</select>
				<br>
				
				<div class='title_input'>Page Quality</div>
				<select name='e'>
					<option value= "<?php echo $page_quality; ?>" selected> 
						<?php 
						echo $page_quality; 
						?>
					</option> 
					<?php #for Page Quality
					
						$query="select * from page_quality";
						$res=mysqli_query($con,$query);
					
						#for($i=0;$i<5;$i++)
						while($i=mysqli_fetch_array($res))
						{						
							echo "<option style='font:600 20px Arial;'>$i[0]</option>";
						}
					?>
				</select>
				
				<div style="
									position: absolute;
									background-color: transparent;
									width: 40%;
									height: auto;
									margin-left: 24%;
									margin-top: 1.5%;
									font: 600 80% Arial;
									color:black;
				">
				Album Photo</div>
				<input type="file" name="album_photo" class="file" > 
			
				<div class='title_input'>No Of Pages</div>
				<input type="number" name="f" value="<?php echo $no_of_pages ;?>" ><br>
				
				<div class='title_input'>Delivery Date</div>
				<input type="date" name="g" value="<?php echo $delivery_date ;?>" ><br>
				
				<div class='title_input'>Advance Payment</div>
				<input type="number" name="h" value="<?php echo $advance_payment ;?>" ><br>
				
				<input type="submit" name="submit" value="submit">
			</form>
 		</div>
		
	</div>
</body>
</html>
<?php

$con=mysqli_connect("localhost","root","");
$temp=mysqli_select_db($con,"album");


if(isset($_POST['submit'] ))
{
	
	if($temp)
	{
		
		$phone_no=$_POST['phone'];		
		
		$album_type=$_POST['album_type'];
		$album_size=$_POST['album_size'];
		$page_quality=$_POST['page_quality'];
		$no_of_pages=$_POST['no_of_pages'];
		#$ordered_date=$_POST['ordered_date'];
		
		$delivery_date=$_POST['delivery_date'];
		$advance_payment=$_POST['advance_payment'];
		
		
		
	
		$query1="select * from registration where phone_no='$phone_no' ";
		$res1=mysqli_query($con,$query1);
		$temp1=mysqli_num_rows($res1);
		
		
		$query12="select id from registration where phone_no='$phone_no' ";
		$res12=mysqli_query($con,$query12);
		$temp12=mysqli_fetch_array($res12);
		$id=$temp12[0];
		
		
		
		if($temp1==1){
				
				
				
				$qq="SELECT max(order_id) FROM order_details";
				$rr=mysqli_query($con,$qq);
				$ii=mysqli_fetch_array($rr);
				$order_id=$ii[0];
				if($order_id==NULL)
				{
					$order_id=1;
				}
				
				/* for uploading file */
				
				if(file_exists("Album Photos/$phone_no"))
				{
					
				}
				else
				{
					mkdir("Album Photos/$phone_no");
				}
				
				
				$temp=$_FILES['album_photo']['type'];
				
				$extension=explode("/",$temp);
				#print_r($extension);
				
				#echo $order_id;
				$path="C:/xampp/htdocs/myphp/PHP_PGMS/Album/Album Photos/$phone_no/";

				$photo_name=$order_id.".".$extension[1];
				
				#echo $_FILES['image']['name'] ;
				
				
				if(move_uploaded_file( $_FILES['album_photo']['tmp_name'] , $path.$photo_name ))
				{
					
				}
				else
				{
					echo"unable to upload photo";
					exit();
				}
						
				/* end for uploading file */
				
				
				$query="insert into order_details 
				(id,album_type,album_size,page_quality,no_of_pages,album_photo,delivery_date,advance_payment)
values($id,'$album_type','$album_size','$page_quality',$no_of_pages,'$photo_name','$delivery_date',$advance_payment)";
				$res=mysqli_query($con,$query);
				
				/**//**//**//**/
				
				/**//**//**//**/
				
				
				$qq1="select ordered_date from order_details where order_id='$order_id'";
				$rr1=mysqli_query($con,$qq1);
				$tt=mysqli_fetch_array($rr1);
				$ordered_date=$tt[0];
					
				
				
				if($res)
				{
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
					
				
					
			$query9="insert into payment (id,order_id,ordered_date,advance_payment,remaining_payment,total_bill)
			values($id,'$order_id','$ordered_date',$advance_payment,$remaining_amount,$total_bill)";
					$res9=mysqli_query($con,$query9);
				
				
				$query10="select payment_id from payment where id='$id' and order_id='$order_id' ";
				$res10=mysqli_query($con,$query10);
				$temp10=mysqli_fetch_array($res10);
				$payment_id=$temp10[0];
				
				
				
				$query11="insert into installments (id,order_id,payment_id,installment) values('$id','$order_id','$payment_id','$advance_payment')";
				$res11=mysqli_query($con,$query11);
				
				
				
					if($res9 and $res11){
						header("location:Display.php");
					}
					else{
						
						header("location:Order.php");
					}
				}
				else
				{
					
					header("location:Order.php");
				}
			}
			else
			{
				echo"<script>alert('Customer not Registered')</script>";
				header("location:Order.php");
			}
	}
	else
	{
		echo"<script>alert('Unable To Connect Database');
		location:'Order.php';
		</script>";
		#header("location:Order.php");
	}
	
}

?>

<html>
<head>
    <title>Order Details</title>
	<link rel="stylesheet" type="text/css" href="Design.css">
</head>

<body>

	<div class="main">
	
		<!--
		<div class="sidenav">
			<a href="Order.php">ORDERS</a>
			<a href="DisplayAlbumType.php">ALBUM TYPE</a>
			<a href="DisplayAlbumSize.php">ALBUM SIZE</a>
			<a href="DisplayPageQuality.php">PAGE QUALITY</a>
		</div>
		-->
		
		
		<?php
		require('Menu.html');
		?>
		
		
		
		<div class="div_form_input">
			
			<form name="" action="" method="post" enctype="multipart/form-data">
				<font>
				
				<!--
				<div class='title_input'>Customer ID</div>
				<input type="number" name="id" placeholder="ID" required > 
				-->
				
				<div class='title_input'>Customer Phone No</div>
				<input type="number" name="phone" placeholder="Phone Number" required > 
				
				
				<div class='title_input'>Album Type</div>
				<select name='album_type'>
					<option value="none" selected disabled hidden> 
						Select Album Type
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
				<select name='album_size'>
					<option value="none" selected disabled hidden> 
						Select Album Size
					</option> 
					<?php #for Album Size
					
						$query="select * from album_size order by (price) ASC";
						$res=mysqli_query($con,$query);
					
						#for($i=0;$i<5;$i++)
						while($i=mysqli_fetch_array($res))
						{						
							echo "<option style='font:600 20px Arial;'>$i[0]</option>";
						}
					?>
				</select>
				<br>
				
				
				<div class='title_input'>Page Quality</div>
				<select name='page_quality'>
					<option value="none" selected disabled hidden> 
						Select Page Quality
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
				
				
				<div class='title_input'>No of Pages</div>
				<input type="number" name="no_of_pages" placeholder="No Of Pages" required > 
				
				<!--!-->
				
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
				<input type="file" name="album_photo" class="file" required > 
				<!--!-->
				
				
				<!--
				<div class='title_input'>Ordered Date</div>
				<input type="date" name="ordered_date" placeholder="Ordered Date" required  >
				-->
				
				<div class='title_input'>Delivery Date</div>
				<input type="date" name="delivery_date" placeholder="DD-MM-YYYY"  required  />
				
				<div class='title_input'>Advance Payment</div>
				<input type="number" name="advance_payment" placeholder="Advance Payment" required  >		
		
				<input type="submit" name="submit" value="submit">
				
				</font>
			</form>
			
			<div class='display_button_content'>
				<a href='Display.php' class='display_anchor'><button class='display_button'>Display</button></a>
			</div>

			
		</div>
		
		
	</div>

</body>
</html>
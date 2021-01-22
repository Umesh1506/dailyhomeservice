<?php
	include('connection.php');
	
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if(isset($_POST['user_id']) ) 
		{
			$user_id=$_POST['user_id'];		
			
			$query="select * from cart where user_id=".$user_id."";		
			$result=mysqli_query($conn,$query);
			while($row=mysqli_fetch_assoc($result))
			{
				$query2="select * from agency_product where product_id=".$row['product_id'];		
				$result2=mysqli_query($conn,$query2);
				$row2=mysqli_fetch_assoc($result2);
				$arr[]=array("user_id"=>$row['user_id'],"product_id"=>$row['product_id'],"product_name"=>$row2['product_name'],"product_img"=>$row2['product_img'],"cart_amount"=>$row['cart_amount'],"cart_qty"=>$row['cart_qty'],"cart_subtotal"=>$row['cart_subtotal'],"cart_status"=>$row['cart_status'],"agency_id"=>$row['agency_id']);
			}			
			if(!empty($arr))
			{ 	
				$array=array("status"=>"200","cart details"=>$arr);
			}
			else
			{
				$array=array("status"=>"600","Message"=>"Empty cart");
			}
		}	
		else
		{
			$array=array("status"=>"400","Message"=>"Variable are not set");
		}
		
	}
	else
	{
		$array=array("status"=>"500","Message"=>"Invalid Method");
	}
	echo json_encode($array);
?>
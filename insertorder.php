<?php	
	require_once("connection.php");
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if(isset($_POST['agency_id']) && isset($_POST['user_id']) && isset($_POST['order_amt'])  && isset($_POST['order_delivery_add']) && isset($_POST['order_delivery_area']) && isset($_POST['order_delivery_city']) )
		{
			$agency_id=$_POST['agency_id'];
			$user_id=$_POST['user_id'];
			$order_delivery_add=$_POST['order_delivery_add'];
			$order_amt=$_POST['order_amt'];
			$order_delivery_area=$_POST['order_delivery_area'];
			$order_delivery_city=$_POST['order_delivery_city'];
			
			date_default_timezone_set('Asia/Calcutta'); 
			$order_date=date('Y-m-d H:i:s');
			$order_status=0;
			
			$query="insert into `order`(order_agency_id,order_user_id,order_amt,order_delivery_add,order_status,order_date,order_delivery_area,order_delivery_city) 
				VALUES('".$agency_id."',".$user_id.",'".$order_amt."','".$order_delivery_add."','".$order_status."','".$order_date."','".$order_delivery_area."','".$order_delivery_city."')";
			$result=mysqli_query($conn,$query);
			 
			if($result)
			{
				 $query1="select * from `cart` where user_id=".$user_id." and agency_id=".$agency_id;		
				$result1=mysqli_query($conn,$query1);
				while($row1=mysqli_fetch_assoc($result1))
				{
					$getdata="select Max(`order_id`) as opid from `order`";
					$getres=mysqli_query($conn,$getdata);
					$rowdata=mysqli_fetch_assoc($getres);
				
			
					$query3="insert into `order_product`(order_product_pro_id,order_product_amt,order_product_qty,order_product_total,order_product_order_id) 
					VALUES('".$row1['product_id']."','".$row1['cart_amount']."','".$row1['cart_qty']."','".$row1['cart_subtotal']."',".$rowdata['opid'].")";
					$result3=mysqli_query($conn,$query3);
					if($result3)
					{
				
						$array=array("status"=>"200","Message"=>"Successfully product order insert");
					}
					else
					{
						$array=array("status"=>"800","Message"=>"Not inserted order product insert");
					}
				}
			}
			else
			{
				$array=array("status"=>"600","Message"=>"Not inserted order insert");
			}
		}	
		else 
		{
			$array=array("status"=>"430","Message"=>"variable Not Set");
		}	
	}
	else
	{
		$array=array("status"=>"400","Message"=>"Invalid Method");
	}
echo json_encode($array);
?>
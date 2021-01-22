<?php
	include('connection.php');
	
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if(isset($_POST['order_id'])) 
		{
			$order_id=$_POST['order_id'];
			
			$query6="select * from `order_product` where order_product_order_id=".$order_id;		
			$result6=mysqli_query($conn,$query6);
				
			while($row6=mysqli_fetch_assoc($result6))
			{
		
		    	$query7="select * from `agency_product` where product_id=".$row6['order_product_pro_id'];		
			    $result7=mysqli_query($conn,$query7);
		    	$row7=mysqli_fetch_assoc($result7);
		
				$arr[]=array("product_name"=>$row7['product_name'],"order_product_amt"=>$row6['order_product_amt'],"order_product_qty"=>$row6['order_product_qty'],"order_product_total"=>$row6['order_product_total']);
			}			
			if(!empty($arr))
			{ 	
				$array=array("status"=>"200","order details"=>$arr);
			}
			else
			{
				$array=array("status"=>"600","Message"=>"No order");
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
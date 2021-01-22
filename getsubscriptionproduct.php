<?php
	include('connection.php');
	
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if(isset($_POST['sub_id'])) 
		{
			$sub_id=$_POST['sub_id'];
			
			$query6="select * from subscription_product where sub_pro_sub_id=".$sub_id;		
			$result6=mysqli_query($conn,$query6);
				
			while($row6=mysqli_fetch_assoc($result6))
			{
		
		    	$query7="select * from `agency_product` where product_id=".$row6['sub_pro_product_id'];		
			    $result7=mysqli_query($conn,$query7);
		    	$row7=mysqli_fetch_assoc($result7);
		
				$arr[]=array("product_name"=>$row7['product_name'],"sub_pro_product_amt"=>$row6['sub_pro_product_amt'],"sub_pro_qty"=>$row6['sub_pro_qty'],"sub_pro_total"=>$row6['sub_pro_total']);
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
<?php	
	require_once("connection.php");
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if(isset($_POST['agency_id']) && isset($_POST['user_id']) &&
		isset($_POST['sub_amt'])  && isset($_POST['sub_delivery_add']) && 
		isset($_POST['sub_delivery_area']) && isset($_POST['sub_delivery_city']) 
		&& isset($_POST['sub_start_date']) && isset($_POST['sub_end_date']))
		{
			$agency_id=$_POST['agency_id'];
			$user_id=$_POST['user_id'];
			$sub_delivery_add=$_POST['sub_delivery_add'];
			$sub_amt=$_POST['sub_amt'];
			$sub_delivery_area=$_POST['sub_delivery_area'];
			$sub_delivery_city=$_POST['sub_delivery_city'];
			$sub_start_date=$_POST['sub_start_date'];
			$sub_end_date=$_POST['sub_end_date'];
			$sub_status=0;
			
			 $query="insert into `subscription`(sub_agency_id,sub_user_id,sub_amt,sub_delivery_add,sub_status,sub_start_date,sub_end_date,sub_delivery_area,sub_delivery_city) 
				VALUES('".$agency_id."',".$user_id.",'".$sub_amt."','".$sub_delivery_add."','".$sub_status."','".$sub_start_date."','".$sub_end_date."','".$sub_delivery_area."','".$sub_delivery_city."')";
			$result=mysqli_query($conn,$query);
			 
			
			if($result)
			{
			    
				$query1="select * from `cart` where user_id=".$user_id." and agency_id=".$agency_id;		
				$result1=mysqli_query($conn,$query1);
				while($row1=mysqli_fetch_assoc($result1))
				{
					$getdata="select Max(`sub_id`) as subid from subscription";
					$getres=mysqli_query($conn,$getdata);
					$rowdata=mysqli_fetch_assoc($getres);
				
			
					$query3="insert into `subscription_product`(sub_pro_product_id,sub_pro_product_amt,sub_pro_qty,sub_pro_total,sub_pro_sub_id) 
					VALUES('".$row1['product_id']."','".$row1['cart_amount']."','".$row1['cart_qty']."','".$row1['cart_subtotal']."',".$rowdata['subid'].")";
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
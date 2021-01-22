<?php
	include('connection.php');
	
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if(isset($_POST['user_id'])) 
		{
			$user_id=$_POST['user_id'];
			$query="select * from `order` where order_user_id=".$user_id." order by order_date DESC";		
			$result=mysqli_query($conn,$query);
			while($row=mysqli_fetch_assoc($result))
			{
				$query2="select * from user where user_id=".$row['order_user_id'];		
				$result2=mysqli_query($conn,$query2);
				$row2=mysqli_fetch_assoc($result2);
				
				$query3="select * from agency where agency_id=".$row['order_agency_id'];		
				$result3=mysqli_query($conn,$query3);
				$row3=mysqli_fetch_assoc($result3);
			
				$query4="select * from area where area_id=".$row['order_delivery_area'];		
				$result4=mysqli_query($conn,$query4);
				$row4=mysqli_fetch_assoc($result4);
			
			    $query5="select * from city where city_id=".$row['order_delivery_city'];		
				$result5=mysqli_query($conn,$query5);
				$row5=mysqli_fetch_assoc($result5);
				
				$arr[]=array("order_id"=>$row['order_id'],"order_amt"=>$row['order_amt'],"order_delivery_add"=>$row['order_delivery_add'],"order_delivery_area"=>$row['order_delivery_area'],"order_delivery_city"=>$row['order_delivery_city'],"area_name"=>$row4['area_name'],"city_name"=>$row5['city_name'],"order_status"=>$row['order_status'],"order_date"=>$row['order_date'],"agency_name"=>$row3['agency_name'],"user_name"=>$row2['user_fname'],"order_user_id"=>$row['order_user_id'],"order_agency_id"=>$row['order_agency_id']);
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
		else if(isset($_POST['agency_id']))
		{
			$agency_id=$_POST['agency_id'];
		    $query="select * from `order` where order_agency_id=".$agency_id." order by order_date DESC";		
			$result=mysqli_query($conn,$query);
			
			
			while($row=mysqli_fetch_assoc($result))
			{
			    $query2="select * from agency where agency_id=".$row['order_agency_id'];		
				$result2=mysqli_query($conn,$query2);
				$row2=mysqli_fetch_assoc($result2);
			
				$query3="select * from user where user_id=".$row['order_user_id'];		
				$result3=mysqli_query($conn,$query3);
				$row3=mysqli_fetch_assoc($result3);
				
					$query4="select * from area where area_id=".$row['order_delivery_area'];		
				$result4=mysqli_query($conn,$query4);
				$row4=mysqli_fetch_assoc($result4);
			
			$query5="select * from city where city_id=".$row['order_delivery_city'];		
				$result5=mysqli_query($conn,$query5);
				$row5=mysqli_fetch_assoc($result5);
			
			
				
			    $arr[]=array("order_id"=>$row['order_id'],"order_amt"=>$row['order_amt'],"order_delivery_add"=>$row['order_delivery_add'],"order_delivery_area"=>$row['order_delivery_area'],"order_delivery_city"=>$row['order_delivery_city'],"area_name"=>$row4['area_name'],"city_name"=>$row5['city_name'],"order_status"=>$row['order_status'],"order_date"=>$row['order_date'],"agency_name"=>$row2['agency_name'],"user_name"=>$row3['user_fname'],"order_user_id"=>$row['order_user_id'],"order_agency_id"=>$row['order_agency_id']);
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
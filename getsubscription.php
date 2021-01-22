<?php
	include('connection.php');
	
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if(isset($_POST['user_id'])) 
		{
			$user_id=$_POST['user_id'];
			$query="select * from subscription where sub_user_id=".$user_id." and sub_status=0";		
			$result=mysqli_query($conn,$query);
			while($row=mysqli_fetch_assoc($result))
			{
				$query2="select * from user where user_id=".$row['sub_user_id'];		
				$result2=mysqli_query($conn,$query2);
				$row2=mysqli_fetch_assoc($result2);
				
				$query3="select * from agency where agency_id=".$row['sub_agency_id'];		
				$result3=mysqli_query($conn,$query3);
				$row3=mysqli_fetch_assoc($result3);
			
				$query4="select * from area where area_id=".$row['sub_delivery_area'];		
				$result4=mysqli_query($conn,$query4);
				$row4=mysqli_fetch_assoc($result4);
			
			    $query5="select * from city where city_id=".$row['sub_delivery_city'];		
				$result5=mysqli_query($conn,$query5);
				$row5=mysqli_fetch_assoc($result5);
				
				$arr[]=array("sub_id"=>$row['sub_id'],"sub_amt"=>$row['sub_amt'],"sub_delivery_add"=>$row['sub_delivery_add'],"sub_delivery_area"=>$row['sub_delivery_area'],"sub_delivery_city"=>$row['sub_delivery_city'],"area_name"=>$row4['area_name'],"city_name"=>$row5['city_name'],"sub_status"=>$row['sub_status'],"sub_start_date"=>$row['sub_start_date'],"sub_end_date"=>$row['sub_end_date'],"agency_name"=>$row3['agency_name'],"user_name"=>$row2['user_fname'],"sub_user_id"=>$row['sub_user_id'],"sub_agency_id"=>$row['sub_agency_id']);
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
			$query="select * from subscription where sub_agency_id=".$agency_id." and sub_status=0";		
			$result=mysqli_query($conn,$query);
			while($row=mysqli_fetch_assoc($result))
			{
				$query2="select * from user where user_id=".$row['sub_user_id'];		
				$result2=mysqli_query($conn,$query2);
				$row2=mysqli_fetch_assoc($result2);
				
				$query3="select * from agency where agency_id=".$row['sub_agency_id'];		
				$result3=mysqli_query($conn,$query3);
				$row3=mysqli_fetch_assoc($result3);
			
				$query4="select * from area where area_id=".$row['sub_delivery_area'];		
				$result4=mysqli_query($conn,$query4);
				$row4=mysqli_fetch_assoc($result4);
			
			    $query5="select * from city where city_id=".$row['sub_delivery_city'];		
				$result5=mysqli_query($conn,$query5);
				$row5=mysqli_fetch_assoc($result5);
				
				$arr[]=array("sub_id"=>$row['sub_id'],"sub_amt"=>$row['sub_amt'],"sub_delivery_add"=>$row['sub_delivery_add'],"sub_delivery_area"=>$row['sub_delivery_area'],"sub_delivery_city"=>$row['sub_delivery_city'],"area_name"=>$row4['area_name'],"city_name"=>$row5['city_name'],"sub_status"=>$row['sub_status'],"sub_start_date"=>$row['sub_start_date'],"sub_end_date"=>$row['sub_end_date'],"agency_name"=>$row3['agency_name'],"user_name"=>$row2['user_fname'],"sub_user_id"=>$row['sub_user_id'],"sub_agency_id"=>$row['sub_agency_id']);
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
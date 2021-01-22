<?php
	include('connection.php');
	
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if(isset($_POST['agency_id'])) 
		{
			$agency_id=$_POST['agency_id'];
				
			$query="select * from area_by_agency where agency_id=".$agency_id."";	
			$result=mysqli_query($conn,$query);
			
			while($row=mysqli_fetch_assoc($result))
			{
			
			    	$query2="select * from area where area_id=".$row['area_id'];	
				$result2=mysqli_query($conn,$query2);
				$row2=mysqli_fetch_assoc($result2);
			
				
				$query3="select * from city where city_id=".$row2['city_id'];	
				$result3=mysqli_query($conn,$query3);
				$row3=mysqli_fetch_assoc($result3);
				
				$arr[]=array("city_id"=>$row2['city_id'],"city_name"=>$row3['city_name']);
			}
			
			if($result)
			{ 	
				$array=array("status"=>"200","City Response"=>$arr);
			}
			else
			{
				$array=array("status"=>"600","Message"=>"Data not found");
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
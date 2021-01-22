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
			    	$query4="select * from area where area_id=".$row['area_id'];		
				$result4=mysqli_query($conn,$query4);
				$row4=mysqli_fetch_assoc($result4);
			
				$arr[]=array("area_id"=>$row['area_id'],"area_name"=>$row4['area_name']);
			}
			
			if($result)
			{ 	
				$array=array("status"=>"200","area Response"=>$arr);
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
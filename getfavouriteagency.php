<?php	
	require_once("connection.php");
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if(isset($_POST['user_id']) && isset($_POST['cat_id']))
		{
			
			$user_id=$_POST['user_id'];
			$cat_id=$_POST['cat_id'];
			$arr=array();
			
			$query="select * from agency where agency_id in (select agency_id from favourite_agency where user_id='".$user_id."' And agency_id in (select agency_id from agency_category where cat_id=".$cat_id."))";
			$result=mysqli_query($conn,$query);
			while($row=mysqli_fetch_assoc($result))
			{
						$query1="select * from area where area_id='".$row['area_id']."'";
					$result1=mysqli_query($conn,$query1);
					$row1=mysqli_fetch_assoc($result1);
					
						$query2="select * from city where city_id='".$row1['city_id']."'";
					$result2=mysqli_query($conn,$query2);
					$row2=mysqli_fetch_assoc($result2);
				
			
				$arr[]=array("agency_id"=>$row['agency_id'],"agency_name"=>$row['agency_name'],"agency_contact_no"=>$row['agency_contact_no'],"area_id"=>$row['area_id'],"agency_img"=>$row['agency_img'],		"agency_area_name"=>$row1['area_name'],
							"agency_city_name"=>$row2['city_name']
				);
			}
			if(!empty($arr))
			{
				$array=array("status"=>"200","favourite agency Response"=>$arr);
			}
			else
			{
				$array=array("status"=>"600","Message"=>"Not response get");
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
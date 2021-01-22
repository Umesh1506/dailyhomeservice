<?php	
	require_once("connection.php");
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if(isset($_POST['area_id']))
		{
			$area_id=$_POST['area_id'];
					$arr=array();
			$query="select * from area where area_id='".$area_id."'";
			$result=mysqli_query($conn,$query);
			while($row=mysqli_fetch_assoc($result))
			{
				$query2="select * from city where city_id=".$row['city_id'];
				$result2=mysqli_query($conn,$query2);
				$row2=mysqli_fetch_assoc($result2);
				$arr[]=array("area_city"=>$row2['city_name'],"area_name"=>$row['area_name']);
			}
			if(!empty($arr))
			{
				$array=array("status"=>"200","City Response"=>$arr);
			}
			else
			{
				$array=array("status"=>"600","City Response"=>"Invalid credential");
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
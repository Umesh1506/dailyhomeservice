<?php	
	require_once("connection.php");
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if(isset($_POST['area_city']))
		{
			$arr=array();
			$city_name=$_POST['area_city'];
			$query2="select * from city where city_name='".$city_name."'";
			$result2=mysqli_query($conn,$query2);
			$row2=mysqli_fetch_assoc($result2);
			
			$query="select * from area where city_id=".$row2['city_id'];
			$result=mysqli_query($conn,$query);
			while($row=mysqli_fetch_assoc($result))
			{
					
				$arr[]=array("area_name"=>$row['area_name'],"area_id"=>$row['area_id']);
			}
			if(!empty($arr))
			{
				$array=array("status"=>"200","area Response"=>$arr);
			}
			else
			{
				$array=array("status"=>"600","area Response"=>"Invalid credential");
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
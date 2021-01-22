<?php	
	require_once("connection.php");
	if($_SERVER['REQUEST_METHOD']=="GET")
	{
			$query="select * from city ";
			$arr=array();
			$result=mysqli_query($conn,$query);
			while($row=mysqli_fetch_assoc($result))
			{
				$arr[]=array("city_id"=>$row['city_id'],"city_name"=>$row['city_name']);
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
		$array=array("status"=>"400","Message"=>"Invalid Method");
	}
echo json_encode($array);
?>
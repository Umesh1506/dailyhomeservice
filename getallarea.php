<?php	
	require_once("connection.php");
	if($_SERVER['REQUEST_METHOD']=="GET")
	{
		$query="select * from area";
		$arr=array();
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
		$array=array("status"=>"400","Message"=>"Invalid Method");
	}
echo json_encode($array);
?>
<?php	
	require_once("connection.php");
	if($_SERVER['REQUEST_METHOD']=="GET")
	{
		$query="select * from agency ";
		$arr=array();
		$result=mysqli_query($conn,$query);
		while($row=mysqli_fetch_assoc($result))
		{
			$arr[]=array("agency_email"=>$row['agency_email']);
		}
		if(!empty($arr))
		{
			$array=array("status"=>"200","agency Response"=>$arr);
		}
		else
		{
			$array=array("status"=>"600","agency Response"=>"Invalid credential");
		}	
	}
	else
	{
		$array=array("status"=>"400","Message"=>"Invalid Method");
	}
echo json_encode($array);
?>
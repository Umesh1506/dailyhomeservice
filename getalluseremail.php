<?php	
	require_once("connection.php");
	if($_SERVER['REQUEST_METHOD']=="GET")
	{
		$query="select * from user";
		$arr=array();
		$result=mysqli_query($conn,$query);
		while($row=mysqli_fetch_assoc($result))
		{
			$arr[]=array("user_email"=>$row['user_email']);
		}
		if(!empty($arr))
		{
			$array=array("status"=>"200","user Response"=>$arr);
		}
		else
		{
			$array=array("status"=>"600","user Response"=>"Invalid credential");
		}	
	}
	else
	{
		$array=array("status"=>"400","Message"=>"Invalid Method");
	}
echo json_encode($array);
?>
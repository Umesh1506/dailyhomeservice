<?php	
	require_once("connection.php");
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if(isset($_POST['order_id']))
		{
			$order_status=1;
			$order_id=$_POST['order_id'];
			$query="update `order` set order_status='".$order_status."' where order_id='".$order_id."'";
			$result=mysqli_query($conn,$query);
			if(mysqli_affected_rows($conn) > 0)
			{
				$array=array("status"=>"200","Order Response"=>"Successfull update");
			}
			else
			{
				$array=array("status"=>"600","Order Response"=>"Invalid credential");
			}
		}
		else
		{
			$array=array("status"=>"500","Message"=>"variables are not set");
		}
	}
	else
	{
		$array=array("status"=>"400","Message"=>"Invalid Method");
	}
echo json_encode($array);
?>
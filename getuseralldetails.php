<?php	
	require_once("connection.php");
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		
		if(isset($_POST['user_id']))
		{
			$user_id=$_POST['user_id'];
			$query="select * from user where user_id='".$user_id."'";
			$arr=array();
			$result=mysqli_query($conn,$query);
			while($row=mysqli_fetch_assoc($result))
			{
				$arr[]=array("user_fname"=>$row['user_fname']);
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
			$array=array("status"=>"430","Message"=>"Variable not set");
		}
	}
	else
	{
		$array=array("status"=>"400","Message"=>"Invalid Method");
	}
echo json_encode($array);
?>
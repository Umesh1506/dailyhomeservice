<?php	
	require_once("connection.php");
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		
		if(isset($_POST['agency_id']))
		{
			$agency_id=$_POST['agency_id'];
			$query="select * from agency where agency_id='".$agency_id."'";
			$arr=array();
			$result=mysqli_query($conn,$query);
			while($row=mysqli_fetch_assoc($result))
			{
				$arr[]=array("agency_name"=>$row['agency_name'],"agency_img"=>$row['agency_img']);
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
			$array=array("status"=>"430","Message"=>"Variable not set");
		}		
	}
	else
	{
		$array=array("status"=>"400","Message"=>"Invalid Method");
	}
echo json_encode($array);
?>
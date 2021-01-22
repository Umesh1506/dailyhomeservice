<?php	
	require_once("connection.php");
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		
		if(isset($_POST['agency_email']))
		{
			$agency_email=$_POST['agency_email'];
			$query="select * from agency where agency_email='".$agency_email."'";
			$arr=array();
			$result=mysqli_query($conn,$query);
			while($row=mysqli_fetch_assoc($result))
			{
				$arr[]=array("agency_contact_no"=>$row['agency_contact_no']);
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
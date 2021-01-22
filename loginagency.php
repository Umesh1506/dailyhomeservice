<?php	
	//include not require compulsory
	//require it require the file compulsory
	//isset check the variable 
	// String include '".."'
	// Simple variable ".."
	// to fatch the value from the variables in the array format mysqli_fetch_assoc
	require_once("connection.php");
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if(isset($_POST['agency_email']) && isset($_POST['agency_password']) && isset($_POST['agency_devicetoken']))
		{
			$aname=$_POST['agency_email'];
			$apass=$_POST['agency_password'];
$devicetoken=$_POST['agency_devicetoken'];
			$active=0;
					
			if(!empty($aname) && !empty($apass))
			{
				$query2="update agency set agency_devicetoken='".$devicetoken."' where  agency_email='".$aname."' and agency_password='".$apass."' and agency_active='".$active."'";
				$result2=mysqli_query($conn,$query2);
			
				$query="select * from agency where agency_email='".$aname."' and agency_password='".$apass."' and agency_active='".$active."'";
				$arr=array();
				$result=mysqli_query($conn,$query);
				//$count=mysqli_num_rows($result);
				//if(count==1)
				while($row=mysqli_fetch_assoc($result))
				{
					
				
					
					$arr[]=array("agency_id"=>$row['agency_id'],"agency_name"=>$row['agency_name'],"agency_contact_no"=>$row['agency_contact_no'],"area_id"=>$row['area_id'],"agency_devicetoken"=>$row['agency_devicetoken']);
				}
				if(!empty($arr))
				{
					$array=array("status"=>"200","Login Response"=>$arr);
				}
				else
				{
					$array=array("status"=>"600","Login Response"=>"Invalid credential");
				}
			}
			else
			{
				$array=array("status"=>"300","Message"=>"Variable is empty");
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
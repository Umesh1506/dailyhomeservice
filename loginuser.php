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
		if(isset($_POST['user_email']) && isset($_POST['user_password']) && isset($_POST['user_devicetoken']))
		{
			$uname=$_POST['user_email'];
			$pass=$_POST['user_password'];
			$devicetoken=$_POST['user_devicetoken'];
				$active=0;	
			if(!empty($uname) && !empty($pass))
			{
				$query2="update user set user_devicetoken='".$devicetoken."' where user_email='".$uname."' and user_password='".$pass."'  and user_active='".$active."'";
				$result2=mysqli_query($conn,$query2);
				$query="select * from user where user_email='".$uname."' and user_password='".$pass."'  and user_active='".$active."'";
				$arr=array();
				$result=mysqli_query($conn,$query);
				
				//$count=mysqli_num_rows($result);
				//if(count==1)
				while($row=mysqli_fetch_assoc($result))
				{
					
					
					$query1="select * from area where area_id='".$row['area_id']."'";
					$result1=mysqli_query($conn,$query1);
					$row1=mysqli_fetch_assoc($result1);
					
					$query2="select * from city where city_id='".$row1['city_id']."'";
					$result2=mysqli_query($conn,$query2);
					$row2=mysqli_fetch_assoc($result2);
					
					
					
					$arr[]=array("user_id"=>$row['user_id'],"user_fname"=>$row['user_fname'],"user_lname"=>$row['user_lname'],"user_contact_no"=>$row['user_contact_no'],"user_dob"=>$row['user_dob'],"area_id"=>$row['area_id'],"user_lat"=>$row['user_lat'],"user_long"=>$row['user_long'],"user_img"=>$row['user_img'],"user_area_name"=>$row1['area_name'],"user_city_name"=>$row2['city_name'],"user_devicetoken"=>$row['user_devicetoken']);
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
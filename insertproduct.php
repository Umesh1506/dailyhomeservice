<?php
	include('connection.php');
	
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if(isset($_POST['product_name']) && isset($_POST['product_desc']) && 
		isset($_POST['product_price']) && isset($_POST['product_img']) && 
		isset($_POST['cat_id']) && isset($_POST['agency_id']))
		{
			$product_name=$_POST['product_name'];		
			$product_desc=$_POST['product_desc'];
			$product_price=$_POST['product_price'];
			
			$cat_id=$_POST['cat_id'];
			$agency_id=$_POST['agency_id'];
			$photo=NULL;
		
			//photo
			if(!empty($_POST['product_img']))
			{
			
				$image_base64 = base64_decode($_POST['product_img']);
				$photo = uniqid() . '.jpeg';
				$file = "../img/" . $photo;
				file_put_contents($file, $image_base64);				
			}	
		
			$query="insert into agency_product(product_name,product_desc,product_price,product_img,cat_id,agency_id) 
			VALUES('".$product_name."','".$product_desc."','".$product_price."','".$photo."',".$cat_id.",".$agency_id.")";
										
			$result=mysqli_query($conn,$query);
			if($result)
			{ 	
				$array=array("status"=>"200","Message"=>"Successfull product inserted");
			}
			else
			{
				$array=array("status"=>"600","Message"=>"Data not found");
			}
		}	
		else
		{
			$array=array("status"=>"400","Message"=>"Variable are not set");
		}
		
	}
	else
	{
		$array=array("status"=>"500","Message"=>"Invalid Method");
	}
	echo json_encode($array);
?>
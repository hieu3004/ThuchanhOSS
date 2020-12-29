<?php
	include("../config/config.php");
	if(!isset($_SESSION)) session_start();
	
	$user= isset($_POST['Username'])?$_POST['Username']:'';
	$pass= isset($_POST['Password'])?$_POST['Password']:'';
	$pass=md5($pass);
	if(!$user||!$pass)
	{
		echo "vui long nhap day du thong tin vao!";
	}
	else
	{
		
		$sql="SELECT * From khachhang where Usernames=?";
		$stm=$obj->prepare($sql);
		$stm->execute([$user]);
		$n= $stm->rowCount();
		if($n==0)
		{
			echo "<script language='Javascript'>";
			echo "alert('Username khong dung')";
			echo "</script>";
		}
		
		$data= $stm->fetchALL();
		foreach($data  as $k => $v )
		{
			if($pass!=$v["Passwords"])
			{
				echo "<script language='Javascript'>";
				echo "alert('pass khong dung')";
				echo "</script>";
			}
			else{
				$_SESSION['khachhang']=$v;
				print_r($_SESSION['khachhang']);

				header('location:index.php');
			}
		}
		
	}
?>
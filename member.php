<?php
include "./config/config.php";
include "./config/connect.php";
include "./config/query.php";
if ($mode == "regist" ) {
	if ( $email == "" || $rname == "" || $surname == "" || $gender == "" || $weight == "" || $height == "" || $pass1 == "" || $pass2 == "" ) {
		echo "empty required filed";
	}elseif ( $pass1 != $pass2 ) {
		echo "failure password matching";	
	}elseif ( !is_numeric($weight) ||  !is_numeric($height) ) {
		echo "incorrect value";
	}elseif ( $weight < 50 || $weight > 300){
		echo "Weight should be greater than 50kg and less than 300kg";	
	}
	elseif ($height < 100 || $height >300){
		echo "Height should be greater than 100cm and less than 300cm";
	}
	else {
		$user_dist = getdata("select count(*) as cnt from User where Email='$email' " , $conn );
		if ($user_dist["cnt"] > 0 ) {
			echo "Email is already subscribed";
		}else {		
			$sql = "insert into User set Email = '$email' , Name = '$rname' , Surname = '$surname' , Gender = '$gender' , Weight = '$weight' , Height = '$height' , Password = '" . md5( $pass1 ) . "' ";
			//echo $sql;
			//exit;
			$res = mysqli_query( $conn , $sql);
			if ($res) {
				$user_info = getdata("select * from User where Email='$email' " , $conn );
				$_SESSION["sn_idx"] = $user_info["UserID"];
				$_SESSION["sn_email"] = $user_info["Email"];
				$_SESSION["sn_gender"] = $user_info["Gender"];
				$_SESSION["sn_weight"] = $user_info["Weight"];
				$_SESSION["sn_height"] = $user_info["Height"];
				$_SESSION["sn_name"] = $user_info["Name"];
				$_SESSION["sn_surname"] = $user_info["Surname"];
				echo "regist_ok";
			}else {
				echo "error";
			}	
		}
	}
	
}elseif ($mode == "login" ) {
	$res = getdata("select * from User where Email='$email' and Password='". md5( $pass ) . "'" , $conn );
	if ($res["UserID"] != "" ) {
		$_SESSION["sn_idx"] = $res["UserID"];
		$_SESSION["sn_email"] = $res["Email"];
		$_SESSION["sn_gender"] = $res["Gender"];
		$_SESSION["sn_weight"] = $res["Weight"];
		$_SESSION["sn_height"] = $res["Height"];
		$_SESSION["sn_name"] = $res["Name"];
		$_SESSION["sn_surname"] = $res["Surname"];
		echo "login_ok";
	}else {
		echo "incorrect login info";
	}
}elseif ($mode == "logout" ) {
	session_unset();
	echo "<script>location.href = './index.php';</script>";
}
?>

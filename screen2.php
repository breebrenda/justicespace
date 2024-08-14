
<?php 
if (isset($_POST['next'])) {
$phonenumber = $_POST['phonenumber'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
// start database connection
$servername='localhost';
$username='root';
$password=''; 
$dbname='justicespace';
// create connection
$conn=mysqli_connect($servername, $username, $password, $dbname);
// check connection
if (!$conn) {
die("connection failed:".mysqli_connect_error());	
	
}else{
	echo "success";

// end db connection
if (empty($phonenumber) && empty($username) && empty($email) && empty($password)) {
echo "All fields are required";		
	}else{
	$sql= "INSERT INTO `tbl_user`( `phonenumber`, `username`, `email`, `password`) VALUES ('$phonenumber','$username','$email','$password')";
	if (mysqli_query($conn,$sql) == true) {
		header('location:screen4.php');
		}else{
			echo "Something went wrong.Please try again...!";
		}	

}

}
}



?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>justice space</title>
</head>
<body>
	<img src="images/log.png" id="png">
	<h1 id="ve">Create account</h1>
	<br>
<form method="POST">
	<br><input type="text" name="phonenumber" placeholder="phonenumber" id="key" required><br>
	<br><input type="text" name="username" placeholder="usernname" id="tr" required><br>
	<br><input type="text" name="email"placeholder="Email" id="bg" required><br>
	<br><input type="password" name="password" placeholder="password" id="submitbtn" required><br><br>
	
<button id="kl"><a href="screen4.php" alt="screen4.php">
next</button>
</body>
</html>
<style type="text/css">
	#kl{
		border-radius: 100px;
		width: 100px;
	}

    #ve{

    }
	#bg{
		border-radius: 100px;
		width: 150px;
		height: 40px;
		text-align: center;
	
	}
	#submitbtn{
		border-radius: 100px;
		width: 150px;
		height: 40px;
		text-align: center;
	
	}
	#tr{
		border-radius: 100px;
		width: 150px;
		height: 40px;
		text-align: center;
	
	}
	#key{
		border-radius: 100px;
		width: 150px;
		height: 40px;
		text-align: center;
	
	}
	#qaw{
		border-radius: 100px;

		text-align: center;
		width: 110px;
	}
	#tall{
		background-color: #FE914B;
	
		margin-top: 5%;
		border-radius: 100px;
		height: 40;
		width: 150px;
	}

	#dnd{
		width: 10%;
		height: 30%;
		border-radius: 100px;

	
	}
	#see{

		color: #FF6600;
	}
	body{
		background-color: #F5F5F5;
		text-align: center;
	}
	#png{
		width: 200px;
		height: 200px;
		text-align: center;
	}
	
</style>
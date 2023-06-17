<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<!-- <link rel="stylesheet" href="style.css"> -->
	<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">

	<style>
		.foot{
    position: relative;
    height: 70px;
    background: cornflowerblue;
    top:940px;
}
.foot p{
    position: absolute;
    text-align: center;
    width: 100%;
    padding-top:20px;
    color:white;
}
	</style>

</head>
<body>
	<div class="main">
		<div class="side">
			<!-- <img src="images/side.png" alt=""> -->
		</div>
		
	</div>
	<div class="logo">
		<!-- <img src="images/presi.webp.crdownload" alt=""> -->
	</div>		
	
	<?php
		include('conn.php');
		error_reporting (E_ALL ^ E_NOTICE);
	?>
	<form method="post" id="form">
		<label for="Email" id="label1">Email id </label>
		<input type="email" id="input1" name="t1" required><br><br>
		<label for="password" id="label2">Password </label>
		<input type="text" name="t2" id="input2" required>
		<input type="submit" name="submit" id="sub1" value="Login">
			
</form>

<form method="post">
<input type="submit" id="sub2" name="signup" value="Signup">
</form>

<?php
	$a=$_POST['t1'];
	$b=$_POST['t2'];
	
	$_SESSION['data1']= "$a";

	function redirect($url) {
		header('Location: '.$url);
		die();
	}

	if(isset($_POST['signup'])){
		$url_s="signup.php";
		redirect($url_s);
		die();
	}
	if(isset($_POST['submit'])){
		$query1="SELECT * FROM login WHERE (email='$a' AND password='$b')";
		$result=mysqli_query($conn,$query1);
		
		if(mysqli_num_rows($result)>0){
			$url="home.php";
			redirect($url);
			die();
		}
		else{
			
			$query2 ="SELECT * FROM login WHERE email='$a'";
			$query3 ="SELECT * FROM login WHERE password='$b'";
			$result1=mysqli_query($conn,$query2);
			$result2=mysqli_query($conn,$query3);
			if(mysqli_num_rows($result1)>0 && mysqli_num_rows($result2)==0){
				echo"Wrong password !!!!";
			}
			else{
				echo "You dont any any account";
			}
			

		}
	}

	
?>

<div class="foot">
    <p>Copyright © 2022 web-eau.net. All Rights Reserved. - Legal notice<br>
Joomla! is Free Software released under the GNU General Public License. - The Joomla name and logo are used under a limited license granted by<br>
Open Source Matters in the United States and other countries. Web-eau.net is not affiliated with or endorsed by the Joomla project or by Open Source Matters.</p>
</div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
	<link rel="stylesheet" href="style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
    <style>
        .foot{
    position: relative;
    width: 100%;
    height: 70px;
    background: cornflowerblue;
    top:1000px;
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
<body style="background:rgb(219, 236, 245)">
    <div class="main">

    </div>
    <div class="htext">
        <h1>Hey are you a</h1>
        <a href="index.php">Login</a>
    </div>

    <?php 
    include("conn.php");    
    error_reporting (E_ALL ^ E_NOTICE); ?> 
    
    <form method="post">
    <input type="submit" name="prof" id="sub3" value="Professor">
    <input type="submit" name="stud" id="sub4" value="Student">
    </form>

    <?php
        
        $prof=$_POST['prof'];
        $stud=$_POST['stud'];

        if(isset($prof)){?>
        <form enctype="multipart/form-data" method="POST" id="form">
            <label for='name' id="label3">Name </label>
            <input type='text' name='t0' id="input3" required><br>
            <label for='Email' id="label4">Email id </label>
            <input type='email' name='emailp' id="input4" required><br>
            <label for='password' id="label5">Password </label>
            <input type='text' name='passp' id="input5" required><br>
            <label for='password' id="label6">Confirm Password </label>
            <input type='text' name='passc' id="input6" required><br>
            <label for='password' id="label7">Photo </label>
            <input type='file' name='pic' id="input7" required><br>
            <input type='submit' name='submit' id="sub5" value='Signup'>
            
    </form>
 
    <?php
        }
    if(isset($stud)){?>
        <form enctype="multipart/form-data" method="POST" id="form">
            <label for='name' id="label3">Name </label>
            <input type='text' name='t0' id="input3" required><br>
            <label for='Email'id="label4">College id </label>
            <input type='email' name='emailp' id="input4" required><br>
            <label for='password' id="label5">Password </label>
            <input type='text' name='passp' id="input5" required><br>
            <label for='password' id="label6">Confirm Password </label>
            <input type='text' name='passc' id="input6" required><br>
            <label for='password' id="label8">Roll no </label>
            <input type='text' name='roll' id="input8" required><br>
            <label for='password' id="label9">Photo </label>
            <input type='file' name='pic' id="input9" required><br>
            <input type='submit' name='submit1' id="sub6" value='Signup'>
            
    </form>
            
    <?php
    }


        $name_p=$_POST['t0'];
        $email_p=$_POST['emailp'];
        $pass_p=$_POST['passp'];
        $pic_p=$_FILES['pic'];
        $roll_p=$_POST['roll'];
        $passc_p=$_POST['passc'];

   


    if(!filter_var($email_p, FILTER_VALIDATE_EMAIL) && (isset($_POST['submit']) || isset($_POST['submit1']))){
        echo "wrong input!!!";
    }
       
    else{
        if((isset($_POST['submit']) || isset($_POST['submit1'])) && (isset($pic_p))){

            $img_name=$_FILES['pic']['name'];
            $img_size=$_FILES['pic']['size'];
            $tmp_name=$_FILES['pic']['tmp_name'];
            $img_error=$_FILES['pic']['error'];

            $query2 ="SELECT stuid FROM student WHERE stuid='$email_p'";
			$query3 ="SELECT email FROM teacher WHERE email='$email_p'";
			$result1=mysqli_query($conn,$query2);
			$result2=mysqli_query($conn,$query3);
            
			if($pass_p != $passc_p){
                echo "Your password not matched";
            }
            else{
                if(mysqli_num_rows($result1)>0 || mysqli_num_rows($result2)>0){
                    echo"Account already exist";
                }
                else{
                    if($img_error === 0){
                        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                        $img_ex_lc = strtolower($img_ex);
        
                        $allowed_exs = array('jpg','png','jpeg');
        
                        if(in_array($img_ex_lc,$allowed_exs)){
                                $new_img_name= uniqid("IMG-", true).'.'.$img_ex_lc;
                                $img_path='images_t/'.$new_img_name;
                                move_uploaded_file($tmp_name,$img_path);
                                //database insertion

                                if(isset($_POST['submit'])){
                                    $img_sql = "INSERT INTO teacher (name, email, password, image) values ('$name_p', '$email_p', '$pass_p', '$new_img_name')";
                                    $sql1 = "INSERT INTO login (email, password) values ('$email_p', '$pass_p')";
                                    $query_run = mysqli_query($conn,$img_sql);
                                    $query_run2 = mysqli_query($conn,$sql1);
                                }

                                else if(isset($_POST['submit1'])){
                                    $stu_sql= "INSERT INTO student (name, stuid, rollno, password, image) values ('$name_p', '$email_p', '$roll_p','$pass_p', '$new_img_name')";
                                    $sql2 = "INSERT INTO login (email, password) values ('$email_p', '$pass_p')";
                                    $query_run1 = mysqli_query($conn,$stu_sql);
                                    $query_run2 = mysqli_query($conn,$sql2);
                                }
                                else{
                                    $em="Unknown error";
                                    header("Location: signup.php?error=$em");
                                }        
        
                        }
                        else{
                            $em="imgage sould be in jpg, jpeg, png";
                            header("Location: signup.php?error=$em");
                        }
                    }
                    else{
                        $em="Unknown error";
                        header("Location: signup.php?error=$em");
                    }
    
                    function redirect($url) {
                        header('Location: '.$url);
                        die();
                    }
                
                        if(isset($_POST['submit']) || isset($_POST['submit1'])){
                        $url_s="index.php";
                        redirect($url_s);
                        die();
                    }   
                }  
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
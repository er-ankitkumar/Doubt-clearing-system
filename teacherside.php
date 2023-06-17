<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questions</title>
    <link rel="stylesheet" href="style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">

</head>
<body style="background:rgb(219, 236, 245)">
    <div class="main">
    
    </div>

    <?php
        include("conn.php");
        error_reporting (E_ALL ^ E_NOTICE); ?>

    <?php
        $t1=$_SESSION['data1'];?>
        <div class="idno">
            <?php echo "<h1> ID : $t1</h1>"; ?>
        </div>
        <?php
        $check="SELECT * from teacher WHERE email='$t1'";
        $result= mysqli_query($conn,$check);
        $check2="SELECT * from student WHERE stuid='$t1'";
        $result2= mysqli_query($conn,$check2);
        
        while($row = mysqli_fetch_array($result)){
            $dname= $row[0];
            $did= $row[1];
            $drollno= $row[2];
            $dimg= $row[3];
        }
        ?><div class="pic">
        <div class="mypic">
            <?php echo "<img src='images_t/$dimg'>" ;?>
        </div>
        </div>

        <div class="section">
        <?php echo "<h1>Section : 5CSE3</h1>";?>
        </div>
        
        
        <?php 
    
    
        
        $temp=$_SESSION['sub_t'];
    
            $sql12="SELECT * FROM questions WHERE subject = '$temp' ";
            $result_t= mysqli_query($conn,$sql12);

            while($row2 = mysqli_fetch_array($result_t)){
                $t_name= $row2[0];
                $t_rollno= $row2[1];
                $t_section= $row2[2];
                $t_sub= $row2[3];
                $t_question= $row2[4];
                $t_time = $row2[5];
            }
                echo "<h1 style='position:absolute;color:red;'>$_section</h1>";
            ?>

            <div class="t_ques_n">
                <h1><?php echo "Questions from $t_section";?></h1>
            </div> 
            <div class="t_ques">
            <p><?php echo "$t_question";?></p>
        </div>

        <div class="t_ques2">
            <h3>Question by:</h3>
            <p><?php echo "$t_name";?></p>
            <h5><?php echo "$t_rollno";?></h5>
        </div>
        
        <?php 
        ?>

        <div class="f">
        <a href="index.php">Logout</a>
        </div>

        
        
  
</body>
</html>
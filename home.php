<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">

</head>
<body>
    <div class="main">
    
    </div>

    <div class="time">
    <?php
// Set the new timezone
    date_default_timezone_set('Asia/Kolkata');
    $date = date('d-m-y h:i:s');
    ?>
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
        
    
        
        if(mysqli_num_rows($result2) == 1){

            while($row = mysqli_fetch_array($result2)){
                $dname= $row[0];
                $did= $row[1];
                $drollno= $row[2];
                $dimg= $row[4];
            }
            ?><div class="pic">
            <div class="mypic">
                <?php echo "<img src='images_t/$dimg'>" ;?>
            </div>
            </div>
            
            <div class="roll">
            <?php echo "<h1>Roll no : $drollno</h1>";?>
            </div>

            <div class="section">
            <?php echo "<h1>Section : 5CSE3</h1>";?>
            </div>
             
        <form id="form1" name="form1" method="post"  action="<?php echo $PHP_SELF; ?>">  
            <label for="subject" id="label11">Subject :</label>   
            <select name='new' id="input11">  
            <option value="">--- Select ---</option>  
            <?php  
                $list=mysqli_query($conn,"select * from subject order by sno asc");  
            while($row_list=mysqli_fetch_assoc($list)){  
                ?>  
                    <option value="<?php echo $row_list['sub_name']; ?>"<?php if($row_list['sno']==$select){ echo "selected"; } ?>>  
                                         <?php echo $row_list['sub_name'];?>  
                    </option>  
                <?php  
                }  
                ?>  
            </select> <br>

            <label for="question" id="label12">Question :</label>
            <textarea name="question" id="q" cols="30" rows="10"></textarea><br><br>

            <input type="submit" id="sub13" name="submit" value="Enter" />  
        </form> 
        <?php 
    
            $v1=$dname;
            $v2=$drollno;
            $v3="5CSE3";
            $v4=htmlentities($_POST['new']);
            $v5=$_POST['question'];
            $v6 = $date;
            if(isset($_POST['submit'])){
                $query4="INSERT INTO questions VALUES ('$v1','$v2','$v3','$v4','$v5','$v6')";
                $result3=mysqli_query($conn,$query4);

            }
    }
        if(mysqli_num_rows($result) == 1){ 
            
            while($row = mysqli_fetch_array($result)){
                $dname= $row[0];
                $demail= $row[1];
                $dimg= $row[3];
            
            }
            echo "<h1>Name: $dname</h1>";?>
            <div class="pic">
            <div class="mypic1">
                <?php echo "<img src='images_t/$dimg'>" ;?>
            </div>
            </div>
            

            <div class="section">
            <?php echo "<h1>Section : 5CSE3</h1>";?>
            </div>
        
        
        <form id="form1" name="form1" method="post" action="<?php echo $PHP_SELF; ?>">  
            <label for="section" id="label11" >Section :</label>   
            <select name='new1' id="input11">  
            <option value="">--- Select ---</option>  
            <?php  
                $list=mysqli_query($conn,"select * from sections order by sno asc");  
            while($row_list=mysqli_fetch_assoc($list)){  
                ?>  
                    <option value="<?php echo $row_list['sno']; ?>"<?php if($row_list['sno']==$select){ echo "selected"; } ?>>  
                                         <?php echo $row_list['sections'];?>  
                    </option>  
                <?php  
                }  
                ?>  
            </select> <br><br>

            <label for="subject" id="label12">Subject :</label>   
            <select name="new2" id="input12">  
            <option value="">--- Select ---</option>  
            <?php  
                $list=mysqli_query($conn,"select * from subject order by sno asc");  
                while($row_list=mysqli_fetch_assoc($list)){  
                    ?>  
                        <option value="<?php echo $row_list['sub_name']; ?>"<?php if($row_list['sno']==$select){ echo "selected"; } ?>>  
                                             <?php echo $row_list['sub_name'];?>  
                        </option>  
                    <?php  
                    }  
                ?>  
            </select> <br><br>
            <input type="submit" name="enter" id="sub14" value="Enter" />  
        </form>
        <?php 
        $_SESSION['sub_t'] = htmlentities($_POST['new2']);
        function redirect($url) {
            header('Location: '.$url);
            die();
        }
    
        if(isset($_POST['enter'])){
            $url_s="teacherside.php";
            redirect($url_s);
            die();
        }
         

    }
        ?>

        <div class="f">
        <a href="index.php">Logout</a>
        </div>

        
        
  
</body>
</html>
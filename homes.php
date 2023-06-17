<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <?php
        include("conn.php");
        error_reporting (E_ALL ^ E_NOTICE)?>

<form id="form1" name="form1" method="post" action="<?php echo $PHP_SELF; ?>">  
            <label for="subject">Subject :</label>   
            <select Emp Name='NEW'>  
            <option value="">--- Select ---</option>  
            <?php  
                $list=mysqli_query($conn,"select * from subject order by sno asc");  
            while($row_list=mysqli_fetch_assoc($list)){  
                ?>  
                    <option value="<?php echo $row_list['sno']; ?>"<?php if($row_list['sno']==$select){ echo "selected"; } ?>>  
                                         <?php echo $row_list['sub_name'];?>  
                    </option>  
                <?php  
                }  
                ?>  
            </select> <br>

            <label for="question">Questions</label>
            <textarea name="question" id="q" cols="30" rows="10"></textarea><br><br>

            <input type="submit" name="Submit" value="Enter" />  
        </form>  

        <?php 
        echo $_SESSION['var1'];
        if($_SESSION['var1'] == 1){
            echo "done";
        }
        ?>    
</body>
</html>
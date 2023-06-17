<?php include("conn.php");?>
<form method="post">
    <input type="submit" name="submit">
</form>
<?php
$var=$_POST["submit"];
$_SESSION['var1']=isset($var);

?>

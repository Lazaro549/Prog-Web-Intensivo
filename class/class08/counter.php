<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Counter</title>
</head>
<body>
<?php
if(isset($_GET["value"])){
    $value=$_GET["value"];
    $next=$value+1;
    $before=$valor-1;
}else{
    $value=0;
    $next=1;
    $before=-1;
}
?>
<h1 align="center"><?php echo $value; ?></h1>
<br>
<p align="center">
    <a href="counter.php?value=<?php echo $next; ?>">add</a> &nbsp;
    <a href="counter.php?value=<?php echo $before; ?>">sub</a>
<br>
    <a href="counter.php">Reset</a>
</p>

</body>

</html>

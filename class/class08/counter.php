<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contador</title>
</head>
<body>
<?php
if(isset($_GET["valor"])){
    $valor=$_GET["valor"];
    $proximo=$valor+1;
    $anterior=$valor-1;
}else{
    $valor=0;
    $proximo=1;
    $anterior=-1;
}
?>
<h1 align="center"><?php echo $valor; ?></h1>
<br>
<p align="center">
    <a href="contador.php?valor=<?php echo $proximo; ?>">Sumar</a> &nbsp;
    <a href="contador.php?valor=<?php echo $anterior; ?>">Restar</a>
<br>
    <a href="contador.php">Reset</a>
</p>

</body>
</html>
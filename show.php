<?php //header("X-Frame-Options: SAMEORIGIN"); ?>

<!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ImgAnim - TEST</title>
 </head>
<body>

<!-- Crop 
<iframe src='index.php?do=crop' scrolling='no' frameborder='no' style='border:none;width:260px;height:320px;overflow:hidden;'></iframe>
-->
<iframe src='index.php?do=crop' width='800px' height='450px'></iframe>


<!-- Show  scrolling='no' width='100%' heigth='100%' height='450px'-->
<iframe id="imganimFrame" src='index.php?do=show&imgcatid=110' width='100%' frameborder='no'></iframe>

</body>
</html>

<?php
$title=isset($_GET['page'])? ucwords(str_replace('_',' ',$_GET['page'])) : 'Dashbord';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title?></title>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <!-- <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/laftsidebar.css">
    <link rel="stylesheet" href="./css/mainbody.css"> -->
    <link rel="stylesheet" href="./css/main.css">
</head>
<body>
    <div class="" style="width: 100%; min-height: 875px; height: auto;">

        <div class="center flax bg-color3">

            <?php include('./structur/header.php') ?>

        </div>
        <?php if ($_SESSION['c_user']['authority']=='User') { ?>
            <div class="flax height" style=" width: 100%; min-height:860px; height:auto; margin:auto;">
                <?php include('./structur/mainbody.php') ?>
            </div>
        <?php } else { ?>
        
        <div class=" flax height" style=" width: 100%; ">

            <div class=" center bg-color2 height" style=" width: 15%;">

                <?php include('./structur/laftsidebar.php') ?>

            </div>

            <div class=" height" style="width: 85%;">
            
            
                <?php include('./structur/mainbody.php') ?>

            </div>

        </div>

        <?php } ?>

    </div>
</body>
</html>

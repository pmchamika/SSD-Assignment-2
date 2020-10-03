<?php
require_once "Controller/Function.php";
echo"
        <script>
            console.log(JSON.parse('".json_encode($_SESSION)."'))
        </script>
    ";

$islog=isset($_SESSION['Token'])&&$_SESSION['Token']!=null?true:false;
if(isset($_GET['status']) && isset($_GET['data']) && $_GET['status']=="0" ){
    echo"
        <script>
            alert('".$_GET['data']."')
        </script>
    ";
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>FB POST MANAGER</title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link href="assets/bootstrap-select-1.13.14/css/bootstrap-select.min.css" rel="stylesheet" />

        <!-- Bootstrap core JS-->
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
        <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script> -->
        <!-- Third party plugin JS-->
        
        <!-- Core theme JS-->
        
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="assets/bootstrap-select-1.13.14/js/bootstrap-select.min.js"></script>
        <script src="assets/bootstrap-select-1.13.14/js/i18n/defaults-en_US.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

    </head>
    <body id="page-top">
        
        <!-- Navigation-->
        <?php 
        
            if($islog){
                // nev panel add
                include "UI/LogInNev.php";
                //Headder
                include "UI/LoginHeader.php";
                //body
                include "UI/body.php";
            }else{
                // nev panel add
                include "UI/NotLogInNev.php";
                //Headder 
                include "UI/NotLoginHeader.php";  
            }
        ?>
        <!-- Masthead-->

        <!-- About-->
        
        <!-- Footer-->
        <footer class="footer bg-black small text-center text-white-50"><div class="container">Copyright © TriLoka Tech 2020</div></footer>
        
            <script src="js/scripts.js"></script>
    </body>
</html>

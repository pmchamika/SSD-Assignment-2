<header class="masthead">
    <div class="container d-flex h-100 align-items-center">
        <div class="mx-auto text-center">
            <!-- <h1 class="mx-auto my-0 text-uppercase">WelCome</h1> -->
            <img src="<?php echo $_SESSION['Uimg']; ?>" class="rounded" alt="Cinque Terre">
            <h2 class="text-white-50 mx-auto mt-2 mb-5"><?php echo $_SESSION['Name']; ?></h2>
            <a class="btn btn-danger js-scroll-trigger" href="Controller/LogOut.php" style="font-size: x-large;"><em class="fa fa-power-off" style="color:#FFFFFF;"></em>  LOGOUT</a>

        </div>
    </div>
</header>
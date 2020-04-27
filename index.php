<?php
session_start();
include "class/LoginUser.php";
include "class/LoginUserManager.php";

//$loginUsers = new LoginUser("phu",123);
$loginManager = new LoginUserManager("data/LoginData.json");
$data = $loginManager->getLoginUserss();


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $_SESSION['email'] = $email;

    foreach ($data as $datalogin) {

        if ($email == $datalogin->getEmail() && $password == $datalogin->getPassword()) {

            $_SESSION['isAuth'] = true;
            header('Location: home.php');
        } else {
            $_SESSION['isAuth'] = false;
            $message = " Tai khoan mat khau khong dung";
        }
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>login</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<section class="login-block">
    <div class="container">
        <div class="row">
            <div class="col-md-4 login-sec">
                <h2 class="text-center">Login</h2>
                <form class="login-form" action="" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="text-uppercase">Email</label>
                        <input type="text" class="form-control" placeholder="" name="email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1" class="text-uppercase">Password</label>
                        <input type="password" class="form-control" placeholder="" name="password">
                    </div>
                    <?php if (isset($message)) { ?>
                        <p style="color: red"> <?php echo $message ?></p>
                    <?php } ?>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input">
                            <small>Remember Me</small>
                        </label>
                        <button type="submit" class="btn btn-login float-right">Submit</button>
                    </div>
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="view/CreateAccount.php" style="color: orange;">Create a new
                                account</a>
                        </li>
                    </ul>
                </form>
                <div class="copy-text">Created with <i class="fa fa-heart"></i> by Grafreez</div>
            </div>
            <div class="col-md-8 banner-sec">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img class="d-block img-fluid" src="https://static.pexels.com/photos/33972/pexels-photo.jpg"
                                 alt="First slide">
                            <div class="carousel-caption d-none d-md-block">
                                <div class="banner-text">
                                    <h2>This is Heaven</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                        nostrud exercitation</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    include "../class/LoginUser.php";
    include "../class/LoginUserManager.php";
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $phone = $_REQUEST['phone'];

    $loginUser = new LoginUser($email,$password, $phone);
    $loginUserManager = new LoginUserManager("../data/LoginData.json");
    $loginUserManager->add($loginUser);
    header('Location: ../index.php');
}

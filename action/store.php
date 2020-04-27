<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include "../class/Student.php";
    include "../class/StudentManager.php";

    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $phone = $_REQUEST['phone'];
    //lay noi dung file
    $file = $_FILES['file']['tmp_name'];
    //duong dan file
    $nameFile = $_FILES['file']['name'];
    $pathStoreFile = "../data/uploads/" . $nameFile;
    move_uploaded_file($file, $pathStoreFile);
    $student = new Student($name, $email, $phone, $nameFile);
    $studentManager = new StudentManager("../data/data.json");
    $studentManager->add($student);
    header("Location: ../home.php");


}
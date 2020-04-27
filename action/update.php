<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include "../class/Student.php";
    include "../class/StudentManager.php";
    $index = $_REQUEST['index'];
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $phone = $_REQUEST['phone'];

    $studentManager = new StudentManager("../data/data.json");
    $student = $studentManager->getStudentsByIndex($index);
    $student->setName($name);
    $student->setEmail($email);
    $student->setPhone($phone);
    //kiem tra file co ton tai hay khong.
    if (file_exists($_FILES['file']['tmp_name'])){
        //xoa anh cu
        $currentAvatar = $student->getImage();
        if (file_exists('../data/uploads/'. $currentAvatar )){
            unlink('../data/uploads/'. $currentAvatar);
        }

        //upload anh moi
        $fileNew = $_FILES['file']['tmp_name'];
        //duong dan file
        $nameFile = $_FILES['file']['name'];
        $pathStofile = "../data/uploads/". $nameFile;
        move_uploaded_file($fileNew,$pathStofile);
        // dat lai gia tri thuoc tinh image
        $student->setImage($nameFile);
    }

    $studentManager->updateStudent($index, $student);
    header("Location: ../index.php");
}
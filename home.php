<?php

session_start();
if (!$_SESSION['isAuth']) {
    header('Location: index.php');
}
include "class/Student.php";
include "class/StudentManager.php";
$studentManager = new StudentManager("data/data.json");
$students = $studentManager->getStudents();
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $error = [];
    if (empty($_REQUEST['email'])){
        $error['email'] = " * Email không được để rỗng";
    } else {
      $pattern = '/^[A-Za-z0-9]+[A-Za-z0-9]*@[A-Za-z0-9]+(\.[A-Za-z0-9]+)$/';
//        $pattern = '/^([a-z]{2,})$/';
        if(!preg_match($pattern,$_REQUEST['email'])){
            $error['email'] = " * Email không đúng định dạng";
        } else {
            $email = $_REQUEST['email'];
        }
    }
    if (empty($_REQUEST['name'])){
        $error['name'] = " * name không được để rỗng";
    } else {
        $pattern = '/^[A-Za-z0-9\s]{1,50}$/';
        if(!preg_match($pattern,$_REQUEST['name'])){
            $error['name'] = " * name không đúng định dạng";
        } else {
            $name = $_REQUEST['name'];
        }
    }
    if (empty($_REQUEST['phone'])){
        $error['phone'] = " * phone không được để rỗng";
    } else {
//        $pattern = '/^([096|097|098|086|032|033|034|035|036|037|038|039|089|090|093|070|079|077|076|078|081|082|083|084|085]){1}([1-9]{7})$/';
        $pattern = '/^([0-9]{2,})$/';
        if(!preg_match($pattern,$_REQUEST['phone'])){
            $error['phone'] = " * phone không đúng định dạng";
        } else {
            $phone = $_REQUEST['phone'];

        }

    }
    if (!empty($name)){
        if (!empty($email)){
            if (!empty($phone)){
                $file = $_FILES['file']['tmp_name'];
                $nameFile = $_FILES['file']['name'];
                $pathStoreFile = "data/uploads/" . $nameFile;
                move_uploaded_file($file, $pathStoreFile);
                $student = new Student($name, $email, $phone, $nameFile);
                $studentManager = new StudentManager("data/data.json");
                $studentManager->add($student);
            }
        }
    }

}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quan ly sinh vien</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">

            <a class="navbar-brand" href="#">Danh sách sinh viên</a>
        </div>

        <div class="collapse navbar-collapse navbar-ex1-collapse">

            <ul class="nav navbar-nav navbar-right">
                <?php { ?>
                    <li><a href=""><?php echo $_SESSION['email'] ?></a></li>

                <?php } ?>
                <li><a href="view/logout.php">Đăng xuất</a></li>

            </ul>
        </div>
    </div>
</nav>
<div class="col-md-4">
<!--    //action="action/store.php"-->
    <form class="navbar-form navbar-left" role="search" method="post"  enctype="multipart/form-data">
        <h3><b>Thêm mới Sinh Viên</b></h3>
        <br>
        <span style="font-size: 16px">Họ và tên SV:</span>
        <input type="text" class="form-control" name="name">
        <?php if (isset($error['name'])) {?>
            <p style="color: red"> <?php echo $error['name'] ?> </p>
        <?php }?>
        <br>
        <br>
        <span style="font-size: 16px">Ảnh Sinh Viên:</span>
        <input type="file" class="form-control" name="file">
        <?php if (isset($error['file'])) {?>
            <p style="color:red"> <?php echo $error['file'] ?> </p>
        <?php }?>
        <br>
        <br>
        <span style="font-size: 16px">Địa chỉ Email:</span>
        <input type="text" class="form-control" name="email">
        <?php if (isset($error['email'])) {?>
            <p style="color: red"> <?php echo $error['email'] ?> </p>
        <?php }?>
        <br>
        <br>
        <span style="font-size: 16px">Số điện thoại:</span>
        <input type="text" class="form-control" name="phone">
        <?php if (isset($error['phone'])) {?>
            <p style="color:red"> <?php echo $error['phone'] ?> </p>
        <?php }?>
        <br>
        <br>
        <button type="submit" class="btn btn-success">Thêm Sinh Viên</button>

    </form>
</div>
<div class="col-md-8">
    <form class="navbar-form navbar-left" role="search" method="post" action="view/seach.php">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search" value="" name="keyword">
        </div>
        <a href="">
            <button class="btn btn-success">Tìm kiếm</button>
        </a>
    </form>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>STT</th>
            <th>Họ và tên</th>
            <th>Ảnh</th>
            <th>Địa chỉ Email</th>
            <th>Số điện thoại</th>
            <th>Group</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php if (isset($students)): ?>
            <?php foreach ($students as $index => $student): ?>
                <tr>
                    <td> <?php echo $index + 1 ?> </td>
                    <td> <?php echo $student->getName() ?> </td>
                    <td><img width="100" src="<?php echo "data/uploads/" . $student->getImage() ?>" alt=""></td>
                    <td> <?php echo $student->getemail() ?> </td>
                    <td> <?php echo $student->getphone() ?> </td>
                    <td></td>
                    <td><a href="view/edit.php?index=<?php echo $index ?>">
                            <button class="btn btn-success">Sửa</button>
                        </a></td>
                    <td><a onclick="return confirm('ban chac muon xoa') "
                           href="action/delete.php?index=<?php echo $index ?>">
                            <button class="btn btn-danger">Xóa</button>
                        </a></td>
                </tr>
            <?php endforeach ?>
        <?php else: ?>
            <tr>
                <td>No data</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</body>
</html>

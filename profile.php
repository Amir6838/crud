<?php
session_start();
include('db.php');
var_dump($_POST);
var_dump($_FILES);
if ($_SESSION['login']) {
    $db = new DataBase();
    $user = $db->search($_SESSION['username']);
    var_dump($user);
} else {
    header('location:index.php');
}

if (!empty($_POST)) {
    if (strcmp($_POST['password'], $_POST['newpassword']) == 0) {
        if (strcmp(md5($_POST['password']), $user['password']) == 0) {
            if (strcmp($user['username'], $_POST['username']) == 0) {
                $db->update($user['username'], $_POST['username'], $_POST['email'], $_POST['password'], $_POST['fname']
                    , $_POST['lname'], $_POST['profile']);
            }
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<style>
    body {
        background-color: blueviolet;
    }

</style>
<body>
<form class="container rounded bg-white mt-5" name="uploadForm" method="post" enctype="multipart/form-data"
      action="profile.php">
    <div class="row">
        <div class="col-md-4 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5"
                     src="<?php echo ($user['profile'] != NULL) ? $user['profile'] : 'public/img/vector.jpg' ?>"
                     width="90">
                <span class="font-weight-bold">John Doe</span>
                <span class="text-black-50">john_doe12@bbb.com</span>
                <span>United States</span></div>
        </div>
        <div class="col-md-8">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex flex-row align-items-center back"><i class="fa fa-long-arrow-left mr-1 mb-1"></i>
                        <a href="index.php"><h6>Back to home</h6></a>
                    </div>
                    <h6 class="text-right">Edit Profile</h6>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6"><input type="text"
                                                 name="firstname" class="form-control"
                                                 placeholder="<?php echo ($user['fname'] != NULL) ? $user['fname'] : 'The Fname is not set'; ?>">
                    </div>
                    <div class="col-md-6"><input type="text"
                                                 name="lastname" class="form-control"
                                                 placeholder="<?php echo ($user['lname'] != NULL) ? $user['lname'] : 'The Lname is not set'; ?>">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6"><input type="text" name="username" class="form-control"
                                                 placeholder="<?php echo $user['username']; ?>"></div>
                    <div class="col-md-6"><input type="text" name="email" class="form-control"
                                                 placeholder="<?php echo $user['email']; ?>"
                        ></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6"><input type="password" name="password" class="form-control"
                                                 placeholder="password"></div>
                    <div class="col-md-6"><input type="password" name="newpassword" class="form-control"
                                                 placeholder="New Password"></div>
                </div>
                <!--                <div class="row mt-3">-->
                <!--                    <div class="col-md-6"><input type="text" class="form-control" placeholder="Bank Name" value="Bank of America"></div>-->
                <!--                    <div class="col-md-6"><input type="text" class="form-control" value="043958409584095" placeholder="Account Number"></div>-->
                <!--                </div>-->
                <div class="row mt-3">
                    <label for="formFileDisabled" class="form-label col-3">Profile Picture</label>
                    <input class="form-control col-3" name="profileimg" type="file" id="formFileDisabled">
                </div>
                <div class="row mt-5 text-right">
                    <button class="btn btn-primary profile-button" type="submit">Edit Profile</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>

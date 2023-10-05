<?php
session_start();
include('db.php');
include('image_service.php');
if ($_SESSION['login']) {
    $db = new DataBase();
    $user = $db->search($_SESSION['username']);
} else {
    header('location:index.php');
}
if (!empty($_FILES)) {
    if ($_FILES['profileimg']['size'] > 0 and $_FILES['profileimg']['size'] < 1048576 and strcmp($_FILES['profileimg']['type'], 'image/jpeg') == 0) {
        uploadImg($user['username'], $_FILES['profileimg']);
        $db->update($user['username'], null, null, null, null
            , null, "assets/img/profile/" . $user['username'] . '.jpg');
        header('location:profile.php');
    } elseif ($_FILES['profileimg']['size'] > 1048590 or strcmp($_FILES['profileimg']['type'], 'image/jpeg') != 0) {
        ?>
        <div class="alert alert-danger container" role="alert">
            The format of the profile picture should be jpg and its size should be less than 1 megabyte
        </div>
        <?php
    }
}
if (!empty($_POST)) {
    if (strcmp($_POST['password'], $_POST['newpassword']) == 0) {
        if (strcmp(md5($_POST['password']), $user['password']) == 0) {

            if (strcmp($user['username'], $_POST['username']) == 0 and strcmp($user['email'], $_POST['email']) == 0) {
                $db->update($user['username'], null, null, null, $_POST['fname']
                    , $_POST['lname'], null);
                session_destroy();
                header('location:login.php');
                ?>

                <div class="alert alert-success container" role="alert">
                    ویرایش شما با موفقیت انجام شد
                </div>
                <?php

            } else {
                if (!empty($_POST['username']) and !empty($_POST['email'])) {
                    if ($db->search($_POST['username'], $_POST['email']) == false) {
                        ?>
                        <?php
                    } else {
                        $db->update($user['username'], $_POST['username'], $_POST['email'], null, $_POST['fname']
                            , $_POST['lname'], null);
                        session_destroy();
                        ?>
                        <div class="alert alert-success container" role="alert">
                            ویرایش شما با موفقیت انجام شد
                        </div>
                        <?php
                        session_destroy();
                        header('location:login.php');
                    }
                }
            }
        }
    } elseif (strcmp(md5($_POST['password']), $user['password']) == 0) {
        if ($db->search($_POST['username'], $_POST['email']) == false) {
            ?>
            <?php
        } else {
            $db->update($user['username'], $_POST['username'], $_POST['email'], $_POST['newpassword'], $_POST['fname']
                , $_POST['lname'], null);
            session_destroy();
            ?>
            <div class="alert alert-success container" role="alert">
                ویرایش شما با موفقیت انجام شد
            </div>
            <?php
            session_destroy();
            header('location:login.php');
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
                     src="<?php echo $user['profile']; ?>"
                     width="90">
                <span class="font-weight-bold"><?php echo $user['username'] ?></span>
                <span class="text-black-50"><?php echo $user['email'] ?></span>
                <span class="mt-4">To edit the profile, except for the profile picture, you must enter the password</span>
            </div>
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
                                                 name="fname" class="form-control"
                                                 placeholder="The Fname is not set"
                                                 value="<?php echo ($user['fname'] != NULL) ? $user['fname'] : null; ?>">
                    </div>
                    <div class="col-md-6"><input type="text"
                                                 name="lname" class="form-control"
                                                 value="<?php echo ($user['lname'] != NULL) ? $user['lname'] : null; ?>"
                                                 placeholder="The Lname is not set">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6"><input type="text" name="username" class="form-control"
                                                 value="<?php echo $user['username']; ?>"></div>
                    <div class="col-md-6"><input type="text" name="email" class="form-control"
                                                 value="<?php echo $user['email']; ?>"
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

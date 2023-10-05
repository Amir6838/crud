<?php
session_start();
include('db.php');
$db = new DataBase();
var_dump($_SESSION);
var_dump($_POST);
if ($_SESSION['login']) {
    if (isset($_POST['email']) and isset($_POST['password'])) {
        $user = $db->search('', $_POST['email']);
        if ($user != false) {
            if (strcmp($user['username'], $_SESSION['username']) == 0 and strcmp($user['password'], md5($_POST['password'])) == 0) {
                $db->delete($user['username']);
                if (strcmp($user['profile'], 'public/img/vector.jpg') != 0){
                    unlink($user['profile']);
                }
                session_destroy();
                header('location:register.php');
            }
        }

    }

} else {
    header('location:login.php');

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
        background-color: aquamarine;
    }
</style>
<body>
<form class="vh-100 gradient-custom" method="POST" action="delete.php">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <div class="mb-md-5 mt-md-4 pb-5">

                            <h2 class="fw-bold mb-2 text-uppercase">Delete Account</h2>
                            <p class="text-white-50 mb-5">Please enter your email and password!</p>

                            <div class="form-outline form-white mb-4">
                                <label class="form-label" for="typeEmailX">Email</label>
                                <input type="text" id="typeEmailX" name="email"
                                       class="form-control form-control-lg"
                                       placeholder="Enter your Email"/>

                            </div>

                            <div class="form-outline form-white mb-4">
                                <label class="form-label" for="typePasswordX">Password</label>
                                <input type="password" name="password" id="typePasswordX"
                                       class="form-control form-control-lg" placeholder="Enter your Password"/>
                            </div>

                            <button class="btn btn-outline-light btn-lg px-5 mt-3" type="submit">Delete</button>

                        </div>

                    </div>
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
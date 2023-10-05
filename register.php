<?php
include('db.php');
$db = new DataBase();
if (!empty($_POST['username']) and !empty($_POST['email'])) {
    if ($db->search($_POST['username'], $_POST['email']) != false) {
        ?>
        <div class="alert alert-danger container" role="alert">
            کاربری با این ایمیل و یا نام کاربری ثبت نام کرده است
        </div>
        <?php
    } else {
        $db->save($_POST['username'], $_POST['email'], $_POST['password']);
        ?>
        <div class="alert alert-success container" role="alert">
            ثبت نام شما با موفقیت انجام شد
        </div>
        <?php
        header('location:layout/login.php');
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
    body{
        background-color: blueviolet;
    }
</style>
<body>

<!--<form class="container row-8" method="post" action="register.php">-->
<!--    <div class="col-md-6 ">-->
<!--        <label for="inputAddress" class="form-label">UserName</label>-->
<!--        <input type="text" name="username" class="form-control">-->
<!--    </div>-->
<!--    <div class="col-6">-->
<!--        <label for="inputPassword4" class="form-label">Password</label>-->
<!--        <input type="text" name="password" class="form-control">-->
<!--    </div>-->
<!--    <div class="col-md-6">-->
<!--        <label for="inputEmail4" class="form-label">Email</label>-->
<!--        <input type="text" name="email" class="form-control">-->
<!--    </div>-->
<!--    <div class="col-12">-->
<!--        <button type="submit" class="btn btn-primary">Sign in</button>-->
<!--    </div>-->
<!--</form>-->

<form class="vh-100 bg-image" method="post" action="register.php"
         style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Create an account</h2>

                            <form method="post">

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example1cg">UserName</label>
                                    <input type="text" name="username" id="form3Example1cg" class="form-control form-control-lg" />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example3cg">Email</label>
                                    <input type="email" name="email" id="form3Example3cg" class="form-control form-control-lg" />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example4cg">Password</label>
                                    <input type="password" name="password" id="form3Example4cg" class="form-control form-control-lg" />

                                </div>
                                <div class="form-check d-flex justify-content-center mb-5">
                                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3cg" />
                                    <label class="form-check-label" for="form2Example3g">
                                        I agree all statements in <a href="#!" class="text-body"><u>Terms of service</u></a>
                                    </label>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit"
                                            class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Register</button>
                                </div>

                                <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="http://localhost/sinaweb/crud/login.php"
                                                                                                        class="fw-bold text-body"><u>Login here</u></a></p>

                            </form>

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
<?php
$_POST = NULL;
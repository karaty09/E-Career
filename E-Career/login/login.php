<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun&display=swap" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- CSS Style -->
    <link rel="stylesheet" href="../login/styles/stylesLogin.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-12" style="margin: 0; padding: 0">
                <picture>
                    <img src="../assets/img/login.jpg" alt="" class="img-styles">
                </picture>
            </div>
            <div class="col-md-6 col-12">
                <div class="d-flex justify-content-center h-100">
                    <div class="d-flex align-items-center justify-content-center">
                        <div style="padding: 20px;">
                            <center>
                                <div style="height: 100px;">
                                    <img src="../assets/img/logo.png" style="height: 130%;">
                                </div>
                            </center>
                            <br>
                            <br>
                            <form action="../login/login_db.php" method="post">
                                <div class="input-section">
                                    <h6>User:</h6>
                                    <div class="input-container">
                                        <img src="../assets/img/user.png" class="input-icon">
                                        <input type="password" id="user" name="user" placeholder="EX (Supansak)" required class="form-control border border-2 rounded-2 input-style">
                                    </div>
                                </div>
                                <div class="input-section">
                                    <h6>Password:</h6>
                                    <div class="input-container">
                                        <img src="../assets/img/padlock.png" class="input-icon">
                                        <input type="password" id="password" name="password" placeholder="EX (080XXXXXXX)" required class="form-control border border-2 rounded-2 input-style">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" name="btn_login" id="btn" class="rounded-2">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include '../assets/src/footer.php' ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>
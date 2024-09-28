<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karecode Test Seneryosu | Login Page</title>

    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/toastify.min.css" rel="stylesheet">
    <link href="../assets/css/login.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">

    <style>

    </style>
</head>

<body class="text-center">

    <main class="form-signin">
        <form data-action="/auth" class="text-center" data-method="POST" id="auth-form">
            <img class="mb-4" src="../assets/images/logos/karelogofav.png" alt="" width="45" height="45">
            <h1 class="h3 mb-3 fw-normal">Giriş Yapınız</h1>

            <div class="form-floating">
                <input type="email" class="form-control" name="email" id="email" placeholder="E-Posta Adresinizi Giriniz *" required minlength="1" maxlength="255">
                <label for="email">Kullanıcı Adınız <span class="text-danger">*</span></label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" name="password" id="password" placeholder="Şifrenizi Giriniz *" id="password" required minlength="1" maxlength="255">
                <label for="password">Şifreniz <span class="text-danger">*</span></label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Giriş Yap</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2024 KARECODE</p>
        </form>
    </main>


    <?php include_once('includes/backend/wait.php') ?>

    <script src="../assets/js/jquery-min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/toastify.min.js"></script>
    <script src="../assets/js/modules/login/auth.js"></script>
</body>

</html>
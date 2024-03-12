<?php
session_start();
require '../actions/functions.php';

if ($_SESSION['user']['is_Admin'] == 1) {
    toAdminPanel();
}
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Нарушениям.нет</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/main.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<nav class="navbar navbar-expand-lg p-3">
    <div class="container-xxl gap-3 p-3 shadow rounded">
        <a class="navbar-brand" href="index.php">Нарушениям.нет</a>
        <div id="navbarSupportedContent">
            <?php if (!isset($_SESSION['user'])): ?>
                <div class="d-flex gap-3 ms-auto">
                    <a class="btn btn-main" href="log-page.php">Вход</a>
                    <a class="btn btn-outline-main" href="reg-page.php">Регистрация</a>
                </div>
            <?php else: ?>

                <div class="d-flex gap-3 ms-auto">
                    <a class="btn btn-main" href="user-requests.php">Мои заявления</a>
                    <a class="btn btn-outline-danger" href="../actions/logout.php">выход</a>
                </div>

            <?php endif ?>
        </div>
    </div>
</nav>
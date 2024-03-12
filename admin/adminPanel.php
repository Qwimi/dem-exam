<?php
session_start();
require '../actions/functions.php';
if (!isset($_SESSION['user']) || $_SESSION['user']['is_Admin'] != 1) {
    toMainPage();
} else {
    $requests = getAllRequest();
}
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Панель администратора</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/main.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="formValid.js"></script>
</head>

<nav class="navbar navbar-expand-lg p-3">
    <div class="container-xxl gap-3 p-3 shadow rounded">
        <a class="navbar-brand" href="#">AdminPanel</a>
        <div id="navbarSupportedContent">
            <div class="d-flex gap-3 ms-auto">
                <a class="btn btn-outline-danger" href="../actions/logout.php">выход</a>
            </div>
        </div>
    </div>
</nav>

<div class="container-xxl">
    <div class="headlines">
        <h2>Здравствуйте,
            <?= $_SESSION['user']['fcs'] ?>
        </h2>
        <!-- <h3>Ваши заявления</h3> -->
        <div class="card list-group my-3">
            <?php while ($row = $requests->fetch()) : ?>
                <li class="list-group-item p-3 w-100">
                    <div class="row row-cols-4">
                        <div class="col text-start">
                            <b>ФИО заявителя:</b>
                            <?= $row['fcs'] ?>
                        </div>
                        <div class="col text-start">
                            <b>Номер машины:</b>
                            <?= $row['number'] ?>
                        </div>
                        <div class="col text-start">
                            <b>Описание нарушения:</b>
                            <?= $row['description'] ?>
                        </div>
                        <div class="col text-start">
                            <div class="text-<?= $row['type'] ?>">
                                <b>Статус:</b>
                                <?= $row['name'] ?>
                            </div>
                            <?php if ($row['status_id'] == 1) : ?>
                                <div class="mt-3 row row-cols-sm-2 gy-3">
                                    <div class="col">
                                        <a href="changeStatus.php?success=<?= $row['id'] ?>" class="btn btn-outline-success w-100">Подтвердить</a>
                                    </div>
                                    <div class="col">
                                        <a href="changeStatus.php?rejection=<?= $row['id'] ?>" class="btn btn-outline-danger w-100">Отклонить</a>
                                    </div>
                                </div>
                            <?php endif ?>

                        </div>
                    </div>
                </li>
            <?php endwhile; ?>
        </div>
    </div>
</div>
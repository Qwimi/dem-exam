<?php
include "../UIComponents/header.php";
if (isset($_SESSION['user']))
    toMainPage();
?>


<div class="container-xxl" method="post" action="" autocomplete="off">
    <form class="form rounded shadow p-3 bg-white" id="log-form" method="post">
        <h1 class="dark-text">Вход</h1>

        <div class="mb-3">
            <label for="log_login" class="form-label">Логин</label>
            <input type="text" class="form-control" id="log_login" name="log_login">
            <div class="error log_login-err"></div>
        </div>

        <div class="mb-3">
            <label for="log_password" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="log_password" name="log_password">
            <div class="error log_password-err"></div>
        </div>

        <p>Забыли пароль? - <a href="sent-letter.php">К восстановлению пароля</a></p>
        <p>Нет аккаунта - <a href="reg-page.php">зарегистрируйтесь</a></p>

        <button type="submit" class="btn btn-main" id="form-submit">Отправить</button>
    </form>
</div>

<script src="../scripts/formValid.js"></script>
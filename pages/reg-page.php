<?php
include "../UIComponents/header.php";
if (isset($_SESSION['user']))
    toMainPage();
?>


<div class="container-xxl">
    <form class="form rounded shadow p-3 bg-white" id="reg-form" method="post">
        <h1 class="dark-text">Регистрация</h1>
        <div class="mb-3">
            <label for="fcs" class="form-label">ФИО</label>
            <input type="text" class="form-control" id="fcs" name="fcs">
            <div class="error fcs-err"></div>
        </div>

        <div class="mb-3">
            <label for="login" class="form-label">Логин</label>
            <input type="text" class="form-control" id="login" name="login">
            <div class="error login-err"></div>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Почта</label>
            <input type="mail" class="form-control" id="email" name="email">
            <div class="error email-err"></div>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Телефон</label>
            <input type="tel" class="form-control" id="phone" name="phone" placeholder="+7 (___)-___-__-__">
            <div class="error phone-err"></div>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="password" name="password">
            <div class="error password-err"></div>
        </div>

        <div class="mb-3">
            <label for="pass_conf" class="form-label">Подтверждение пароля</label>
            <input type="password" class="form-control" id="pass_conf" name="pass_conf">
            <div class="error pass_conf-err"></div>
        </div>
        <div class="mb-3">
            <input type="checkbox" id="confirm" name="confirm" data-valid="check">
            <label for="confirm" class="form-label">Согласен с правилами пользования*</label>
            <div class="error confirm-err"></div>
        </div>

        <p style="font-size: .75rem;">Все поля обязательны для заполнения</p>

        <p>Уже есть аккаунт - <a href="log-page.php">войдите</a></p>

        <button type="submit" class="btn btn-main" id="form-submit">Отправить</button>
    </form>
</div>

<script src="../scripts/formValid.js"></script>
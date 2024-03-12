<?php
include('../UIComponents/header.php"');
if (isset($_SESSION['user']) == 1) {
    toMainPage();
}
?>


<div class="container-sm">
    <div class=" rounded shadow p-3 bg-white">

        <h1 class="dark-text">Восстановление пароля</h1>

        <form class="form" id="reset" method="post">
            <div class="mb-3">
                <label for="password" class="form-label">Новый пароль</label>
                <input type="password" class="form-control" id="password" name="password">
                <div class="error password-err"></div>
            </div>

            <div class="mb-3">
                <label for="pass_conf" class="form-label">Подтверждение пароля</label>
                <input type="password" class="form-control" id="pass_conf" name="pass_conf">
                <div class="error pass_conf-err"></div>
            </div>
            <button type="submit" class="btn btn-main" id="form-submit">Сохранить</button>
        </form>
    </div>
</div>
</div>



</div>

<script src="../scripts/newPassword.js"></script>
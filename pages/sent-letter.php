<?php
include('../UIComponents/header.php"')
?>


<style>
    .slider {
        display: flex;
        overflow: hidden;
    }

    .slide {
        flex: 0 0 100%;
        transition: transform 0.5s;
    }

    .active {
        transform: translateX(0);
    }
</style>

<div class="container-sm">
    <div class=" rounded shadow p-3 bg-white">

        <h1 class="dark-text">Восстановление пароля</h1>
        <div class="slider-wrapper">

            <div class="slider">
                <div class="slider-item">

                    <form class="form" id="reset" method="post">

                        <div class="mb-3">
                            <label for="login-or-mail" class="form-label">Ваш логин или почта</label>
                            <input type="text" class="form-control" id="login-or-mail" name="login-or-mail">
                            <div class="error login-or-mail-err"></div>
                        </div>

                        <button type="submit" class="btn btn-main" id="form-submit">Найти пользователя</button>
                    </form>
                </div>

                <div class="slider-item">
                    <div id="user-data">
                        <h3 id="user-fcs">Фамилия имя отчество</h3>
                        <p>Это вы?</p>
                        <button id="wrong-user" class="btn btn-outline-main">Нет, это не я</button>
                        <button id="right-user" class="btn btn-main">Да, это я</button>
                    </div>
                </div>

                <div class="slider-item">
                    <h4>На вашу почту отправленно сообщение с ссылкой на восстановление пароля</h4>
                    <p>Если вы не можете его найти - проверьте папку спам</p>
                </div>


            </div>


        </div>
    </div>



</div>

<script src="../scripts/resetPassword.js"></script>
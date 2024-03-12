<?php
include "../UIComponents/header.php";
if (!isset($_SESSION['user']))
    toLogPage();
?>


<div class="container-xxl">
    <form class="form rounded shadow p-3 bg-white" id="request-form" method="post">
        <h1 class="dark-text">Подача заявления</h1>
        <div class="mb-3">
            <label for="number" class="form-label">Номер машины</label>
            <input type="text" class="form-control" id="number" name="number" placeholder="A000AA">
            <div class="error number-err"></div>
        </div>

        <div class="mb-3">
            <label for="discription" class="form-label">Описание нарушения</label>
            <input type="text" class="form-control" id="discription" name="discription">
            <div class="error discription-err"></div>
        </div>
        <input type="hidden" id="user_id" name="user_id" value="<?= $_SESSION['user']['id'] ?>">

        <button type="submit" class="btn btn-main" id="form-submit">Отправить</button>
    </form>
</div>

<script src="../scripts/formValid.js"></script>
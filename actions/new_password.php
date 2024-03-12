<?php
require 'functions.php';

if (isset($_POST)) {
    try {
        $hash = $_POST['hash'];
        $password = $_POST['password'];
        $pass_conf = $_POST['pass_conf'];

        $getHashData = getHash($hash);

        $validationResult = [];
        $errors = [];

        if ($getHashData == null) {
            $errors['password'] = 'Ссылки не существует';
        }

        // if ($getHashData['created_at'] + 36000 >= time()) {
        //     $errors['password'] = 'Ссылка уже недействительна';
        // }

        if (strlen($password) < 6) {
            $errors['password'] = 'Пароль слишком короткий';
        }

        if ($pass_conf != $password) {
            $errors['pass_conf'] = 'Пароли не совпадают';
        }

        if (empty($errors)) {
            $validationResult['status'] = 'success';
            $validationResult['msg'] = 'Новый пароль установлен';
            $validationResult['redirect'] = 'log-page.php';
            updatePassword(md5($password), $hash);

        } else {
            $validationResult['status'] = 'error';
            $validationResult['errors'] = $errors;
        }
        echo json_encode($validationResult);
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage();
        die();
    }
}

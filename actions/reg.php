<?php
require 'functions.php';

if (isset($_POST)) {
    try {
        $fcs = $_POST['fcs'];
        $login = $_POST['login'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $pass_conf = $_POST['pass_conf'];
        $confirm = $_POST['confirm'];

        $validationResult = [];
        $errors = [];
        $fcs_pattern = '/^[\p{Cyrillic}\s\-]+$/u';
        $phone_pattern = '/\+7\s\([0-9]{3}\)\-[0-9]{3}\-[0-9]{2}\-[0-9]{2}/';

        if (preg_match($fcs_pattern, $fcs) == 0) {
            $errors['fcs'] = 'Некорректное значение';
        }
        ;

        if ((getUserByLogin($login))) {
            $errors['login'] = 'Пользователь с таким логином уже существует';
        }

        if ((getUserByEmail($email))) {
            $errors['email'] = 'Пользователь с такой почтой уже существует';
        }

        if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            $errors['email'] = 'Указана некорректная почта';
        }

        if (preg_match($phone_pattern, $phone) == 0) {
            $errors['phone'] = 'Указан некорректный номер   ' . $phone_pattern . "   " . $phone;
        }

        if (strlen($password) < 6) {
            $errors['password'] = 'Пароль слишком короткий';
        }

        if ($pass_conf != $password) {
            $errors['pass_conf'] = 'Пароли не совпадают';
        }

        if ($confirm != 'true') {
            $errors['confirm'] = 'Это обязательное поле';
        }

        if (empty($errors)) {
            $validationResult['status'] = 'success';
            $validationResult['msg'] = 'Регистрация прошла успешно, теперь вы можете войти в свой аккаунт';
            $validationResult['redirect'] = 'log-page.php';
            createUser($fcs, $login, md5($password), $phone, $email);

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

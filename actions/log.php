<?php
require 'functions.php';
session_start();


if(isset($_POST)) {
    try {
        $login = $_POST['log_login'];
        $password = $_POST['log_password'];

        $validationResult = [];
        $errors = [];
        $user = getUserByLogin($login);

        if(!($user)) {
            $errors['log_login'] = 'Пользователя с таким логином не существует';
        }

        if($user && $user['password'] != md5($password)) {
            $errors['log_password'] = 'Неверный пароль';
        }


        if(!empty($errors)) {
            $validationResult['status'] = 'error';
            $validationResult['errors'] = $errors;
        } else {
            $validationResult['status'] = 'success';
            $validationResult['msg'] = 'Вы успешно зашли в аккаунт';
            $_SESSION['user'] = $user;
            if($_SESSION['user']['is_Admin'] == 1) {
                $validationResult['redirect'] = '../admin/adminPanel.php';

            } else {
                $validationResult['redirect'] = 'log-page.php';
            }
        }
        echo json_encode($validationResult);
    } catch (PDOException $e) {
        print "Error!: ".$e->getMessage();
        die();
    }
}

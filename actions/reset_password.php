<?php
require 'functions.php';

if (isset($_POST)) {
    try {
        $user = $_POST['login-or-mail'];

        $validationResult = [];
        $errors = [];

        $user_get = getUserByLogin($user) ? getUserByLogin($user) : getUserByEmail($user);

        if ($user_get != "") {
            $user_from_server['id'] = $user_get['id'];
            $user_from_server['fcs'] = $user_get['fcs'];

            $validationResult['status'] = 'success';
            $validationResult['msg'] = $user_from_server;
        } else {
            $validationResult['status'] = 'error';
            $error["login-or-mail"] = "пользователя с таким логином или почтой не существует";
            $validationResult['errors'] = $error;
        }
        echo json_encode($validationResult);
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage();
        die();
    }
}

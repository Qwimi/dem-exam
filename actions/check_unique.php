<?php
require 'connection.php';

if (!empty($_POST["login"])) {
    $sql = "SELECT * FROM users WHERE `login` = \"{$_POST['login']}\"";
    $result = $conn->query($sql);
    if ($result->fetchColumn() != 0) {
        $response = [
            "status" => 'danger',
            "message" => "Пользователь с таким логином уже существует",
        ];
    } else {
        $response = [
            "status" => 'success',
            // "message" => "Пользователь с таким логином уже существует",
        ];
    }
    echo json_encode($response);
}

if (!empty($_POST["email"])) {
    $sql = "SELECT * FROM users WHERE `email` = \"{$_POST['email']}\"";
    $result = $conn->query($sql);
    if ($result->fetchColumn() != 0) {
        $response = [
            "status" => 'danger',
            "message" => "Пользователь с такой почтой уже существует",
        ];
    } else {
        $response = [
            "status" => 'success',
            // "message" => "Пользователь с таким логином уже существует",
        ];
    }
    echo json_encode($response);
}

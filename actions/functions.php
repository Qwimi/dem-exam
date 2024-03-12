<?php
require 'connection.php';

function getUserByLogin($login)
{
    global $conn;

    $sql = "SELECT * FROM `users` WHERE `login` = '$login'";
    $result = $conn->prepare($sql);
    $result->execute();
    $result = $result->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function getUserById($id)
{
    global $conn;

    $sql = "SELECT * FROM `users` WHERE `id` = $id";
    $result = $conn->prepare($sql);
    $result->execute();
    $result = $result->fetch(PDO::FETCH_ASSOC);
    return $result;
}


function getUserByEmail($email)
{
    global $conn;

    $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
    $result = $conn->prepare($sql);
    $result->execute();
    $result = $result->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function createUser($fcs, $login, $password, $phone, $email)
{
    global $conn;

    $sql = "INSERT INTO `users` (`fcs`, `login`, `password`, `phone`, `email`, `is_admin`) VALUES (\"$fcs\", \"$login\", \"$password\", \"$phone\", \"$email\", 0)";
    $result = $conn->prepare($sql);
    $result->execute();
    print($result->fetch(PDO::FETCH_ASSOC));
}

function createRequest($number, $discription, $user_id)
{
    global $conn;

    $sql = "INSERT INTO `request` (`user_id`, `status_id`, `number`, `description`) VALUES ($user_id, 1, \"$number\", \"$discription\")";
    $result = $conn->prepare($sql);
    $result->execute();
}

function getRequestByUserId($user_id)
{
    global $conn;

    $sql = "SELECT `request`.`number`, `request`.`description`, `status`.`name`, `status`.`type` FROM `request` INNER JOIN `status` on `status`.`id` = `request`.`status_id` WHERE `request`.`user_id` = $user_id";
    $result = $conn->prepare($sql);
    $result->execute();
    return $result;
}

function getAllRequest()
{
    global $conn;

    $sql = "SELECT `users`.`fcs`, `request`.`id`, `request`.`number`, `request`.`description`, `request`.`status_id`, `status`.`name`, `status`.`type` FROM `request` INNER JOIN `status` on `status`.`id` = `request`.`status_id` INNER JOIN `users` on `users`.`id` = `request`.`user_id`";
    $result = $conn->prepare($sql);
    $result->execute();
    return $result;
}


function sentLetterById($id)
{
    $mail = getUserById($id)['email'];
    $hash = bin2hex(random_bytes(16));
    $time = time();
    mail($mail, "Восстановление пароля по ссылке:", "Если вы не щапрашивали восстановленние пароля - игнорируйте данное письмо.\nhttp://nnet/pages/new-password.php?token=$hash");
    createHash($id, $hash, $time);
}

function createHash($user_id, $hash, $time)
{
    global $conn;

    $sql = "INSERT INTO `hash_links`(`user_id`, `hash`, `created_at`) VALUES ($user_id,'$hash' , $time)";
    $result = $conn->prepare($sql);
    $result->execute();
}

function updatePassword($password, $hash)
{
    global $conn;

    $sql = "UPDATE `users` SET `password`='$password' WHERE id = (SELECT user_id from `hash_links` WHERE `hash` = '$hash')";
    $result = $conn->prepare($sql);
    $result->execute();
    deleteHash($hash);
}

function deleteHash($hash)
{
    global $conn;

    $sql = "DELETE FROM `hash_links` WHERE `hash` = '$hash'";
    $result = $conn->prepare($sql);
    $result->execute();
}

function getHash($hash)
{
    global $conn;

    $sql = "SELECT * FROM `hash_links` WHERE `hash` = '$hash'";
    $result = $conn->prepare($sql);
    $result->execute();
    $result = $result->fetch(PDO::FETCH_ASSOC);
    return $result;
}


function toMainPage()
{
    header('Location: ../pages/index.php');
}

function toLogPage()
{
    header('Location: ../pages/log-page.php');
}

function toAdminPanel()
{
    header('Location: ../admin/adminPanel.php');
}


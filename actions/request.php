<?php
require 'functions.php';

if(isset($_POST)) {
    try {
        $number = $_POST['number'];
        $discription = $_POST['discription'];
        $user_id = $_POST['user_id'];

        $validationResult = [];
        $errors = [];
        $number_pattern = '/[А-ЯЁ]{1}[0-9]{3}[А-ЯЁ]{2}/';

        if(preg_match($number_pattern, $number) == 0) {
            $errors['number'] = 'Некорректное значение номера';
        }
        ;

        if(strlen($discription) < 6) {
            $errors['discription'] = 'Описание слишком короткое';
        }

        if(!empty($errors)) {
            $validationResult['status'] = 'error';
            $validationResult['errors'] = $errors;
        } else {
            $validationResult['status'] = 'success';
            $validationResult['msg'] = 'Вы создали заявку';
            createRequest($number, $discription, $user_id);
        }

        echo json_encode($validationResult);
    } catch (PDOException $e) {
        print "Error!: ".$e->getMessage();
        die();
    }
}

<?php

require '../actions/connection.php';

try {
    $sql = 'UPDATE `request` SET `status_id` = ? WHERE `id` = ?';
    $sth = $conn->prepare($sql);

    if(isset($_GET['success'])) {
        $sth->execute([2, $_GET['success']]);
    }
    if(isset($_GET['rejection'])) {
        $sth->execute([3, $_GET['rejection']]);
    }
    header("Location: ".$_SERVER['HTTP_REFERER']);
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
<?php
require 'functions.php';

if (isset($_POST)) {
    try {
        print_r($_POST['id']);
        sentLetterById($_POST['id']);
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage();
        die();
    }
}

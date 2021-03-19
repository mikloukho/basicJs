<?php
include_once('functions.php');
require_once('idiorm-master/idiorm.php');

try {
    // ORM::configure('error_mode', PDO::ERRMODE_EXCEPTION);
    ORM::configure('mysql:host=localhost;dbname=olympic');
    ORM::configure('username', 'root');
    ORM::configure('password', 'root');
    if (!ORM::get_db()){
        throw new Exception('Bad');
    }
    
} catch (PDOException $e) {
    echo 'Ошибка сервера попробуйте позже';
    die();
}

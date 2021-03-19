<?php 
include_once('config.php');
$sports = ORM::for_table('sports')->findMany();

if (isset($_POST['sport'])){

    $_POST['sport'] = htmlspecialchars($_POST['sport']);
    $_POST['sport'] = htmlspecialchars($_POST['sport']);
    $country = ORM::for_table('sports')->create();
    $country->name = $_POST['sport'];
    $country->save();
    header('Location: ./pages/sport.php');
}

if (isset($_GET['delete'])){
    db_delete('sports', $_GET['delete']);    
    header('Location: ./pages/sport.php');
}

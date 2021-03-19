<?php 
include_once('config.php');
$sportsmans = ORM::for_table('sportsmans')->find_array();

if (isset($_POST['sportsman'])){

    $_POST['sportsman'] = htmlspecialchars($_POST['sportsman']);
    $_POST['sportsman'] = htmlspecialchars($_POST['sportsman']);
    $country = ORM::for_table('sportsmans')->create();
    $country->name = $_POST['sportsman'];
    $country->save();
    header('Location: ./pages/sportsman.php');
}
if (isset($_GET['delete'])) {
    db_delete('sportsmans', $_GET['delete']);    
    header('Location: ./pages/sportsman.php');
}
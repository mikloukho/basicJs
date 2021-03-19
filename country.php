<?php 
include_once('config.php');

$countries = ORM::for_table('countries')->findMany();

if (isset($_POST['country'])){

    $_POST['country'] = htmlspecialchars($_POST['country']);
    $country = ORM::for_table('countries')->create();
    $country->name = $_POST['country'];
    $country->save();
    header('Location: .pages/country.php');
}

if (isset($_GET['delete'])) {
    db_delete('countries', $_GET['delete']);    
    header('Location: .pages/country.php');
}
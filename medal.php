<?php 
include_once('config.php');
$typesMedals = ORM::for_table('medals')->order_by_asc('id')->find_array();
$medals = ORM::for_table('country_medals')->select_many('country_medals.id', 'medals.type', 'country_medals.team')
                                            ->select_expr('GROUP_CONCAT(sportsmans.name)', 'sportsman')
                                            ->select('countries.name', 'country')
                                            ->select('sports.name', 'sport')
                                            ->join('sportsmans', array('country_medals.sportsman_id', '=', 'sportsmans.id'))
                                            ->join('medals', array('country_medals.medal_id', '=', 'medals.id'))
                                            ->join('countries', array('country_medals.country_id', '=', 'countries.id'))
                                            ->join('sports', array('country_medals.sport_id', '=', 'sports.id'))
                                            ->group_by('country_medals.team')->find_array();


if (isset($_POST['sportsman'])){
    insert_medal("$_POST[sportsman]");
    if (count($_POST) == 4){
        header('Location: ./pages/medal.php');
    }else{
        if (isset($_POST['sportsman2'])){
            insert_medal("$_POST[sportsman2]");
        }
        if (isset($_POST['sportsman3'])){
            insert_medal("$_POST[sportsman3]");
        }
        if (isset($_POST['sportsman4'])){
            insert_medal("$_POST[sportsman4]");
        }
        if (isset($_POST['sportsman5'])){
            insert_medal("$_POST[sportsman5]");
        }
        header('Location: ./pages/medal.php');
    }
}

if (isset($_GET['delete'])) {
    db_delete('country_medals', $_GET['delete']); 
    header('Location: ./pages/medal.php');

}
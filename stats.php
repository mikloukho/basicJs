<?php 
include_once('config.php');

if (isset($_GET['type']) and isset($_GET['country']) and $_GET['type'] != 'all' ) {
    $typeMedal = [
        'country_id' => intval($_GET['country']),
        'medal_id' => intval($_GET['type'])
    ];
} else if (isset($_GET['type']) and $_GET['type'] == 'all' ) {
    $typeMedal = [
        'country_id' => intval($_GET['country'])
];
}

$allMedals = ORM::for_table('country_medals')->select_many('country_medals.id', 'medals.type', 'country_medals.team')
                                            ->select_expr('GROUP_CONCAT(sportsmans.name)', 'sportsman')
                                            ->select('countries.name', 'country')
                                            ->select('sports.name', 'sport')
                                            ->join('sportsmans', array('country_medals.sportsman_id', '=', 'sportsmans.id'))
                                            ->join('medals', array('country_medals.medal_id', '=', 'medals.id'))
                                            ->join('countries', array('country_medals.country_id', '=', 'countries.id'))
                                            ->join('sports', array('country_medals.sport_id', '=', 'sports.id'))
                                            ->where($typeMedal)
                                            ->group_by('country_medals.team')
                                            ->find_array();

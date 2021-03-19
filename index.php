<?php
include_once('config.php');

$medalStandings = ORM::for_table('countries')
                ->select_many('countries.id', 'countries.name')
                ->select_expr('SUM(country_medals.medal_id = 1)', 'gold')
                ->select_expr('SUM(country_medals.medal_id = 2)', 'silver')
                ->select_expr('SUM(country_medals.medal_id = 3)', 'bronze')
                ->select_expr('COUNT(country_medals.team)', 'count')
                ->left_outer_join('country_medals', array('countries.id', '=', 'country_medals.country_id'))
                ->group_by('countries.id')
                ->order_by_desc('gold')
                ->order_by_desc('silver')
                ->order_by_desc('bronze')->find_array();

$ordered_list = [];

for ($i = 0; $i <= count($medalStandings); $i++){
    $ordered_list[$medalStandings[$i]['id']] = $i + 1;
}

if (isset($_GET['sort'])){
    $medalStandings =  sort_by_medals($_GET['sort'], $_GET['order']);
}

include('./pages/main.php');

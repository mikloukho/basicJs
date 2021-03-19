<?php

// Функция удаления спортсменов....стран из БД и связанных медалей
function db_delete($from, $id)
{
    $validGet = ['countries', 'sportsmans', 'sports', 'country_medals'];
    if (!is_numeric($id) and in_array($from, $validGet)){
        return false;
    }
    
    if ($from == 'country_medals') {
        ORM::for_table($from)->where('team', $id)->delete_many();
        return;
    }

    if ($from == 'countries'){
        $fromId = 'country_id';
    } else{
        $fromId = mb_substr($from, 0, -1) . '_id';
    }
    
    ORM::for_table('country_medals')->where($fromId, $id)->delete_many();
    ORM::for_table($from)->where('id', $id)->delete_many();
}

// Функция добавления медалей

function insert_medal($sportsman)
{
    if (is_numeric($_POST['type']) and is_numeric($_POST['country']) and is_numeric($_POST['sport']) and is_numeric($sportsman) ) {
        
        $medal = ORM::for_table('country_medals')->create();
                $medal->medal_id = $_POST['type'];
                $medal->country_id = $_POST['country'];
                $medal->sport_id = $_POST['sport'];
                $medal->sportsman_id = $sportsman;
                $medal->team = strtotime('now');
                $medal->save();
    }
}

// Функция сортировки в завсимости от текущего типа сортировки получаемого из текущего GET

function order_sort($current) 
{
    if (isset($_GET['sort'])){
        if($_GET['order'] == 'DESC' and $_GET['sort'] == $current) {
            return 'ASC';
        }else{
            return 'DESC';
        }
    }else{
        return 'ASC';
    }
}

// Функция сортировки по медалям, странам

function sort_by_medals($sort, $order) {
    $validGet = ['ASC', 'DESC'];
    if (!in_array($order, $validGet)){
        return;
    }
    
    $typesSort = [
        'gold' => "gold $order, silver $order, bronze $order",
        'silver' => "silver $order, gold $order, bronze $order",
        'bronze' => "bronze $order, silver $order, gold $order",
        'all' => "count $order, gold $order, silver $order, bronze $order",
        'position' => "gold $order, silver $order, bronze $order",
        'country' => "countries.name $order"
    ];

    $medalStandings = ORM::for_table('countries')
                ->select_many('countries.id', 'countries.name')
                ->select_expr('SUM(country_medals.medal_id = 1)', 'gold')
                ->select_expr('SUM(country_medals.medal_id = 2)', 'silver')
                ->select_expr('SUM(country_medals.medal_id = 3)', 'bronze')
                ->select_expr('COUNT(country_medals.team)', 'count')
                ->left_outer_join('country_medals', array('countries.id', '=', 'country_medals.country_id'))
                ->group_by('countries.id')
                ->order_by_expr($typesSort[$sort])->find_array();
    return $medalStandings;
}


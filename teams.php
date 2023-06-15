<?php
$teamContent = '';
$teamNames = array();
$dbObj = new db();
$results = $dbObj->selectFunction("SELECT teamNaam FROM `teamsdata`;");
if($results[0] != false){
    $teamContent .= 'Kies een van de volgende teams!<br>';
    foreach($results as $result){
        $teamContent .= '<a href="index.php?modules=teams&team=' . $result[0] . '">' . $result[0] . '</a>';
        array_push($teamNames, $result[0]);
    }
} else {
    $teamContent .= 'Eén of meerdere teams konden niet worden opgehaald!<br>Meld dit aub bij de beheerder!';
}

return array(0 => true, 'title' => 'teams', 'text' => $teamContent);
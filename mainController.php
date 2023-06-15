<?php
function mainControllerFunction($givenTitleArray){
    $errorArray = array(0 => false, 'text' => '<strong>ERROR 404</strong><br>Klik <a href="index.php?modules=home">hier!</a> om terug te keren naar de hoofdpagina', 'title' => 'ERROR');
    $mainControllerContentObject = new content();
    if(isset($_GET['modules'])){
        if($_GET['modules'] != 'login' && $_GET['modules'] != 'teams'){
            $amountOfTitles = count($givenTitleArray);
            foreach($givenTitleArray as $givenTitle){
                $amountOfTitles--;
                if($_GET['modules'] == $givenTitle){
                    return $mainControllerContentObject->turnDataToHtml($_GET['modules']);
                } elseif($amountOfTitles == 0) {
                    return $errorArray;
                }
            }
        } elseif($_GET['modules'] == 'login'){
            return require_once(__DIR__ . DIRECTORY_SEPARATOR . 'login.php');
        } elseif(isset($_GET['teams']) || $_GET['modules'] == 'teams'){
            return require_once(__DIR__ . DIRECTORY_SEPARATOR . 'teams.php');
        } else {
            return $errorArray;
        }
    } else {
        return $mainControllerContentObject->turnDataToHtml('home');
    }
}
?>
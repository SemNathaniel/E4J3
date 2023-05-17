<?php
$mControllerContentObj = new content();
function mControllerFunction($givenTitleArray){
    if(isset($_GET['modules'])){
        $amountOfTitles = count($givenTitleArray);
        foreach($givenTitleArray as $givenTitle){
            if($_GET['modules'] == $givenTitle && $amountOfTitles != 0 || $amountOfTitles <= 0){

            }
        }
    } else {
         
    }
}
?>
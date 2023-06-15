<?php
//$titlename needs to be gotten from the $_GET otherwise need to go to home
//content class needs to be filled with some functions that ask what page we are going to fill so the html can be structured well from there 
//$navBar needs to be made after we get the pages from the db using db.class.php
//make a controller to deal with content
if(file_exists('db.class.php') && file_exists('user.class.php') && file_exists('config.php') && file_exists('content.class.php')){
    require_once('db.class.php');
    require_once('config.php');
    require_once('user.class.php');
    require_once('content.class.php');
    require_once('mainController.php');
} else {
    echo 'een van de required files was niet aanwezig';
    die();
}
$dbObj = new db();
$results = '';
$navBar = '';
$bodyText = '';
$bodyImage = '';
$titleName = '';
$mModules = array();
$pathToHome = '';
$results = $dbObj->selectFunction("SELECT paginaTitel FROM `paginadata`;");
 foreach($results as $result){
    $navBar .= '<a href="index.php?modules=' . $result[0] . '">' . $result[0] . '</a>';
    array_push($mModules, $result[0]);
}
$navBar .= '<a href="index.php?modules=teams">teams</a>';
$results = mainControllerFunction($mModules);
$bodyText .= $results['text'];
(isset($results['image'])) ? $bodyImage .= $results['image'] : $bodyImage .= '';
$titleName .= $results['title'];
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <title>' . $titleName . ' | Rode Raketten</title><!--Vul opdracht naam in en de week-->
    <link href="Style.css" rel="stylesheet"><!--Css werkt met class attribute-->
</head>
<body>
<header>
    <div class="siteNaamEnTitel">
    <h1 class="rodeRaketNaam">    <img src="images/raketLogo.png" alt="logo van de rode raketten" class="logo">Rode Raketten</h1>
    <h3 class="siteTitel">' . $titleName . '</h3>
    </div>
    <div class="siteNavigatiebalk">
        ' . $navBar . '
    </div>
</header>
<main>
    <div class="bodyText">
    ' . $bodyText . '
    </div>
    <div class="bodyImage">
    ' . $bodyImage . '
    </div>
</main>
<footer>
    <h3>FC Rode Raketten® <img src="images/raketLogo.png" alt="logo van de rode raketten" width="40px" height="40px" style="float: right;"></h3>
</footer>
</body>
</html>';
echo $html;
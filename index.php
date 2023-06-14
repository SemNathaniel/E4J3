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
$results = mainControllerFunction($mModules);
$bodyText .= $results['text'];
(isset($results['image'])) ? $bodyImage .= $results['image'] : $bodyImage .= '';
$titleName .= $results['title'];
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <title>' . $titleName . '</title><!--Vul opdracht naam in en de week-->
    <link href="Style.css" rel="stylesheet"><!--Css werkt met class attribute-->
</head>
<body>
<header>
    <img src="images/raketLogo.png" alt="logo van de rode raketten" class="logo">
    <h1 class="siteTitel">' . $titleName . '</h1>
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
    <h3>FC Rode Raketten®  Door Nathan ten Brink</h3>
</footer>
</body>
</html>';
echo $html;
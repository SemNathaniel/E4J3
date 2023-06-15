<?php
require_once('config.php');
require_once(ROOT_URL . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'db.class.php');
require_once(ROOT_URL . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'user.class.php');
require_once(ROOT_URL . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'content.class.php');
require_once('mainController.php');
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
    <h1 class="rodeRaketNaam"><img src="images/raketLogo.png" alt="logo van de rode raketten" class="logo">Rode Raketten</h1>
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
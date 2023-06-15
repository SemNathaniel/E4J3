<?php
session_start();
require_once('config.php');
require_once(ROOT_URL . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'db.class.php');
require_once(ROOT_URL . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'user.class.php');
require_once(ROOT_URL . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'content.class.php');
require_once('mainController.php');
$dbObj = new db();
$results = '';
$userStatus = '';
$loginLogout = '';
$navBar = '';
$bodyText = '';
$bodyImage = '';
$titleName = '';
$mModules = array();
$pathToHome = '';
$userStatus = null;
$userObject = new user();
if(isset($_POST['username']) && isset($_POST['userpass']) && !empty($_POST)){
    $bodyText .= $userObject->userLogin($_POST['username'], $_POST['userpass']);
}
$userStatus .= $userObject->isUserLoggedIn();
$results = $dbObj->selectFunction("SELECT paginaTitel FROM `paginadata`;");
 foreach($results as $result){
    $navBar .= '<a href="index.php?modules=' . $result[0] . '">' . $result[0] . '</a>';
    array_push($mModules, $result[0]);
}
$navBar .= '<a href="index.php?modules=teams">teams</a>';
if($userStatus == 1){
    $navBar .= '<a href="index.php?modules=createNew">create new</a><a href="index.php?modules=edit">edit</a>';
    $loginLogout .= '<a href="index.php?modules=logout" style="float: right;text-decoration: none;color: white;background-color: rgb(70,0,0);border: 2px solid rgb(40,0,0);">log out</a>';
} else {
    $loginLogout .= '<a href="index.php?modules=login" style="float: right;text-decoration: none;color: white;background-color: rgb(70,0,0);border: 2px solid rgb(40,0,0);">log in</a>';

}
$results = mainControllerFunction($mModules);
if(isset($_GET['modules'])){
    if($_GET['modules'] == 'logout'){
        $userObject->logoutUser();
    }
}
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
    ' . $loginLogout . '
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

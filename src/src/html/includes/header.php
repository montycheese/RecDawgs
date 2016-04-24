<?php
session_start();
$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

if (strpos($url,'login.php') === false) {
    //die(var_dump($_SESSION));
    if (!isset($_SESSION) || !isset($_SESSION['userObject'])){
      //  die(var_dump($_SESSION));
        //redirect to login page
        header("Location: login.php");
        exit();
    }
}

//echo var_dump($_SESSION);
use edu\uga\cs\recdawgs\presentation as Presentation;

?>

<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>RecDawgs</title>
    <meta name="description" content="A Content Management System for Recreational Sports">
    <meta name="author" content="Montana Wong">

    <!--<link rel="stylesheet" href="css/main.css">-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">

    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">RecDawgs</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Home <span class="sr-only">(current)</span></a></li>
                <li><a href="leagues.php">Leagues</a></li>
                <!--
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sports <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="index.php"></a></li>
                        <li><a href="#">Leagues</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">My Teams</a></li>
                    </ul>
                </li>-->
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php">Logout</a></li>
                <?php //add logic here to show login or logout based on session state?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<?php
if(isset($_GET['status'])) {
    $alert = urldecode($_GET['status']);
    echo("<div class='alert-danger'><h3>{$alert}</h3></div>");
}
?>
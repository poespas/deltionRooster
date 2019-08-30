<?php

if (!isset($_GET["class"]))
    die("Select Class Sie Vous Plez");

require_once("inc/Rooster.inc.php");
require_once("inc/ConvertRooster.inc.php");

$rooster = new Rooster();

$class = $_GET['class'];


if (!$rooster->setClass($class)) {
    die("Class does not exist ecks dee");
}
else {
    $data = $rooster->get();
    $convertRooster = new ConvertRooster($data);

    // header('Content-Type: text/calendar; charset=utf-8');
    // header('Content-Disposition: attachment; filename="'.$class.'.ics"');

    echo $convertRooster->toIcal();
}
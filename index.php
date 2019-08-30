<?php
require_once("inc/Rooster.inc.php");

$msg = [
    "error" => [],
    "success" => []
];


if (isset($_POST["class"])) {
    $class = strtoupper($_POST["class"]);

    $rooster = new Rooster();
    if (!$rooster->setClass($class)) {
        $msg["error"][] = "<h2>Error!</h2>
        <p>Class is does not exist.</p>";
    }
    else {
        $rooster->get();
        $msg["success"][] = '<h2>Done!</h2>
            <p>To set up, import this to your calendar software: </p>
			'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . $class . '.ical
            <p>Or download directly: </p>
            <a href="http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . $class .'.ical" class="dl-btn">Download</a>';
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Deltion Rooster</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
        .container {
            max-width: 1200px;
            background-color: lightgrey;
            margin: auto;
            padding: 5px;
        }
        .main {
            margin-top: 200px;
            min-height: 200px;
            background-color: white;
            border-radius: 5px;
            padding: 5px 75px;
        }
        .main.error {
            background-color: #ff8a80;
        }
        .main.success {
            background-color: #b9f6ca;
        }
        .result .main {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="result">
            <?php
                foreach ($msg["error"] as $notif) {
                    echo '<div class="main error">
                        '.$notif.'
                    </div>';
                }
                foreach ($msg["success"] as $notif) {
                    echo '<div class="main success">
                        '.$notif.'
                    </div>';
                }
            ?>
        </div>
        <div class="main">
            <h1>Select your class:</h1>
            <form action="" method="post">
                <input type="text" name="class" id="class">
                <input type="submit" value="Go">
            </form>
        </div>
    </div>
</body>
</html>
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    $doc = new DOMDocument();
    $doc->loadHTMLFile("login.html");
    echo $doc->saveHTML();
} else {
    if (empty($_POST['name'])) {
        echo 'The username field must not be empty.';
        exit;
    }
    if (empty($_POST['password'])) {
        echo 'The password field must not be empty.';
        exit;
    }
    $mysqli = new mysqli('marstanjxcom.ipagemysql.com', 'mars', 'root', 'marsql');
    if ($mysqli->connect_errno) {

        echo "Sorry, this website is experiencing problems.";

        // Something you should not do on a public site, but this example will show you
        // anyways, is print out MySQL error related information -- you might log this
        echo "Error: Failed to make a MySQL connection, here is why: \n";
        echo "Errno: " . $mysqli->connect_errno . "\n";
        echo "Error: " . $mysqli->connect_error . "\n";

        // You might want to show them something nice, but we will simply exit
        exit;
    }
    $sql = "SELECT * FROM user 
    WHERE
    id = '" . $_POST['name'] . "'
    AND
    password = '" . sha1($_POST['password']) . "'";

    if (!$result = $mysqli->query($sql)) {
        echo "Sorry, the website is experiencing problems.";

        echo "Error: Our query failed to execute and here is why: \n";
        echo "Query: " . $sql . "\n";
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
        exit;
    }

    if ($result->num_rows === 0) {
        echo "We could not find a match for ID" . $_POST['name'] . "sorry about that. Please try again.";
        exit;
    }
    $user = $result->fetch_array(MYSQLI_ASSOC);
    $result->free();
    $mysqli->close();
    $_SESSION["id"] = $user['id'];
    $_SESSION["name"] = $user['name'];  
    header("Location: http://apps.marstanjx.com/");
    exit;
}

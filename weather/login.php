<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo '<h3>Sign in</h3>';
    echo '<form method="post" action="">
  Username: <input type="text" name="user_name" />
  Password: <input type="password" name="user_pass">
  <input type="submit" value="Sign in" />
  </form>';
} else {
    echo $_POST['user_name'];
    echo empty($_POST['user_name']);
    if (empty($_POST['user_name'])) {
        echo 'The username field must not be empty.';
        exit;
    }
    if (empty($_POST['user_pass'])) {
        echo 'The password field must not be empty.';
        exit;
    }
    $mysqli = new mysqli('127.0.0.1', 'root', 'Tjx,54321', 'squaretest');
    if ($mysqli->connect_errno) {
        // The connection failed. What do you want to do?
        // You could contact yourself (email?), log the error, show a nice page, etc.
        // You do not want to reveal sensitive information

        // Let's try this:
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
    id = '" . $_POST['user_name'] . "'
    AND
    password = '" . sha1($_POST['user_pass']) . "'";

    if (!$result = $mysqli->query($sql)) {
        echo "Sorry, the website is experiencing problems.";

        echo "Error: Our query failed to execute and here is why: \n";
        echo "Query: " . $sql . "\n";
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
        exit;
    }

    if ($result->num_rows === 0) {
        echo "We could not find a match for ID" . $_POST['user_name'] . "sorry about that. Please try again.";
        exit;
    }
    $user = $result->fetch_array(MYSQLI_ASSOC);
    echo $user;
    echo "<br>";
    foreach($user as $key => $value)
    {
        echo $key." has the value". $value;
        echo "<br>";
    }
    echo "Sometimes I see " . $user['name'] . " " . $user['email'] . " on TV.";
    $result->free();
    $mysqli->close();
    $_SESSION["id"] = $user['id'];
    $_SESSION["name"] = $user['name'];
}
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no">
    <title>Weather</title>
</head>
<body>
<h2>Temperature</h2>
<p>
    <?php
    $myfile = fopen("data.txt", "r") or die("Unable to open file!");
    $data = explode(",", fread($myfile,filesize("data.txt")));
    echo $data[0];
    ?>
</p>

<h2>Humidity</h2>
<p>
    <?php
    echo $data[1];
    ?></p>
</body>
</html>
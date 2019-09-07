<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Scale Picker | Mars Inc.</title>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-116224796-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'UA-116224796-1');

  </script>
</head>

<body>
  <div class="title ">
    <div class="container">
      <h1>Scale Picker</h1>
      <p>by Mars</p>
    </div>
  </div>
  <div class="container">
    <a class="nav-link active" href="http://apps.marstanjx.com/music/">New Pick</a>
    <div class="section">
      <?php
            function getRandomKey() {
                $a = rand(0,11);
                switch($a) {
                    case 0:
                        echo "C";
                        break;
                    case 1:
                        echo "#C";
                        break;
                    case 2:
                        echo "D";
                        break;
                    case 3:
                        echo "#D";
                        break;
                    case 4:
                        echo "E";
                        break;
                    case 5:
                        echo "F";
                        break;
                    case 6:
                        echo "#F";
                        break;
                    case 7:
                        echo "G";
                        break;
                    case 8:
                        echo "#G";
                        break;
                    case 9:
                        echo "A";
                        break;
                    case 10:
                        echo "#A";
                        break;
                    case 11:
                        echo "B";
                        break;
                }
            }
            function getRandomScale($ifMelodic) {
                $a = rand(0,11);
                $b = rand(0,1);
                if($ifMelodic) {
                    $b = rand(0,2);
                }
                switch($a) {
                    case 0:
                        switch($b) {
                            case 0:
                                echo "C Major";
                                break;
                            case 1:
                                echo "a Minor Harmonic";
                                break;
                            case 2:
                                echo "a Minor Melodic";
                                break;
                        }
                        break;
                    case 1:
                        switch($b) {
                            case 0:
                                echo "Db Major";
                                break;
                            case 1:
                                echo "bb Minor Harmonic";
                                break;
                            case 2:
                                echo "bb Minor Melodic";
                                break;
                        }
                        break;
                    case 2:
                        switch($b) {
                            case 0:
                                echo "D Major";
                                break;
                            case 1:
                                echo "b Minor Harmonic";
                                break;
                            case 2:
                                echo "b Minor Melodic";
                                break;
                        }
                        break;
                    case 3:
                        switch($b) {
                            case 0:
                                echo "Eb Major";
                                break;
                            case 1:
                                echo "c Minor Harmonic";
                                break;
                            case 2:
                                echo "c Minor Melodic";
                                break;
                        }
                        break;
                    case 4:
                        switch($b) {
                            case 0:
                                echo "E Major";
                                break;
                            case 1:
                                echo "c# Minor Harmonic";
                                break;
                            case 2:
                                echo "c# Minor Melodic";
                                break;
                        }
                        break;
                    case 5:
                        switch($b) {
                            case 0:
                                echo "F Major";
                                break;
                            case 1:
                                echo "d Minor Harmonic";
                                break;
                            case 2:
                                echo "d Minor Melodic";
                                break;
                        }
                        break;
                    case 6:
                        switch($b) {
                            case 0:
                                echo "F# Major";
                                break;
                            case 1:
                                echo "d# Minor Harmonic";
                                break;
                            case 2:
                                echo "d# Minor Melodic";
                                break;
                        }
                        break;
                    case 7:
                        switch($b) {
                            case 0:
                                echo "G Major";
                                break;
                            case 1:
                                echo "e Minor Harmonic";
                                break;
                            case 2:
                                echo "e Minor Melodic";
                                break;
                        }
                        break;
                    case 8:
                        switch($b) {
                            case 0:
                                echo "Ab Major";
                                break;
                            case 1:
                                echo "f Minor Harmonic";
                                break;
                            case 2:
                                echo "f Minor Melodic";
                                break;
                        }
                        break;
                    case 9:
                        switch($b) {
                            case 0:
                                echo "A Major";
                                break;
                            case 1:
                                echo "f# Minor Harmonic";
                                break;
                            case 2:
                                echo "f# Minor Melodic";
                                break;
                        }
                        break;
                    case 10:
                        switch($b) {
                            case 0:
                                echo "Bb Major";
                                break;
                            case 1:
                                echo "g Minor Harmonic";
                                break;
                            case 2:
                                echo "g Minor Melodic";
                                break;
                        }
                        break;
                    case 11:
                        switch($b) {
                            case 0:
                                echo "B Major";
                                break;
                            case 1:
                                echo "g# Minor Harmonic";
                                break;
                            case 2:
                                echo "g# Minor Melodic";
                                break;
                        }
                        break;
                }
            }
            function getRandomChromatic() {
                $a = rand(0,7);
                switch($a) {
                    case(0):
                        echo "<h2>Chromatic Scales in major thirds</h2>";
                        break;
                    case(1):
                        echo "<h2>Chromatic Scales in major sixth</h2>";
                        break;
                    case(2):
                        echo "<h2>Chromatic Scales in minor sixth</h2>";
                        break;
                    case(3):
                        echo "<h2>Chromatic Scales in perfect eighth</h2>";
                        break;
                    case(4):
                        echo "<h2>Chromatic perfect eighth in reversed direction</h2>";
                        break;
                    case(5):
                        echo "<h2>Chromatic Scales in major thirds in reversed direction</h2>";
                        break;
                    case(6):
                        echo "<h2>Chromatic Scales minor thirds in reversed direction</h2>";
                        break;
                    case(7):
                        echo "<h2>Chromatic Scales in minor thirds</h2>";
                        break;
                }
            }
            function getRandomPosition() {
                $a = rand(0,2);
                switch($a) {
                    case(0):
                        echo "at root position";
                        break;
                    case(1):
                        echo "at first inversion";
                        break;
                    case(2):
                        echo "at second inversion";
                        break;
                }
            }
            function getRandomPerform() {
                $a = rand(0,1);
                switch($a) {
                    case(0):
                        echo "legato";
                        break;
                    case(1):
                        echo "staccato";
                        break;
                }
            }
            $num = 3;
            echo "<h2>Scales</h2>";
            echo "<ul>";
            for($i = 0; $i < $num; $i++) {
                echo "<li>";
                getRandomScale(true);
                echo ", ";
                getRandomPerform();
                echo "</li>";
            }
            echo "</ul>";
            
            echo "<h2>Scales a third apart</h2>";
            echo "<ul>";
            for($i = 0; $i < $num; $i++) {
                echo "<li>";
                getRandomScale(false);
                echo ", ";
                getRandomPerform();
                echo "</li>";
            }
            echo "</ul>";
            echo "<h2>Scales a sixth apart</h2>";
            echo "<ul>";
            for($i = 0; $i < $num; $i++) {
                echo "<li>";
                getRandomScale(false);
                echo ", ";
                getRandomPerform();
                echo "</li>";
            }
            echo "</ul>";
            
            echo "<h2>Chord: Legato scales in thirds</h2>";
            
            echo "<h2>Chord: Chromatic Scales a minor third apart</h2>";
            
            getRandomChromatic();
            
            echo "<h2>Whole-tone scales</h2>";
            
            echo "<h2>Arpeggios</h2>";
            echo "<ul>";
            for($i = 0; $i < $num; $i++) {
                echo "<li>";
                getRandomScale(false);
                echo " ";
                getRandomPosition();
                echo "</li>";
            }
            echo "</ul>";
            
            echo "<h2>Dominant sevenths</h2>";
            echo "<ul>";
            for($i = 0; $i < $num; $i++) {
                echo "<li>";
                echo "Starting at ";
                getRandomKey();
                echo "</li>";
            }
            echo "</ul>";
            
            echo "<h2>Diminished sevenths</h2>";
            echo "<ul>";
            for($i = 0; $i < $num; $i++) {
                echo "<li>";
                echo "Starting at ";
                getRandomKey();
                echo "</li>";
            }
            echo "</ul>";
            
?>
    </div>
  </div>
  <style>
    .title {
      background-color: black;
      color: whitesmoke;
    }

    .card {
      text-align: center;
      margin: 0 auto;
    }

  </style>
  <?php
    $doc = new DOMDocument();
  $doc->loadHTMLFile("../menu.htm");
  echo $doc->saveHTML();
  ?>
</body>

</html>


<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
<link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.0.0-beta.3/dist/css/bootstrap-material-design.min.css" integrity="sha384-k5bjxeyx3S5yJJNRD1eKUMdgxuvfisWKku5dwHQq9Q/Lz6H8CyL89KF52ICpX4cL" crossorigin="anonymous">
<link rel="stylesheet" href="../css/header.css">
<link rel="stylesheet" href="../css/menu.css">

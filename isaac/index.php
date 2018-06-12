<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Isaac!</title>
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>

<body>
<div class="container">
  <h1>Achievement</h1>
  <div class="table">
    <table data-description="Achievements">
      <thead>
      <tr>
        <th width="8%" tabindex="0">Name</th>
        <th width="4%" tabindex="0">Image</th>
        <th width="21%" tabindex="0">Description</th>
        <th width="59%" tabindex="0">Unlock</th>
        <th width="4%" tabindex="0">In Game Secret Number</th>
      </tr>
      </thead>
      <tbody>
      <?php
      $table = new DOMDocument;
      $table->loadHTMLFile("table.htm");
      $books = $table->getElementsByTagName('tr');
      $data = simplexml_load_file("data.xml") or die("Error: Cannot create object");
      $list = array();
      foreach ($data->achievements->children() as $a) {
        $achieved = $a->achieved;
        if ($achieved == 1) {
          $list [] = $a->apiname;
        }
      }
      foreach ($books as $book) {
//        $i = 0;
//        foreach($book->childNodes as $test) {
//          echo $i . " " . $test->textContent . "<br>";
//          $i++;
//        }

        $b = $book->childNodes->item(8)->textContent;
//        echo $b . " ";
        foreach ($list as $index) {
          if($index == $b) {
//            echo $b . " ";
            $book->setAttribute("class", "completed");
          }
        }
//        echo "<p>" . $book->lastChild->textContent  . "</p>";
      }
      echo $table->saveHTML();
      ?>

      </tbody>
      <tfoot></tfoot>
    </table>
  </div>
</div>
</body>

</html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="index.css">

      
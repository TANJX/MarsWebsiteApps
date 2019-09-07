<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Isaac!</title>
  <link rel="stylesheet" href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css">
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
</head>

<body>
<div class="container">
  <h1>Achievement</h1>
  <div class="buttons">
    <button class="mdc-button mdc-button--raised ripple" id="hide">Hide Completed</button>
  </div>
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
      echo $table->saveHTML();
      ?>

      </tbody>
      <tfoot></tfoot>
    </table>
  </div>
</div>
<script>
    $('button').each(function () {
        mdc.ripple.MDCRipple.attachTo($(this)[0]);
    });

    let hide = false;

    $('#hide').click(function () {
        if (hide) {
            // show
            $('.completed').show();
            $(this).text('Hide Completed');
        } else {
            // hide
            $('.completed').hide();
            $(this).text('Show Completed');
        }
        hide = !hide;
    });

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            const items = JSON.parse(this.responseText).playerstats.achievements;
            let i;
            for (i = 0; i < items.length; i++) {
                if (items[i].achieved === 1) {
                    console.log(i);
                    $('tr td:last-child').filter(function () {
                        return $(this).text() === "" + items[i].apiname;
                    }).parent().addClass("completed");
                }
            }

        }
    };
    xmlhttp.open("GET", "http://api.steampowered.com/ISteamUserStats/GetPlayerAchievements/v0001/?appid=250900&key=D8DB5E8DD1E3B56147922516B7FAEC98&steamid=76561198166372435", true);
    xmlhttp.send();
</script>
</body>

</html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="index.css">

      
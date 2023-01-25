<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div id="mainDivForm">
      <form action="" method="get" class="form">
        <div class="formText textFormat ">
          <div>
            <label for="pageLink">Merci d'entrer votre lien RSS ci-dessous</label>
          </div>
          <div>
            <?php if(isset($_GET['pageLink'])) {
              $urlValue = $_GET['pageLink'];
            } else {
              $urlValue = '';
            }
            ?>
            <input type="text" name="pageLink" id="pageLink" class="textFormat" value=<?= $urlValue ?>>
          </div>
        </div>
        <div class="textFormat" id="numberChoice">
          <label for="articlesNumber">Nombre d'articles désirés : </label>
          <?php if(isset($_GET['articlesNumber'])) {
              $numberValue = $_GET['articlesNumber'];
            } else {
              $numberValue = 5;
            }
            ?>
          <input type="number" class="textFormat" id="articlesNumberInput" name="articlesNumber" min="5" max="100" step="5" value=<?= $numberValue  ?>>
        </div>
        <div class="formBtn">
          <input type="submit" value="C'est parti!" id="formBtn" class="textFormat">
        </div>
        <?php if (isset($_GET['pageLink']) && isset($_GET['articlesNumber'])) {
          $url = $_GET['pageLink'];
          $xml = file_get_contents($url);
          $xml = simplexml_load_string($xml);
          $numberOfArticlesWantedInteger = intval($_GET['articlesNumber']);
          $numberOfPages = count($xml->channel->item) / $numberOfArticlesWantedInteger;
          echo "<div id='pagesnumbers'>";
          for ($j = 1; $j < $numberOfPages; $j++) {
            echo "<div class='numberscards'>
            <input type='submit' value='$j' name='page' class='pagenumber'>
            </div>
            ";
          }
          echo "</div>";
        }
          ?>
      </form>
    </div>
    <div id="xmlFunctionDiv">
      <?php
        require_once('xmlfunction.php');
        if (isset($_GET['pageLink'])) {
            $url = $_GET['pageLink'];
            if ( isset($_GET['articlesNumber'])){
              $numberOfArticles = $_GET['articlesNumber'];
            } else {
              $numberOfArticles = 100;
            }
            if ( isset($_GET['page'])) {
          $page = $_GET['page'];
            } else {
              $page = 1;
            }
            xmlToPage($url, $numberOfArticles, $page);
          }
      ?>
    </div>
  </body>
</html>

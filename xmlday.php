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
      <!-- Form starts here -->
      <form action="" method="get" class="form">
        <div class="formText textFormat ">
          <div>
            <label for="pageLink">Merci d'entrer votre lien RSS ci-dessous</label>
          </div>
          <div>
            <!-- The code below makes that if you enter a link, the link stays in the link bar till you delete it. Needed to pass it in the url. -->
            <?php if(isset($_GET['pageLink'])) {
              $urlValue = $_GET['pageLink'];
            } else {
              $urlValue = '';
            }
            ?>
            <!-- end -->
            <input type="text" name="pageLink" id="pageLink" class="textFormat" required value=<?= $urlValue ?>>
          </div>
        </div>
        <!-- Default value for article number filter is 5, but if its more the code below get the number from url via GET and put it in the range input -->
        <div class="textFormat" id="numberChoice">
          <label for="articlesNumber">Nombre d'articles par page : </label>
          <?php if(isset($_GET['articlesNumber'])) {
              $numberValue = $_GET['articlesNumber'];
            } else {
              $numberValue = 5;
            }
            ?>
          <input type="number" class="textFormat" id="articlesNumberInput" name="articlesNumber" min="5" max="100" step="5" value=<?= $numberValue  ?>>
        </div>
        <!-- end -->
        <div class="formBtn">
          <input type="submit" value="C'est parti!" id="formBtn" class="textFormat">
        </div>
        <!-- This is the pages numbers buttons which are generated depending on how much articles per page there is -->
        <?php if (isset($_GET['pageLink']) && isset($_GET['articlesNumber'])) {
          $url = $_GET['pageLink'];
          preg_match_all('~[^https://www][.].+[$rss_full.xml]~', $url, $matches);
          if (!empty($matches[0])) {
            $xml = file_get_contents($url);
            $xml = simplexml_load_string($xml);
            // intval function is there to get the number from the articlesNumber string
            $numberOfArticlesWantedInteger = intval($_GET['articlesNumber']);

            // The numberOfPages variable is there to count how much page we need
            $numberOfPages = count($xml->channel->item) / $numberOfArticlesWantedInteger;
            // Then we use numberOfPages to stop the loop when generating the pages buttons
            echo "<div id='pagesnumbers'>";
            // In the for loop, we use two variables :
            // $i to put the right value in the URL which is the one we gonna pass in the function later when we click and submit the page
            // $k to DISPLAY the value inside the button since we are human and counting from page 1 and not 0
            for ($j = 0, $k = 1; $j < $numberOfPages; $j++, $k++) {
              echo "<div class='numberscards'>
              <button type='submit' value='$j' name='page' class='pagenumber'>$k</button>
              </div>
              ";
            }
            echo "</div>";
          }
        }
          ?>
        <!-- End of pages numbers buttons -->
      </form>
      <!-- End of form -->
    </div>
    <!-- The function div below is where all the articles are displayed -->
    <div id="xmlFunctionDiv">
      <?php
        require_once('xmlfunction.php');
        if (isset($_GET['pageLink']) && !empty($_GET['pageLink'])) {
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
    <!-- End of the function div -->
  </body>
</html>

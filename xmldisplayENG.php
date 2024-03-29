<!-- Disabling warning errors -->
<?php
error_reporting(E_ERROR | E_PARSE);
require_once('checks.php');
require_once('pagesfunction.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XML Articles</title>
    <!-- Font awesome script -->
    <script src="https://kit.fontawesome.com/c936acb2f9.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div id="navBar" class="textFormat">
      <div id="homeBtn">
        <a href="./xmldisplayENG.php">Homepage</a>
      </div>
      <div id="rightNav">
        <div id='modesBtnDiv'>
          <i class="fa-regular fa-moon" id='nightBtn'></i>
          <i class="fa-regular fa-sun" id='dayBtn'></i>
        </div>
        <div id='flags'>
          <div><a href="./xmldisplay.php"><img src="./images/French.png" alt="French flag"></a></div>
          <div><a href="./xmldisplayENG.php"><img src="./images/English.png" alt="English flag"></a></div>
        </div>
      </div>
    </div>
    <div id="documentBody">
      <div id="mainDivForm">
        <!-- Form starts here -->
        <form action="" method="get" class="form">
          <div class="formText textFormat ">
            <div>
              <label for="pageLink">Enter RSS link below</label>
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
              <input type="text" name="pageLink" id="pageLink" class="textFormat" value=<?= $urlValue ?>>
            </div>
          </div>
          <!-- Default value for article number filter is 5, but if its more the code below get the number from url via GET and put it in the range input -->
          <div class="textFormat" id="numberChoice">
            <label for="articlesNumber">Articles per page : </label>
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
            <input type="submit" value="Let's go" id="formBtn" class="textFormat">
          </div>
          <!-- This div is displaying all the fast link to some RSS flux -->
          <!-- This div is disapearing if a link is entered -->
          <?php $dayOrNight = linksCheck() ?>
          <?php if (empty($_GET['pageLink'])){ ?>
                  <div id="fastLinksDiv" class="textFormat">
                    <div id="fastLinksTitle"> No link ? Few suggestions ⬇️ 😉</div>
                    <div id="categoriesDiv">
                      <form action="" method="get" class="form">
                        <div class="fastLinkCategory">
                          <p class="categoryTitles">Sports</p>
                          <div class="categoryLinks">
                            <div><button type="submit" value="https://news.google.com/rss/search?q=eSports" name='pageLink' class="<?= linksCheck() ?> textFormat">E-sports</button></div>
                            <div><button type="submit" value="https://www.foxsports.com.au/content-feeds/nba/" name="pageLink" class="<?= linksCheck() ?> textFormat">Basket</div>
                            <div><button type="submit" value="https://www.lemonde.fr/en/football//rss_full.xml" name="pageLink" class="<?= linksCheck() ?> textFormat">Football</button></div>
                            <div><button type="submit" value="https://www.lemonde.fr/en/rugby/rss_full.xml" name="pageLink" class="<?= linksCheck() ?> textFormat">Rugby</button></div>
                            <div><button type="submit" value="https://news.google.com/rss/search?q=Tennis" name="pageLink" class="<?= linksCheck() ?> textFormat">Tennis</button></div>
                          </div>
                        </div>
                        <div class="fastLinkCategory">
                          <p class="categoryTitles">Economy</p>
                          <div class="categoryLinks">
                            <div><button type="submit" value="http://marginalrevolution.com/feed" name="pageLink" class="<?= linksCheck() ?> textFormat">Marginal Revolution</button></div>
                            <div><button type="submit" value="https://news.google.com/rss/search?q=Economy" name="pageLink" class="<?= linksCheck() ?> textFormat">Google news</button></div>
                            <div><button type="submit" value="https://www.lemonde.fr/en/economy/rss_full.xml" name="pageLink" class="<?= linksCheck() ?> textFormat">Le monde</button></div>
                          </div>
                        </div>
                        <div class="fastLinkCategory">
                          <p class="categoryTitles">Technology</p>
                          <div class="categoryLinks">
                            <div><button type="submit" value="https://techcrunch.com/feed/?guccounter=1&guce_referrer=aHR0cHM6Ly9ibG9nLmZlZWRzcG90LmNvbS8&guce_referrer_sig=AQAAAFiP_JUw9U1z-FbdwJpe4EVbEeDX1AyC6G16Nm0vFPoNdOQYtzCPHvwsKpjd18k1CsWIMopaIT9x1ZwsSpd2psu0mWRsxPq6HtbbP5Xy3-HNcjVeaiXhbuxdWtJotuOHIFQXPlP69o9Db8iBsGh5aEHgsJ3x48QwMX6v3N5SCNj2" name="pageLink" class="<?= linksCheck() ?> textFormat">TechCrunch</button></div>
                            <div><button type="submit" value="https://news.google.com/rss/search?q=Tech" name="pageLink" class="<?= linksCheck() ?> textFormat">Google news</button></div>
                            <div><button type="submit" value="https://mashable.com/feeds/rss/all" name="pageLink" class="<?= linksCheck() ?> textFormat">Mashable</button></div>
                            <div><button type="submit" value="https://www.wired.com/feed/rss" name="pageLink" class="<?= linksCheck() ?> textFormat">Wired</button></div>
                            </div>
                        </div>
                    </div>
                  </div>
          <?php }?>
          <!-- This is the pages numbers buttons which are generated depending on how much articles per page there is -->
          <?php if (isset($_GET['pageLink']) && isset($_GET['articlesNumber']) && !empty($_GET['pageLink'])) {
            $url = $_GET['pageLink'];
            pages($url);
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
          if (file_get_contents($url)) {
            xmlToPage($url, $numberOfArticles, $page);
          } else {
            // Invalid input error message
            echo "<div id='invalink' class='textFormat'> Invalid link ! Please enter a valid XML link </div>";
            echo "<div id='willDiv'><img src='./images/will-smith-crying-meme.jpeg' alt='Will Smith crying' id='willSmithCrying'><div>";
          }
        }
        ?>
      </div>
      <!-- End of the function div -->
    </div>
  </body>
  <!-- Footer -->
  <?php include('footer.php');?>
  <!-- Javascript balise for night mode -->
  <script src="script.js"></script>
</html>

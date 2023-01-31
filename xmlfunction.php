<?php
function xmlToPage($url, $numberOfArticles, $page)
{
    $xml = file_get_contents($url);
    $xml = simplexml_load_string($xml);
    // If page is page 1 or there is no page number we are generating articles from the first one, this is why $i starts at 0
    if ($page === 1 || !$_GET['page']) {
      $i = 0;
      foreach ($xml->channel->item as $news) {
        // Everytime an article is generated we increment $i
        $i++;
        // Getting the article image
        $content = $news->children('media', true)->content;
        $contentattr = $content->attributes();
        if (isset($contentattr)) {
          $image = $contentattr["url"];
        }
        // Then generating the article
        echo "<a href='$news->link'>";
        echo "<div id='card'>";
        if (isset($image)) {
          echo "<div><img src='$image'/></div>";
        }
        echo "<div id='cardRightSide'>";
        echo "<div id='title'>$news->title</div>";
        echo "<div>$news->description</div>";
        echo "</div></div>";
        echo "</a>";
        // The foreach loop will break if it reaches the number of articles we asked
        if ($i >= $numberOfArticles) {
          break;
        }
      }
      echo "<a href='#top'><div id='backToTopDiv'><button id='backToTopBtn' class='textFormat'> Haut de page </button></div></a>";
    } else {
      // $j is the start of our loop
      // $i will be the index to know when we need to start displaying articles that's why it gets the $_GET['articlesNumber'],
      // To know how many articles we did display in the previous page
      $j = 0;
      $i = $numberOfArticles * $page + 1;
      foreach ($xml->channel->item as $news) {
        // We increment $j every time we go through one element in the array but we are not displaying them
        $j++;
        $content = $news->children('media', true)->content;
        $contentattr = $content->attributes();
        // We start displaying the articles when $j reached $i which is the indicator of the last article from the previous page
        if ( $j >= $i ) {
          if (isset($contentattr)) {
            $image = $contentattr["url"];
          }
          echo " <a href='$news->link'>";
          echo "<div id='card'>";
          if (isset($image)) {
            echo "<div><img src='$image'/></div>";
          }
          echo "<div id='cardRightSide'>";
          echo "<div id='title'>$news->title</div>";
          echo "<div>$news->description</div>";
          echo "</div></div>";
          echo "</a>";
          // If $j reach the maximum number of article for 1 page then the loop breaks
          if ( $j > $numberOfArticles * $page + $numberOfArticles - 1 ) {
            break;
          }
        }
      }
      echo "<a href='#top'>";
      echo "<div id='backToTopDiv'><button id='backToTopBtn' class='textFormat'> Haut de page </button></div>";
      echo "</a>";
    }
  }
?>

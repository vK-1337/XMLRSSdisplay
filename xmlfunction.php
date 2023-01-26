<?php
function xmlToPage($url, $numberOfArticles, $page)
{
  $xml = file_get_contents($url);
  $xml = simplexml_load_string($xml);
  if ($page === 1 || !$_GET['page']) {
    $i = 0;
    foreach ($xml->channel->item as $news) {
      $i++;
      $content = $news->children('media', true)->content;
      $contentattr = $content->attributes();
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
      if ($i >= $numberOfArticles) {
        break;
      }
    }
  } else {
    $j = 0;
    $i = $numberOfArticles * $page + 1;
    foreach ($xml->channel->item as $news) {
      $j++;
      $content = $news->children('media', true)->content;
      $contentattr = $content->attributes();
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
        if ( $j > $numberOfArticles * $page + $numberOfArticles - 1 ) {
          break;
        }
      }
    }
  }
}
?>

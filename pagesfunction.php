<?php
function pages($url) {
  $activePage = intval($_GET['page'] + 1);
  if (file_get_contents($url)) {
    $xml = file_get_contents($url);
    $xml = simplexml_load_string($xml);
    // intval function is there to get the number from the articlesNumber string
    $numberOfArticlesWantedInteger = intval($_GET['articlesNumber']);
    // The numberOfPages variable is there to count how much page we need
    $numberOfPages = count($xml->channel->item) / $numberOfArticlesWantedInteger;
    // Then we use numberOfPages to stop the loop when generating the pages buttons
    echo "<div id='pagesnumbers'>";
    if ( $activePage >= 0 && $activePage < 9) {
      echo "<p class='textFormat'> Pages :</p>";
      // In the for loop, we use two variables :
      // $i to put the right value in the URL which is the one we gonna pass in the function later when we click and submit the page
      // $k to DISPLAY the value inside the button since we are human and counting from page 1 and not 0
      for ($j = 0, $k = 1; $j < $numberOfPages; $j++, $k++) {
        echo "<div class='numberscards'>";
        // If this is the active page it will echo the div with black background
        if ($j == $_GET['page']) {
          echo "<button type='submit' value='$j' name='page' class='pagenumber active textFormat'>$k</button>";
        } else {
          echo "<button type='submit' value='$j' name='page' class='pagenumber textFormat'>$k</button>";
        }
        echo "</div>";
      }
    } else if ( $numberOfPages > 8 && $activePage > 8 ) {
      echo "<div class='numberscards'>";
      echo " <span class='textFormat'> Pages :</span>";
      for ( $i = 0, $j = $activePage, $k = 1, $l = 2; $i < $numberOfPages ; $i++, $k++, $l++) {
        if ( $k === 3 ) {
            echo "<span class='textFormat'> ... </span>";
        }
        if ( $k < 3 ) {
          if ( $k === $activePage ) {
            echo "<button type='submit' value='$i' name='page' class='pagenumber active textFormat'>$k</button>";
          } else {
            echo "<button type='submit' value='$i' name='page' class='pagenumber textFormat'>$k</button>";
          }
        } else if ( $k === $activePage ) {
          $before = $i - 1;
          echo "<button type='submit' value='$before' name='page' class='pagenumber textFormat'>$i</button>";
          echo "<button type='submit' value='$i' name='page' class='pagenumber active textFormat'>$k</button>";
          if ( $k < $numberOfPages ) {
            echo "<button type='submit' value='$k' name='page' class='pagenumber textFormat'> $l </button>";
          }
        }
      }
        echo "</div>";
      }
      echo "</div>";
  }
}
?>

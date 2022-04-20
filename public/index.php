<?php
// William Kenny
// main php page
// REFERENCES www.tutoralrepublic.com and stackoverflow.com.
// Initialize the session
session_start();
 
// Check if the user is logged in
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
require_once 'Dao.php';
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="styl.css">
  <link rel="icon" type="image/gif" href="/images/fav.gif">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <link href="http://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet" type="text/css">
  
  <script>
$().ready(function() {
  
  $("input").click(function(e){
    
    var options = {};
    var rowId = $(this).attr("data-id");
    var $row = $("#"+rowId);
    $row.fadeOut(500,function() {
        $row.fadeIn('slow');
    });
  });
});
</script>
</head>
<body>



  <div class="header">
    <img src="/images/ob.png" alt="ob" />
   
  </div>

  <?php
      if(isset($_POST['button10'])) {
        header("location: logout.php");
      }
      if(isset($_POST['button11'])) {
        header("location: reset-password.php");
      }
      ?>

  <div class="login">
 
  <input class="button4" type="submit" name="button10"
                value="Logout"/>
  <input class="button3" type="submit" name="button10"
                value="Reset Your Password"/>
  </div>

  


  <button class="tablink" onclick="openPage('Home', this, 'red')">Home</button>
  <button class="tablink" onclick="openPage('Coins', this, 'green')" id="defaultOpen">Coins</button>
  <button class="tablink" onclick="openPage('Favorites', this, 'blue')">Favorites</button>


  <div id="Home" class="tabcontent">
  <?php
$cart = array();
$JSON = file_get_contents("https://api.twelvedata.com/rsi?symbol=ETH,LINK,LTC,SOL&interval=1min&outputsize=1&apikey=63372193515c42b4a3cc451896727bdb");

$jsonIterator = new RecursiveIteratorIterator(
    new RecursiveArrayIterator(json_decode($JSON, TRUE)),
    RecursiveIteratorIterator::SELF_FIRST);

foreach ($jsonIterator as $key => $val) {
    if ($key == "rsi") {
        $cart[] = $val;
    }
    
}
$eth =  $cart[0];
$Clink =  $cart[1];
$ltc =  $cart[2];
$sol =  $cart[3];
?>
<div class=t1>
    <?php 
if ($cart[0] > 50 || $cart[1] > 50 || $cart[2] > 50 || $cart[3] > 50){
    echo "<table class=\"table1\">";
    echo "<tr>
    <th>OVERBOUGHT</th>
  </tr>";
if ($eth > 50) {
  echo "<tr>
  <td>Ethereum (ETH)</td>
</tr>";

}
if ($Clink > 50) {
  echo "<tr>
  <td>Chainlink (LINK)</td>
</tr>";

}
if ($ltc > 50) {
  echo "<tr>
  <td>Litecoin (LTC)</td>
</tr>";

}
if ($sol > 50) {
  echo "<tr>
  <td>Solana (SOL)</td>
</tr>";

}
echo "</table>";
} else {
    echo "<table class=\"table1\">";
    echo "<tr>
    <th>NO OVERBOUGHT COINS</th>
  </tr>";
 
echo "</table>";
}
?>
</div>
<div class=t2>
<?php
if ($cart[0] < 50 || $cart[1] < 50 || $cart[2] < 50 || $cart[3] < 50){
    echo "<table class=\"table2\">";
    echo "<tr>
    <th>OVERSOLD</th>
  </tr>";
if ($eth < 50) {
  echo "<tr>
  <td>Ethereum (ETH)</td>
</tr>";

}
if ($Clink < 50) {
  echo "<tr>
  <td>Chainlink (LINK)</td>
</tr>";

}
if ($ltc < 50) {
  echo "<tr>
  <td>Litecoin (LTC)</td>
</tr>";

}
if ($sol < 50) {
  echo "<tr>
  <td>Solana (SOL)</td>
</tr>";

}
echo "</table>";
} else {
    echo "<table class=\"table2\">";
    echo "<tr>
    <th>NO OVERSOLD COINS</th>
  </tr>";
 
echo "</table>";
}
?>
</div>


  </div>
  
  <div id="Coins" class="tabcontent">
  

  <?php
      if(isset($_POST['button1'])) {
        $ether = "Ethereum (ETH)";
        $dao = new Dao();
     $dao->addFav($_SESSION['username'], $ether);
      }
      if(isset($_POST['button2'])) {
        $chain = "Chainlink (LINK)";
        $dao = new Dao();
     $dao->addFav($_SESSION['username'], $chain);
      }
      if(isset($_POST['button3'])) {
        $lite = "Litecoin (LTC)";
        $dao = new Dao();
     $dao->addFav($_SESSION['username'], $lite);
      }
      if(isset($_POST['button4'])) {
        $lana = "Solana (SOL)";
        $dao = new Dao();
     $dao->addFav($_SESSION['username'], $lana);
      }
      // remove buttons
      if(isset($_POST['button5'])) {
        $ether = "Ethereum (ETH)";
        $dao = new Dao();
     $dao->removeFav($_SESSION['username'], $ether);
      }
      if(isset($_POST['button6'])) {
        $chain = "Chainlink (LINK)";
        $dao = new Dao();
     $dao->removeFav($_SESSION['username'], $chain);
      }
      if(isset($_POST['button7'])) {
        $lite = "Litecoin (LTC)";
        $dao = new Dao();
     $dao->removeFav($_SESSION['username'], $lite);
      }
      if(isset($_POST['button8'])) {
        $lana = "Solana (SOL)";
        $dao = new Dao();
     $dao->removeFav($_SESSION['username'], $lana);
      }
  ?>
  
  <form method="post">
  <table class="table4">
      <tr>
        <th>COINS</th>
      </tr>
      <tr>
        <td>Ethereum (ETH)</td>

          <td id="row1">
        <input class="button1" type="submit" data-id="row1" name="button1"
                value="Add to Favorites"/> 
        </td>
        <td id="row2">
        <input class="button2" type="submit" data-id="row2" name="button5"
                value="Remove from Favorites"/> 
        </td>
      </tr>
      <tr>
        <td>Chainlink (LINK)</td>
        <td id="row3">
        <input class="button1" type="submit" data-id="row3" name="button2"
                value="Add to Favorites"/>
          
        </td>
        <td id="row4">
        <input class="button2" type="submit" data-id="row4" name="button6"
                value="Remove from Favorites"/> 
        </td>
      
      </tr>
      <tr>
        <td>Litecoin (LTC)</td>
        <td id="row5">
        <input class="button1" type="submit" data-id="row5" name="button3"
                value="Add to Favorites"/>
          
        </td>
        <td id="row6">
        <input class="button2" type="submit" data-id="row6" name="button7"
                value="Remove from Favorites"/> 
        </td>
      
      </tr>
      <tr>
        <td>Solana (SOL)</td>
        <td id="row7">
        <input class="button1" type="submit" data-id="row7" name="button4"
                value="Add to Favorites"/>
          
        </td>
        <td id="row8">
        <input class="button2" type="submit" data-id="row8" name="button8"
                value="Remove from Favorites"/> 
        </td>
      
      </tr>
    </table>
        
    </form>
  </div>
  
  <div id="Favorites" class="tabcontent">

  <?php
      

    $dao = new Dao();
    if (empty($dao->getFav($_SESSION['username']))) {
        echo "<table class=table5>";
          echo "<tr>";
          echo "<td>" . "No Favorites selected" . "</td>";
          echo "</tr>";
        echo "</table>";
    } else {
        $favor = $dao->getFav($_SESSION['username']);

        foreach ($favor as $rows) {
          $newf[] = $rows['fav_coin'];
        }
        echo "<table class=table5>";
        if (in_array("Ethereum (ETH)", $newf)) {
          echo "<tr>";
          echo "<td>" . "Ethereum (ETH)" . "</td>";
          echo "</tr>";
          }
         if (in_array("Chainlink (LINK)", $newf)) {
          echo "<tr>";
          echo "<td>" . "Chainlink (LINK)" . "</td>";
          echo "</tr>";
          }
         if (in_array("Litecoin (LTC)", $newf)) {
          echo "<tr>";
          echo "<td>" . "Litecoin (LTC)" . "</td>";
          echo "</tr>";
          }
         if (in_array("Solana (SOL)", $newf)) {
          echo "<tr>";
          echo "<td>" . "Solana (SOL)" . "</td>";
          echo "</tr>";
          }
          echo "</table>";
    }
    ?>
      </div>
  
  
  <script>
  function openPage(pageName,elmnt,color) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].style.backgroundColor = "";
    }
    document.getElementById(pageName).style.display = "block";
    elmnt.style.backgroundColor = color;
  }
  
  // Get the element with id="defaultOpen" and click on it
  document.getElementById("defaultOpen").click();
  </script>
     
</body>
<footer>
  <p>Author: William Kenny</p>
</footer>
</html>

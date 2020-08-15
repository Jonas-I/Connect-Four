<?php
session_start();
?>
<div class="nav-wrapper">
    <div class="container-fullwidth">
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #272522;">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="home.html">Connect Four</a>
          
            <div class="collapse navbar-collapse">
              <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <!-- <li class="nav-item dropdown">
                  <a class="nav-link dropdown" href="#" data-toggle="dropdown">Play Game</a>
                  <div class="dropdown-menu" style="background-color: #272522;">
                    <a class="dropdown-item text-light" style="background-color: #272522;" href="player.html">Player vs Player</a>
                    <a class="dropdown-item disabled" style="background-color: #272522; color: gray;" href="computer.html" role="button" aria-disabled="true">Player vs Computer</a>
                  </div>
                </li> -->
                <li class="nav-item"><a class="nav-link" href="player.php">Play Game</a></li>
                <li class="nav-item"><a class="nav-link" href="howtoplay.html">How to Play</a></li>
                <li class="nav-item"><a class="nav-link" href="matchhistory.php">Match History</a></li>
                <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
                <!-- <li class="nav-item"><a class="nav-link" href="contact.html">Contact Us</a></li> -->
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown" href="#" data-toggle="dropdown">More Games</a>
                  <div class="dropdown-menu" style="background-color: #272522;">
                    <a class="dropdown-item text-light text-center" style="background-color: #272522;" href="https://www.mathsisfun.com/games/connect4.html" target="_blank"><img src="Images/C4-1.png" style="width:50px; margin: 10px"></a>
                    <a class="dropdown-item text-light text-center" style="background-color: #272522;" href="https://www.silvergames.com/en/connect-4" target="_blank"><img src="Images/C4-3.png" style="width:200px; margin: 10px"></a>
                    <a class="dropdown-item text-light text-center" style="background-color: #272522;" href="https://poki.com/en/g/connect-4" target="_blank"><img src="Images/C4-2.png" style="width:75px; margin: 10px"></a>
                  </div>
                </li>
              </ul>

              <ul class="navbar-nav ml-auto">
                <?php
                    if (!isset($_SESSION['email'])) {
                      // Not logged in
                      echo '<li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>';
                    } else {
                        echo '<li class="nav-item"><a class="nav-link" href="logout.php">Logout of ' . $_SESSION['email'] . '</a></li>';
                    }
                ?>
                <!-- <li class="nav-item"><a class="nav-link" href="login.php"></a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li> -->

              </ul>
            </div>
          </nav>
    </div>
</div>
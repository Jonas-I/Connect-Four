<?php
    session_start();
    // UPON CLICKING THE BUTTON, SAVE MATCH ID
    if (isset($_POST['matchID'])) {
        // If the button to submit was clicked, pass in the matchID.
        $_SESSION['matchID'] = $_POST['matchID'];
        echo $_SESSION['matchID'];
        header('Location: https://venus.cs.qc.cuny.edu/~imjo9615/CS355/player.php?id='.$_SESSION['matchID']);

    }



	$DBserver = "";
    $DBusername = "";
    $DBpassword = "";
    $DB = "";

	$conn = new mysqli($DBserver, $DBusername, $DBpassword, $DB);
	if ($conn->connection_error) { die("Failed to Connect: " . $conn->connection_error); }
    $value = $_SESSION['actID'];
	$query = "SELECT * FROM CFMatch WHERE actID = $value;";

	$result = mysqli_query($conn, $query);

	// while ($row = mysqli_fetch_assoc($result)) {
    //     $matchId = $row['matchID'];
    //     $matchDate = $row['matchDate'];
    //     $startingPlayer = $row['startingPlayer'];
    //     $player0moves = $row['player0moves'];
    //     $player1moves = $row['player1moves'];
    // }

	// mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>I/O Match History</title>
    <link rel="stylesheet" href="bs/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="bs/js/bootstrap.min.js"></script>

</head>
<body style="background-color: #312E2B; color: white">
    <div id="navbar-bs">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">Match History</h1>
                <h5 class="text-center" style="margin-bottom: 20px;">View your past games below:</h5>
                <div id="matchhistory">
                    <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            $matchID = $row['matchID'];
                            $matchDate = $row['matchDate'];
                            $startingPlayer = $row['startingPlayer'];
                            $player0moves = $row['player0moves'];
                            $player1moves = $row['player1moves'];
                            // UPON CLICKING, GET THE MATCH ID
                            echo '<form method="post" action="matchhistory.php">';
                            echo '<input type="submit" class="text-center matchhistory-elem btn btn-secondary btn-lg btn-block" style="background-color: #272522; border-color: #22201E; border-radius: 20px; margin-bottom: 20px;" value="'.$matchDate.'">';
                            echo '<input type="hidden" name="matchID" value="'.$matchID.'">';
                            echo '</form>';
                        }
                    
                        mysqli_close($conn);
                    ?>
                </div>
            </div>
        </div>
    </div>


    <div id="footer" class="footer-wrapper"></div>
</body>
<script src="navbar_footer.js"></script>
<script src="playervsplayer-script.js"></script>

<script>
    // I want there to be cards in the center per match.
    // Date is what shows in the center.
    // Clicking it will go to the player.html and loadgameinformation(), implementgame()
 
    // loadMatchHistory();
    // $(function() {
    //     $('.matchhistory-elem').on('click', function(event) {
    //         var clickedId = $(this).attr('id');
    //         console.log(clickedId);
    //         localStorage.setItem('id', clickedId)
    //     })
    // });

    // function loadMatchHistory() {
    //     const match = JSON.parse(localStorage.getItem("match"));
    //     console.log(match);
    //     for (i = match.length-1; i >= 0; i--) {
    //         var date = match[i].match_date;
    //         // Create a button to hold it
    //         document.getElementById("matchhistory").innerHTML += ('<button class="text-center matchhistory-elem btn btn-secondary btn-lg btn-block" style="background-color: #272522; border-color: #22201E; border-radius: 20px; margin-bottom: 20px;" id="matchhistory-' + i + '">'+date+'</button>');
    //     }
    //     for (i = match.length-1; i >= 0; i--) {
    //         document.getElementById("matchhistory-"+i).addEventListener("click", function() {
    //             window.location.assign('player.php');
    //         });
    //     }
    // }

    
    
</script>
</html>
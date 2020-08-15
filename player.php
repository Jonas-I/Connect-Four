<?php
    session_start();
    $DBserver = "";
    $DBusername = "";
    $DBpassword = "";
    $DB = "";

    $conn = new mysqli($DBserver, $DBusername, $DBpassword, $DB);
    if ($conn->connection_error) {
        die("Failed to Connect: " . $conn->connection_error);
    }

    // If there exists a match ID:
    if (isset($_SESSION['matchID'])) {
        // Do a query to get the STARTING PLAYER, plyr0moves, and plyr1 moves.
        $matchVal = $_SESSION['matchID'];
        $query = "SELECT * FROM CFMatch WHERE matchID = $matchVal;";
    
        $result = mysqli_query($conn, $query);
    
        $row = mysqli_fetch_assoc($result);
        $startingPlayer = $row['startingPlayer'];
        $player0moves = $row['player0Moves'];
        $player1moves = $row['player1Moves'];
        // echo '<script>implementMoves('.$startingPlayer.', ' . $player0moves . ', ' . $player1moves . ');</script>';
        // echo $_SESSION['matchID'] . '<br>';
        // echo json_encode($player0moves, true) . '<br>';
        // echo $player0moves;
        echo '<script>var p0 = JSON.parse('. json_encode($player0moves, true) . ');</script>';
        echo '<script>var p1 = JSON.parse('. json_encode($player1moves, true) . ');</script>';
        // echo '<script>var p0 = $player0moves;</script>';
        // echo '<script>var p1 = $player1moves;</script>';
        echo '<script>console.log("THIS IS ECHOED: " + p0);</script>';
    }

    if (isset($_POST['saveBtn'])) {
        // echo $_POST['saveInfo'];
        $_SESSION['saveInfo'] = $_POST['saveInfo'];
        // $temp = "<script>console.log('Hello World' + document.getElementById('saveInfo').value);</script>";
        // echo $temp; 
        // UPON SUBMIT, make it save the MATCH.

        // echo "successfully connected";
        if (isset($_SESSION['email'])) {
            // I want to get the variable of RECORD and use it in PHP
            // If there is a current session: Attempt creation of record
            $json = $_SESSION['saveInfo'];
            $match = json_decode($json, true);

            $dte = $match['match_date'];
            $strPlyr = $match['starting_player'];
            $plyr0 = json_encode($match['player0_moves'], true);
            $plyr1 = json_encode($match['player1_moves'], true);

            // echo $plyr0;
            // $encodedPlyr0 = json_encode($plyr0, true);
            // echo $encodedPlyr0;
            $accountID = $_SESSION['actID'];
            $insert_match = "INSERT INTO CFMatch (actID, startingPlayer, player0Moves, player1Moves) 
                VALUES ('$accountID', '$strPlyr', '$plyr0', '$plyr1');";

            // $result = mysqli_query($conn, $insert_match);
            if ($conn->query($insert_match) == TRUE) {
                echo "<script>alert('Match created successfully. Access the game in your Match History.');</script>";
                $last_id = $conn->insert_id;
                $_SESSION['matchID'] = $last_id;
                echo '<script>location = "https://venus.cs.qc.cuny.edu/~imjo9615/CS355/player.php"</script>';
            } else {
                echo "<script>alert('Error in saving match');</script>";
            }
        } else {
            // If no session, then go to LOGIN.
            echo '<script>alert("Create an account or sign in to save the game.");</script>';
            echo '<script>location = "https://venus.cs.qc.cuny.edu/~imjo9615/CS355/login.php"</script>';

        }
    } else {
        // echo "This is ACT ID: " . $_SESSION['actID'];// . $_SESSION['actID'];
    }
    mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>I/O Player vs. Player</title>
    <link rel="stylesheet" href="styles-board.css">
    <link rel="stylesheet" href="bs/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="bs/js/bootstrap.min.js"></script>    
</head>

<body style="background-color: #312E2B; color: white">
    <div id="navbar-bs">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-9">
                <h1 class="text-center" style="margin-bottom: 20px; margin-left: 50px;">Connect Four</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-9">
                <div class="content-wrapper">
                    <div id="board"></div>
                </div>
            </div>
            <div class="col-3 my-auto">
                <div class="content-wrapper">
                    <div id="playerturn" class="text-center"></div>
                    <form id="savingInformation" action="player.php" method="POST">
                        <div id="savegamebtn" class="text-center" style="margin-bottom:10px;"><input type="submit" name="saveBtn" id="saveBtn" class="text-center matchhistory-elem btn btn-secondary btn-lg" style="margin-bottom:10px; width: 300px; background-color: #272522; border-color: #22201E; border-radius: 20px;" value="Save Game"></div>
                        <input type="hidden" id="saveInfo" name="saveInfo" value="asd">
                        <!-- <div id="bg-info"></div> -->
                    </form>
                    <div id="newgamebtn" class="text-center" style="margin-bottom:100px; margin-top:10px;"><button onclick="newGame()" class="text-center matchhistory-elem btn btn-primary btn-lg" style="width: 300px; border-radius: 20px;">New Game</button></div>
                    <button id="savetoFileBtn" onclick="saveToFile()" class="text-center matchhistory-elem btn btn-secondary btn-lg" style="margin-bottom:10px; margin-top:10px; width: 300px; background-color: #272522; border-color: #22201E; border-radius: 20px;">Save Game to File</button>
                    <label for="uploadFile">
                        <span class="text-center matchhistory-elem btn btn-primary btn-lg" style="margin-bottom:10px; margin-top:10px; width: 300px; border-radius: 20px;">Upload Game from File</span>
                        <input type="file" id="uploadFile" onchange="uploadFile()" style="display: none;">
                    </label>
                </div>
            </div>
        </div>   
    </div>

    <div id="footer" class="footer-wrapper"></div>
</body>
<script src="navbar_footer.js"></script>
<script src="pvp-script-session.js"></script>
<script src="FileSaver.js"></script>

<?php 
    if (!isset($_SESSION['matchID'])) {
        // new game
        echo '<script>newGame();</script>';
    }
?>
<?php echo '<script>implementMoves('.$startingPlayer.', p0, p1);</script>'; ?>

<script>
    $('#savingInformation').submit(function() {
        // First populate, then you want to save 
        savegame();
        console.log(document.getElementById("saveInfo").value);
        return true;
    });

    // Record movements
    function recordMoves() {
        var date;
        var dte = new Date();
        var m = dte.getMonth() + 1;
        var d = dte.getDate();
        var y = dte.getFullYear();
        var h = dte.getHours();
        var min = dte.getMinutes();
        var mil = dte.getMilliseconds();
        date = m + "-" + d + "-" + y + " " + h + ":" + min + ":" + mil;
        var match = {
            match_date: date,
            starting_player: this.startingPlayer,
            player0_moves: this.player0moves,
            player1_moves: this.player1moves
        };
        return match;  
    }

    function savegame() {
        console.log("Saving Game");
        var record = JSON.stringify(recordMoves());
        var saveM = document.getElementById("saveInfo").value = record;
        return record;
    // const match = JSON.parse(localStorage.getItem("match")) || [];
    // console.log(match);
    // var record = recordMoves();
    // match.push(record);
    // console.log(record);

    // localStorage.setItem("match", JSON.stringify(match));
    // alert('Game Saved! Access your game in the Match History.');    
    // When saving game, push this information to a new link.
    }
    function saveToFile() {
        var data = recordMoves();
        var fileName = "connect_four_game.json";

        var fileToSave = new Blob([JSON.stringify(data)], {
            type: 'application/json',
            name: fileName
        });

        saveAs(fileToSave, fileName);
    }

    function uploadFile() {
        var doc = document.getElementById("uploadFile").files[0];
        console.log(doc.name);
        var reader = new FileReader();
        reader.readAsText(doc);
        reader.onload = function(evt) {
            var data = evt.target.result;
            console.log("DATA: " + data);
            var matchJSON = JSON.parse(data);
            var startPlayer = matchJSON.starting_player;
            var player0 = matchJSON.player0_moves;
            var player1 = matchJSON.player1_moves;

            newGame();
            implementMoves(startPlayer, player0, player1);
        };
    }
</script>
</html>
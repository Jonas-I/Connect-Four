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
            <div class="col-12">
                <h1 class="text-center">Player vs. Player</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="content-wrapper">
                    <div id="board">
            
                    </div>
                    <div id="playerturn">
                        
                    </div>
                    <div id="newgamebtn">
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div id="footer" class="footer-wrapper"></div>
</body>
<script src="navbar_footer.js"></script>
<script src="playervsplayer-script.js"></script>

<?php

    // $mh = file_get_contents("match-history.json");
    // $array = json_decode($mh, true);
    

    // $matches = $_POST['match'];
    // $matchhistory = file_get_contents('match-history.json');
    // $decodedMH = json_decode($matchhistory);
    // $appendingData = array('startingPlayer'=>3);
    // array_push($decodedMH->match, $appendingData);
    // $appendingMH = json_encode($decodedMH);
    // file_put_contents('match-history.json', $appendingMH);
    
?>
<script>
    // var itemsJson = <?php //echo $matchhistory; ?>;
    // console.info(typeof itemsJson);
    // console.log(itemsJson.match[0].player0moves[0]);
    // console.log(itemsJson.match[0].sizeof);

    // var stack1 = new Array();
    

    
    // function getMostRecentGame() {

    // }
</script>

</html>


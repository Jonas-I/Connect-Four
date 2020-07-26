// Default INPUT value = 7
// PLAYER 0 = RED
// PLAYER 1 = BLUE
var INPUT = 7;
var player = 0;
var startingPlayer = 0;
var color0 = "red";
var color1 = "blue";
var color3 = "white";

var stack_1 = new Array();
var stack_2 = new Array();
var stack_3 = new Array();
var stack_4 = new Array();
var stack_5 = new Array();
var stack_6 = new Array();
var stack_0 = new Array();

var player0moves = new Array();
var player1moves = new Array();
createBoard(INPUT);
displayCell();


// Provided an input, create a NxN grid. (Default grid for Connect Four is 7)
function createBoard(input) {
    var board = '<table>'
    var index = 0;
    for (r = 1; r <= input; r++) {
        board += '<tr>'
        for (c = 1; c <= input; c++) {
            index++;
            board += '<td class="circle" id="circle-' + index + '"></td>';
        }
        board += '</tr>';
    }
    board += '</table>';
    
    document.getElementById("board").innerHTML = board;
    
    let circleCells = document.querySelectorAll(".circle");
    circleCells.forEach(function(elem) {
        var id = elem.id;
        document.getElementById(id).style.backgroundColor = "white";
    });

    var color = player == 0 ? color0 : color1;
    document.getElementById("playerturn").innerHTML = "Player " + color + "'s turn.";
    console.log(startingPlayer + "'s turn");
}

// Show what cells will be colored.
// Clicking on a certain cell will provide its corresponding COLUMN.
function displayCell() {
    let circleCells = document.querySelectorAll(".circle");
    circleCells.forEach(function(elem) {
        elem.addEventListener("click", function() {
            var str = elem.id;
            var num = str.substring(7);
            // console.log(num);
            var row = num/7; // Not used
            var col = num%7;
            var stack = getStack(num%7);
            if (stack.length < 7) {
                if (player == 0) {
                    player0moves.push(col);
                } else {
                    player1moves.push(col);
                }
                updateStack(stack, col, player);
                player = (player+1)%2;
                var color = player == 0 ? color0 : color1;
                document.getElementById("playerturn").innerHTML = "Player " + color + "'s turn." ;
                validate();
                checkTie();
            }
            // NOTE: Column-1 = 1, Column-7 = 0 (Due to modular)
        });
    });
}

// Get the corresponding stack
function getStack(num) {
    return window["stack_"+ num];
}

// Update the stack by adding the corresponding ROW.
// Calculate what corresponding CELL will be colored, given the COLUMN and ROW.
function updateStack(stack, col, player) {
    var len = stack.length;
    // If there is currently nothing in the stack (no circle on a corresponding COLUMN)
    if (len == 0) {
        stack.push(INPUT);
        var nxtRow = stack[0];
        if (col == 0) column = 7;
        else column = col;
        var cellNum = ((nxtRow*INPUT)-INPUT)+column;
        // console.log("(FIRST) ROW: " + nxtRow + " COL: " + column + " CELLNUM: " + cellNum); 
        if (player == 0) {
            document.getElementById("circle-" + cellNum).style.backgroundColor = color0;
        } else {
            document.getElementById("circle-" + cellNum).style.backgroundColor = color1;
        }
    } 
    // When there is already something in the stack (1 or more circles in a corresponding COLUMN)
    else {
        var temp = stack[len-1];
        if (temp > 1) { 
            stack.push(temp-1);
            var nxtRow = stack[len];
            if (col == 0) column = 7;
            else column = col;
            var cellNum = ((nxtRow*INPUT)-INPUT)+column;
            // console.log("ROW: " + nxtRow + " COL: " + column + " CELLNUM: " + cellNum);
            if (player == 0) {
                document.getElementById("circle-" + cellNum).style.backgroundColor = color0;
            } else {
                document.getElementById("circle-" + cellNum).style.backgroundColor = color1;
            }
        }
    }
}

// Empty the stacks
function resetStack() {
    stack_1 = new Array();
    stack_2 = new Array();
    stack_3 = new Array();
    stack_4 = new Array();
    stack_5 = new Array();
    stack_6 = new Array();
    stack_0 = new Array();
}

function resetMoves() {
    player0moves = new Array();
    player1moves = new Array();
}

// Check if there is four in a row.
function validate() {
    // Only need to check above, left, up right, and up left.
    for (r = 1; r <= INPUT; r++) {
        for (c = 1; c <= INPUT; c++) {
            // Check cells above
            if ((r-3) >= 1) {
                var cell_1 = (((r)*INPUT)-INPUT)+c;
                var cell_2 = (((r-1)*INPUT)-INPUT)+c;
                var cell_3 = (((r-2)*INPUT)-INPUT)+c;
                var cell_4 = (((r-3)*INPUT)-INPUT)+c;
                if (document.getElementById("circle-"+ cell_1).style.backgroundColor == color0 &&
                    document.getElementById("circle-"+ cell_2).style.backgroundColor == color0 &&
                    document.getElementById("circle-"+ cell_3).style.backgroundColor == color0 &&
                    document.getElementById("circle-"+ cell_4).style.backgroundColor == color0) {
                    endGame(color0);
                }
                else if (document.getElementById("circle-"+ cell_1).style.backgroundColor == color1 &&
                    document.getElementById("circle-"+ cell_2).style.backgroundColor == color1 &&
                    document.getElementById("circle-"+ cell_3).style.backgroundColor == color1 &&
                    document.getElementById("circle-"+ cell_4).style.backgroundColor == color1) {
                    endGame(color1);
                }

            } 

            // Check cells to the left
            if ((c-3) >= 1) {
                var cell_1 = ((r*INPUT)-INPUT)+(c);
                var cell_2 = ((r*INPUT)-INPUT)+(c-1);
                var cell_3 = ((r*INPUT)-INPUT)+(c-2);
                var cell_4 = ((r*INPUT)-INPUT)+(c-3);

                if (document.getElementById("circle-"+ cell_1).style.backgroundColor == color0 &&
                    document.getElementById("circle-"+ cell_2).style.backgroundColor == color0 &&
                    document.getElementById("circle-"+ cell_3).style.backgroundColor == color0 &&
                    document.getElementById("circle-"+ cell_4).style.backgroundColor == color0) {
                    endGame(color0);
                }

                if (document.getElementById("circle-"+ cell_1).style.backgroundColor == color1 &&
                    document.getElementById("circle-"+ cell_2).style.backgroundColor == color1 &&
                    document.getElementById("circle-"+ cell_3).style.backgroundColor == color1 &&
                    document.getElementById("circle-"+ cell_4).style.backgroundColor == color1) {
                    endGame(color1);
                }
            }

            // Check cells up left
            if ((r-3) >= 1 && (c-3) >= 1) {
                var cell_1 = (((r)*INPUT)-INPUT)+(c);
                var cell_2 = (((r-1)*INPUT)-INPUT)+(c-1);
                var cell_3 = (((r-2)*INPUT)-INPUT)+(c-2);
                var cell_4 = (((r-3)*INPUT)-INPUT)+(c-3);
                if (document.getElementById("circle-"+ cell_1).style.backgroundColor == color0 &&
                    document.getElementById("circle-"+ cell_2).style.backgroundColor == color0 &&
                    document.getElementById("circle-"+ cell_3).style.backgroundColor == color0 &&
                    document.getElementById("circle-"+ cell_4).style.backgroundColor == color0) {
                    endGame(color0);
                }
                if (document.getElementById("circle-"+ cell_1).style.backgroundColor == color1 &&
                    document.getElementById("circle-"+ cell_2).style.backgroundColor == color1 &&
                    document.getElementById("circle-"+ cell_3).style.backgroundColor == color1 &&
                    document.getElementById("circle-"+ cell_4).style.backgroundColor == color1) {
                    endGame(color1);
                }
            }
            // Check cells up right
            if ((r-3) >= 1 && (c+3) <= 7) {
                var cell_1 = (((r)*INPUT)-INPUT)+(c);
                var cell_2 = (((r-1)*INPUT)-INPUT)+(c+1);
                var cell_3 = (((r-2)*INPUT)-INPUT)+(c+2);
                var cell_4 = (((r-3)*INPUT)-INPUT)+(c+3);
                if (document.getElementById("circle-"+ cell_1).style.backgroundColor == color0 &&
                    document.getElementById("circle-"+ cell_2).style.backgroundColor == color0 &&
                    document.getElementById("circle-"+ cell_3).style.backgroundColor == color0 &&
                    document.getElementById("circle-"+ cell_4).style.backgroundColor == color0) {
                    endGame(color0);
                }
                if (document.getElementById("circle-"+ cell_1).style.backgroundColor == color1 &&
                    document.getElementById("circle-"+ cell_2).style.backgroundColor == color1 &&
                    document.getElementById("circle-"+ cell_3).style.backgroundColor == color1 &&
                    document.getElementById("circle-"+ cell_4).style.backgroundColor == color1) {
                    endGame(color1);
                }
            }
        }
    }
}

// Check if there is a TIE
function checkTie() {
    var count = 0;
    for (r = 1; r <= INPUT; r++) {
        for (c = 1; c <= INPUT; c++) {
            var cell = ((r*INPUT)-INPUT)+(c)
            if (document.getElementById("circle-"+ cell).style.backgroundColor != "white") count++;
        }
    }
    if (count == (INPUT*INPUT)) tie();
}

// Disable the user from clicking anything on the board.
function endGame(color) {
    let circleCells = document.querySelectorAll(".circle");
    circleCells.forEach(function(elem) {
        var id = elem.id;
        document.getElementById(id).style.pointerEvents = "none";
    });
    document.getElementById("playerturn").innerHTML = "Player " + color + " has won!";
    document.getElementById("newgamebtn").innerHTML = '<button onclick="newGame()" style="width: 200px; height: 50px;">New Game?</button>';
    // PUT RECORDED MOVEMENTS FUNCTION HERE
    recordMoves();
}

// Endgame with a tie
function tie() {
    let circleCells = document.querySelectorAll(".circle");
    circleCells.forEach(function(elem) {
        var id = elem.id;
        document.getElementById(id).style.pointerEvents = "none";
    });
    document.getElementById("playerturn").innerHTML = "Game has ended in a tie.";
    document.getElementById("newgamebtn").innerHTML = '<button onclick="newGame()" style="width: 200px; height: 50px;">New Game?</button>';
}

// Enable the user to start a new game (Enables the user to click the board)
// Current problem: if there is a tie, acknowledge tie
function newGame() {
    document.getElementById("playerturn").innerHTML = '';
    document.getElementById("newgamebtn").innerHTML = '';
    let circleCells = document.querySelectorAll(".circle");
    circleCells.forEach(function(elem) {
        var id = elem.id;
        document.getElementById(id).style.pointerEvents = "auto";
        document.getElementById(id).style.backgroundColor = "white";
    });
    var color = player == 0 ? color0 : color1;
    document.getElementById("playerturn").innerHTML = "Player " + color + "'s turn.";
    resetStack();
    startingPlayer = player;
    console.log(startingPlayer + "'s turn");
}

// Record movements
function recordMoves() {
    var match = {
        starting_player: this.startingPlayer,
        player0_moves: this.player0moves,
        player1_moves: this.player1moves
    };

    var s = JSON.stringify(match);
    // const FileSystem = require("fs");
    // FileSystem.writeFile('file.json', s, (err) => {
    //     if (e) throw e;
    // });

    alert(s);
    // var fs = require("match-history.json", s);
    
}

// Description:

// Complete game implementation

// Record all plays/moves of the game to a file in JSON or XML 
// format so that a given game can be reconstructed and played 
// from where it was left off 
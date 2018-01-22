<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

use vbpupil\BoardFactory;
use vbpupil\Logic\BoardPlotter;

include __DIR__ . '/vendor/autoload.php';

$boardWidth = 5;


$plotter = new BoardPlotter($boardWidth, 25);
dump($plotter);


$board = new BoardFactory($boardWidth);
$board = $board->getBoard();


//foreach ($board->getRows() as $row) {
//    $move = new Moves($board);
//    $row = $move->getRow();
//}

dump($board);


?>

    <style>
        .board {
            border: solid 1px black;
            width: 30%;
            height: 60%;

        }

        .row {
            width: auto;
        }

        .cell {
            background: black;
            width: <?= 100 / $boardWidth ?>%;
            height: <?= 100 / $boardWidth ?>%;
            display: inline-block;
        }

        .odd{
            background: black;
        }

        .even{
            background: white;
        }

        .inactive{
            background: #ccc;
        }

        .occupied{
            background: red;
        }


    </style>
<?php
echo '<div class="board">';

$cellCount = 0;
$count = 0;
foreach ($board->getRows() as $row) {
    echo '<div class="row">';
    foreach ($row->getRowCells() as $cell) {
        echo '<div class="cell '. ($cellCount % 2 ? 'even' : 'odd') .' '.($cell->isActive() ? '' : 'inactive').' '.($cell->isOccupied() ? 'occupied' : '').'"></div>';
        $cellCount++;
    }
    echo '</div>';
}
echo '</div>';
?>
<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

use vbpupil\BoardFactory;
use vbpupil\Logic\BoardManager;
use vbpupil\Logic\QueenBoardMapper;

include __DIR__ . '/vendor/autoload.php';

$debug = false;
$errors = false;
$boardWidth = 9;



try {
    $board = new BoardManager(
        (new BoardFactory($boardWidth))
            ->getBoard()
    );
}catch(Exception $e){
    $errors = true;
    echo $e->getMessage();
}

if ($debug == true) {
    dump($board);
}

if($errors == false) {
    ?>

    <style>
        .board {

        }

        .row {
            width: auto;
        }

        .cell {
            background: black;
            width: 30px;
            height: 30px;
            display: inline-block;
            border: solid .5px black;
        }

        .odd {
            background: black;
        }

        .even {
            background: white;
        }

        .inactive {
            background: #ccc;
        }

        .occupied {
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
            echo '<div class="cell ' . ($cellCount % 2 ? 'even' : 'odd') . ' ' . ($cell->isActive() ? '' : 'inactive') . ' ' . ($cell->isOccupied() ? 'occupied' : '') . '"></div>';
            $cellCount++;
        }
        echo '</div>';
    }
    echo '</div>';

    echo "Board Width: {$boardWidth}<br>Total Number Of Cells: {$board->getBoardTotalNoCells()}<br>Occupied Cells: {$board->getOccupiedCount()}";

}
?>
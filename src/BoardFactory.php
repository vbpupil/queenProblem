<?php
/**
 * Freetimers BoardFactory.php Class
 *
 * @author    Dean Haines
 * @copyright Freetimers Communications Ltd, 2018, UK
 * @license   Proprietary See LICENSE.md
 */

namespace vbpupil;

use vbpupil\Components\Board;
use Exception;
use vbpupil\Components\Cell;
use vbpupil\Components\Row;

class BoardFactory
{
    protected $width;

    public $rows;

    protected $board;

    public function __construct($width)
    {
        try {
            $this->board = new Board($width);
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }

        $this->width = $width;

        $this->initializeBoard();

    }

    protected function initializeBoard()
    {
        $this->generateRows();
        $this->board->setRows($this->rows);
    }

    public function generateRows()
    {
        $boardPos = 0;

        for ($i = 0; $i <= $this->width - 1; $i++) {
            /*SET THE ROWS*/
            $this->rows[] = new Row(
                $this->width,
                ($i)
            );

            $rowPos = 0;
            /*SET THE CELLS*/
            for ($j = 1; $j <= $this->width; $j++) {
                if($rowPos == $this->width){
                    $rowPos = 0;
                }
                $this->rows[$i]->cells[] = new Cell(
                    ($rowPos),
                    ($boardPos)
                );

                $boardPos++;
                $rowPos++;
            }
        }
    }

    public function getBoard()
    {
        return $this->board;
    }
}
<?php
/**
 * Freetimers BoardFactory.php Class
 *
 * @author    Dean Haines
 * @copyright Freetimers Communications Ltd, 2018, UK
 * @license   Proprietary See LICENSE.md
 */

namespace vbpupil;


use Exception;

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
        $cellPos = 0;

        for ($i = 0; $i <= $this->width - 1; $i++) {
            /*SET THE ROWS*/
            $this->rows[] = new Row(
                $this->width,
                ($i)
            );

            /*SET THE CELLS*/
            for ($j = 1; $j <= $this->width; $j++) {
                $this->rows[$i]->cells[] = new Cell(
                    ($i),
                    ($cellPos)
                );

                $cellPos++;
            }
        }
    }

    public function getBoard()
    {
        return $this->board;
    }
}
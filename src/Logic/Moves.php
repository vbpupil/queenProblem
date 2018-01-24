<?php
/**
 *  Moves.php Class
 *
 * @author    Dean Haines
 * @copyright , 2018, UK
 * @license   Proprietary See LICENSE.md
 */

namespace vbpupil\Logic;


use vbpupil\Components\Board;

class Moves
{

    protected $rows;

    public function __construct(Board $board)
    {
        $this->rows = $board->getRows();
        $this->locateFreeSpace();
    }

    public function locateFreeSpace()
    {
        $rowCnt = 0;
        foreach ($this->rows as $row) {
            $cells = $row->getRowCells();
            $cellCnt = 0;
            foreach ($cells as $cell) {

                if ($cell->isActive()) {
                    $cell->setOccupied(true);
                    $row->deactivateRow();
                    $this->deactivateColumn($cellCnt);
                    $this->deactivateDiagonals($rowCnt, $cellCnt);
                }
                $cellCnt++;
            }
            $rowCnt++;
        }
    }

    protected function deactivateColumn($colNum)
    {
        foreach ($this->rows as $row) {
            $cells = $row->getRowCells();
            $cells[$colNum]->setActive(false);
        }
    }

    protected function deactivateDiagonals($rowNum, $cellNum)
    {
        $rowCnt = 0;

        foreach ($this->rows as $row) {
            if ($rowCnt == $rowNum) {
                continue;
            }

            $cells = $row->getRowCells();

            var_dump($cells[$cellNum + $rowCnt]);

            $cells[$cellNum + $rowCnt]->setActive(false);

            $rowCnt++;
        }
    }

    public function getRow()
    {
        return $this->row;
    }

}
<?php
/**
 * BoardManager.php Class
 *
 * @author    Dean Haines
 * @license   Proprietary See LICENSE.md
 */

namespace vbpupil\Logic;

use vbpupil\Components\Board;

class BoardManager
{
    private $board;

    private $boardWidth;

    private $occupiedCount = 0;

    public function __construct(Board $board)
    {
        $this->board = $board;
        $this->boardWidth = $this->board->getWidth();

        $this->playMove();
    }

    public function getRows()
    {
        return $this->board->getRows();
    }

    public function playMove()
    {
        foreach ($this->board->getRows() as $row) {
            foreach ($row->getRowCells() as $cell) {
                if (!$cell->isOccupied() && $cell->isActive()) {
                    $cell->setOccupied(true);
                    $this->occupiedCount++;
                    $this->updateBoard(new QueenBoardMapper($this->boardWidth, ($cell->getBoardPosition() + 1)));
                }
            }
        }
    }

    private function updateBoard(QueenBoardMapper $mapper)
    {
        $coords = $mapper->getDisabledCells();

        foreach ($this->board->getRows() as $row) {
            foreach ($row->getRowCells() as $cell) {
                if (in_array(($cell->getBoardPosition() + 1), $coords)) {
                    $cell->setActive(false);

                }
            }
        }
    }

    /**
     * @return int
     */
    public function getOccupiedCount()
    {
        return $this->occupiedCount;
    }

    /**
     * @return int
     */
    public function getBoardTotalNoCells()
    {
        return ($this->boardWidth * $this->boardWidth);
    }
}
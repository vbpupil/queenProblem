<?php
/**
 * Freetimers BoardPlotter.php Class
 *
 * @author    Dean Haines
 * @copyright Freetimers Communications Ltd, 2018, UK
 * @license   Proprietary See LICENSE.md
 */

namespace vbpupil;


class BoardPlotter
{
    protected $boardWidth;

    protected $cellNum;

    protected $totalNumCells;

    protected $rowPosition;

    protected $rowsAboveMe;

    protected $rowsBelowMe;

    protected $coOrdinates;


    public function __construct($boardWidth, $cellNum)
    {
        $this->boardWidth = $boardWidth;
        $this->cellNum = $cellNum;

        $this->totalNumCells = ($this->boardWidth * $this->boardWidth);

        $this->rowPosition = $this->identifyMyRowNo();
        $this->establishOtherRows();
    }

    private function identifyMyRowNo()
    {
        return (int)ceil($this->cellNum / $this->boardWidth);
    }

    private function establishOtherRows()
    {
        for ($i = 1; $i <= $this->boardWidth; $i++) {
            if($i == $this->rowPosition){
                continue;
            }

            if($i < $this->rowPosition){
                $this->rowsAboveMe[] = $i;
            }

            if($i > $this->rowPosition){
                $this->rowsBelowMe[] = $i;
            }
        }
    }
}
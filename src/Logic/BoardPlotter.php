<?php
/**
 * Freetimers BoardPlotter.php Class
 *
 * @author    Dean Haines
 * @copyright Freetimers Communications Ltd, 2018, UK
 * @license   Proprietary See LICENSE.md
 */

namespace vbpupil\Logic;


class BoardPlotter
{
    protected $boardWidth;

    protected $cellNum;

    protected $totalNumCells;

    protected $myRowNum;

    protected $myRowPos;

    protected $rowsAboveMe;

    protected $rowsBelowMe;

    protected $disabledCells;


    public function __construct($boardWidth, $cellNum)
    {
        $this->boardWidth = $boardWidth;
        $this->cellNum = $cellNum;

        $this->totalNumCells = ($this->boardWidth * $this->boardWidth);

        $this->myRowNum = $this->identifyMyRowNo();
        $this->myRowPos = ($cellNum - ($this->boardWidth * ($this->myRowNum - 1)));

        $this->establishOtherRows();
        $this->generateCoordinates();
    }

    private function identifyMyRowNo()
    {
        return (int)ceil($this->cellNum / $this->boardWidth);
    }

    private function establishOtherRows()
    {
        for ($i = 1; $i <= $this->boardWidth; $i++) {
            if ($i == $this->myRowNum) {
                continue;
            }

            if ($i < $this->myRowNum) {
                $this->rowsAboveMe[] = $i;
            }

            if ($i > $this->myRowNum) {
                $this->rowsBelowMe[] = $i;
            }
        }
    }

    private function inRowRange($cellNum, $rowNum)
    {
        $low = (($this->boardWidth * $rowNum) - ($this->boardWidth ) )+ 1;
        $high = ($this->boardWidth * $rowNum);

        return in_array($cellNum, range($low,$high));
    }

    private function generateCoordinates()
    {
        if (!is_null($this->rowsAboveMe)) {
            $this->rowsAboveMe = array_reverse($this->rowsAboveMe);
            $counter = 1;
            foreach ($this->rowsAboveMe as $row) {
                if($this->inRowRange((($this->cellNum + ($this->boardWidth * ($row - $this->myRowNum))) + $counter), $row)) {
                    $this->disabledCells[] = (($this->cellNum + ($this->boardWidth * ($row - $this->myRowNum))) + $counter);
                }

                if($this->inRowRange((($this->cellNum + ($this->boardWidth * ($row - $this->myRowNum))) + ($counter * -1)) , $row)) {
                    $this->disabledCells[] = (($this->cellNum + ($this->boardWidth * ($row - $this->myRowNum))) + ($counter * -1));
                }
                $counter++;
            }
        }

        if (!is_null($this->rowsBelowMe)) {
            $counter = 1;
            foreach ($this->rowsBelowMe as $row) {
                if($this->inRowRange( (($this->cellNum + ($this->boardWidth * ($row - $this->myRowNum))) + $counter), $row)) {
                    $this->disabledCells[] = (($this->cellNum + ($this->boardWidth * ($row - $this->myRowNum))) + $counter);
                }

                if($this->inRowRange((($this->cellNum + ($this->boardWidth * ($row - $this->myRowNum))) + ($counter * -1)), $row)) {
                    $this->disabledCells[] = (($this->cellNum + ($this->boardWidth * ($row - $this->myRowNum))) + ($counter * -1));
                }

                $counter++;
            }
        }

        sort($this->disabledCells);
    }
}
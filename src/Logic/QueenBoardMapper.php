<?php
/**
 *  BoardPlotter.php Class
 *
 * @author    Dean Haines
 * @copyright , 2018, UK
 * @license   Proprietary See LICENSE.md
 */

namespace vbpupil\Logic;

/**
 * Class QueenBoardMapper
 *
 * responsible for doing the grunt work in order to hand back a map of
 * effected cells from placing a queen piece on a check board
 */
class QueenBoardMapper
{
    protected $boardWidth;

    protected $cellNum;

    protected $totalNumCells;

    protected $myRowNum;

    protected $myRowPos;

    protected $rowsAboveMe;

    protected $rowsBelowMe;

    protected $disabledCells = [];


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

    /**
     * get the row number that i am  on
     *
     * @return int
     */
    private function identifyMyRowNo()
    {
        return (int)ceil($this->cellNum / $this->boardWidth);
    }

    /**
     * lets find row numbers for every row other than the one im on
     * and split them in to whats below me and whats above me
     */
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

    /**
     * check if cell is within a rows range
     *
     * @param $cellNum
     * @param $rowNum
     * @return bool
     */
    private function inRowRange($cellNum, $rowNum)
    {
        $low = (($this->boardWidth * $rowNum) - ($this->boardWidth)) + 1;
        $high = ($this->boardWidth * $rowNum);

        return in_array($cellNum, range($low, $high));
    }


    /**
     * pass back the range of my row
     *
     * @return array
     */
    private function getRange()
    {
        $low = (($this->boardWidth * $this->myRowNum) - ($this->boardWidth)) + 1;
        $high = ($this->boardWidth * $this->myRowNum);

        return range($low, $high);
    }

    /**
     * map out vertical cell numbers
     */
    private function mapVertical()
    {
        $this->disabledCells = array_merge($this->disabledCells, $this->getRange());
    }

    /**
     * map out horizontal cell numbers
     */
    private function mapHorizontal()
    {
        for ($i = $this->myRowPos; $i <= $this->totalNumCells; ($i+=$this->boardWidth)){
            $this->disabledCells[] = $i;
        }
    }

    /**
     * gather up cordinates
     * sort them numerically
     * and remove any duplicates
     */
    private function generateCoordinates()
    {
        $this->mapDiagonal();
        $this->mapVertical();
        $this->mapHorizontal();

        $this->disabledCells = array_unique($this->disabledCells);
        sort($this->disabledCells);
    }

    /**
     * map out diagnal cell numbers
     */
    private function mapDiagonal()
    {
        //plot out diagnal cells above
        if (!is_null($this->rowsAboveMe)) {
            $this->rowsAboveMe = array_reverse($this->rowsAboveMe);
            $counter = 1;
            foreach ($this->rowsAboveMe as $row) {
                if ($this->inRowRange((($this->cellNum + ($this->boardWidth * ($row - $this->myRowNum))) + $counter), $row)) {
                    $this->disabledCells[] = (($this->cellNum + ($this->boardWidth * ($row - $this->myRowNum))) + $counter);
                }

                if ($this->inRowRange((($this->cellNum + ($this->boardWidth * ($row - $this->myRowNum))) + ($counter * -1)), $row)) {
                    $this->disabledCells[] = (($this->cellNum + ($this->boardWidth * ($row - $this->myRowNum))) + ($counter * -1));
                }
                $counter++;
            }
        }

        //plot out diagnal cells below
        if (!is_null($this->rowsBelowMe)) {
            $counter = 1;
            foreach ($this->rowsBelowMe as $row) {
                if ($this->inRowRange((($this->cellNum + ($this->boardWidth * ($row - $this->myRowNum))) + $counter), $row)) {
                    $this->disabledCells[] = (($this->cellNum + ($this->boardWidth * ($row - $this->myRowNum))) + $counter);
                }

                if ($this->inRowRange((($this->cellNum + ($this->boardWidth * ($row - $this->myRowNum))) + ($counter * -1)), $row)) {
                    $this->disabledCells[] = (($this->cellNum + ($this->boardWidth * ($row - $this->myRowNum))) + ($counter * -1));
                }

                $counter++;
            }
        }
    }
}
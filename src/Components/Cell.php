<?php
/**
 *  Cell.php Class
 *
 * @author    Dean Haines

 * @license   Proprietary See LICENSE.md
 */


namespace vbpupil\Components;


class Cell
{

    protected $rowPosition;

    protected $boardPosition;

    protected $active;

    protected $occupied;

    public function __construct($rowPosition, $boardPosition)
    {
        $this->active = true;
        $this->occupied = false;
        $this->setRowPosition($rowPosition);
        $this->setBoardPosition($boardPosition);
    }

    public function isOccupied()
    {
        return $this->occupied;
    }

    public function isActive()
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * @param bool $occupied
     */
    public function setOccupied($occupied)
    {
        $this->occupied = $occupied;
    }

    /**
     * @return mixed
     */
    public function getRowPosition()
    {
        return $this->rowPosition;
    }

    /**
     * @param mixed $rowPosition
     */
    public function setRowPosition($rowPosition)
    {
        $this->rowPosition = $rowPosition;
    }

    /**
     * @return mixed
     */
    public function getBoardPosition()
    {
        return $this->boardPosition;
    }

    /**
     * @param mixed $boardPosition
     */
    public function setBoardPosition($boardPosition)
    {
        $this->boardPosition = $boardPosition;
    }
}
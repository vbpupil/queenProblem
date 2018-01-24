<?php
/*
 *  Row.php Class
 *
 * @author    Dean Haines
 * @copyright , 2018, UK
 * @license   Proprietary See LICENSE.md
 */

namespace vbpupil\Components;

class Row
{
    protected $position;

    protected $width;

    public $cells = array();

    /**
     * Row constructor.
     * @param $width
     */
    public function __construct($width, $rowPosition)
    {
        $this->width = $width;
        $this->setPosition($rowPosition);
    }


    public function getRowCells()
    {
        return $this->cells;
    }

    /**
     *
     */
    public function deactivateRow()
    {
        foreach ($this->cells as $cell) {
            $cell->setActive(false);
        }
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }
}
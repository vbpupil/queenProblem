<?php
/**
 * Freetimers Board.php Class
 *
 * @author    Dean Haines
 * @copyright Freetimers Communications Ltd, 2018, UK
 * @license   Proprietary See LICENSE.md
 */

namespace vbpupil\Components;


use Exception;

class Board
{
    protected $width;

    public $rows = array();

    public function __construct($width)
    {
        echo ($width % 2);
        if (($width % 2) == 0) {
            throw new Exception('Board width must be an odd number.');
        }

        $this->width = $width;
    }

    public function setRows($rows)
    {
        $this->rows = $rows;
    }

    /**
     * @return array
     */
    public function getRows()
    {
        return $this->rows;
    }

}
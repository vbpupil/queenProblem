<?php
/**
 *  Board.php Class
 *
 * @author    Dean Haines

 * @license   Proprietary See LICENSE.md
 */

namespace vbpupil\Components;


use Exception;

/**
 * Class Board
 */
class Board
{
    protected $width;

    public $rows = array();

    /**
     * Board constructor.
     * @param $width
     * @throws Exception
     */
    public function __construct($width)
    {
        if (($width % 2) == 0) {
            throw new Exception('Board width must be an odd number.');
        }

        $this->width = $width;
    }

    /**
     * @param $rows
     */
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

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }


}
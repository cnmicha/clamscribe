<?php

/**
 * Created by PhpStorm.
 * User: micha
 * Date: 09.12.2014
 * Time: 19:40
 */
class cDisplay
{
    private $bLocked = false;

    public static function getInstance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new self();
        }
        return $inst;
    }

    /**
     * @return boolean
     */
    public function isLocked()
    {
        return $this->bLocked;
    }

    /**
     * @param boolean $locked
     */
    public function setLocked($locked)
    {
        $this->bLocked = $locked;
    }
} 
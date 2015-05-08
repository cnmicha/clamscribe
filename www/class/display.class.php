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

    /**
     * Singleton pattern.
     *
     * @author cnmicha
     * @date 2014-12-14
     *
     * @return cDisplay
     */
    public static function getInstance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new self();
        }
        return $inst;
    }

    /**
     * Returns template locked state
     *
     * @author cnmicha
     * @date 2014-12-14
     *
     * @return boolean
     */
    public function isBLocked()
    {
        return $this->bLocked;
    }

    /**
     * Sets template locked state
     *
     * @author cnmicha
     * @date 2014-12-14
     *
     * @param boolean $bLocked
     */
    public function setBLocked($bLocked)
    {
        $this->bLocked = $bLocked;
    }
} 
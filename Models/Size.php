<?php
namespace Models;

class Size
{
    private $userid;
    private $small;
    private $medium;
    private $large;

    /**
     * @return mixed
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * @param mixed $userid
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;
    }

    /**
     * @return mixed
     */
    public function getSmall()
    {
        return $this->small;
    }

    /**
     * @param mixed $small
     */
    public function setSmall($small)
    {
        $this->small = $small;
    }

    /**
     * @return mixed
     */
    public function getMedium()
    {
        return $this->medium;
    }

    /**
     * @param mixed $medium
     */
    public function setMedium($medium)
    {
        $this->medium = $medium;
    }

    /**
     * @return mixed
     */
    public function getLarge()
    {
        return $this->large;
    }

    /**
     * @param mixed $large
     */
    public function setLarge($large)
    {
        $this->large = $large;
    }



}
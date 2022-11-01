<?php

namespace Models;


class AvailableDate
{
    private $availableDateId;
    private $userid;
    private $date;
    private $available;

    /**
     * Get the value of availableDateId
     */
    public function getAvailableDateId()
    {
        return $this->availableDateId;
    }

    /**
     * Set the value of availableDateId
     *
     * @return  self
     */
    public function setAvailableDateId($availableDateId)
    {
        $this->availableDateId = $availableDateId;

        return $this;
    }

    /**
     * Get the value of userid
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Set the value of userid
     */
    public function setUserid($userid): self
    {
        $this->userid = $userid;

        return $this;
    }

    /**
     * Get the value of date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     */
    public function setDate($date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of available
     */
    public function getAvailable()
    {
        return $this->available;
    }

    /**
     * Set the value of available
     */
    public function setAvailable($available): self
    {
        $this->available = $available;

        return $this;
    }
}
